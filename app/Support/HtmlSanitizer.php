<?php

namespace App\Support;

use DOMComment;
use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    /**
     * @var array<int, string>
     */
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's',
        'h2', 'h3', 'h4', 'h5', 'h6',
        'ul', 'ol', 'li', 'blockquote',
        'a', 'img', 'code', 'pre',
    ];

    /**
     * @var array<int, string>
     */
    private const DROP_WITH_CONTENT = [
        'script', 'style', 'iframe', 'object', 'embed',
        'form', 'input', 'button', 'textarea', 'select', 'option',
        'svg', 'math',
    ];

    /**
     * @var array<string, array<int, string>>
     */
    private const ALLOWED_ATTRIBUTES = [
        'a' => ['href', 'title', 'target', 'rel'],
        'img' => ['src', 'alt', 'title', 'width', 'height'],
    ];

    public static function sanitizeArticle(?string $html): string
    {
        if (!is_string($html) || trim($html) === '') {
            return '';
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $wrapperId = 'news-sanitize-root';
        $payload = mb_encode_numericentity($html, [0x80, 0x10FFFF, 0, 0x1FFFFF], 'UTF-8');

        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML(
            '<!DOCTYPE html><html><body><div id="' . $wrapperId . '">' . $payload . '</div></body></html>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);

        $root = $dom->getElementById($wrapperId);
        if (!$root instanceof DOMElement) {
            return '';
        }

        self::sanitizeChildren($root);

        return trim(self::innerHtml($root));
    }

    public static function sanitizePlainText(?string $text, int $maxLength = 0): ?string
    {
        if (!is_string($text)) {
            return null;
        }

        $clean = strip_tags($text);
        $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $clean = preg_replace('/\s+/u', ' ', trim($clean)) ?? '';

        if ($clean === '') {
            return null;
        }

        if ($maxLength > 0 && mb_strlen($clean) > $maxLength) {
            $clean = mb_substr($clean, 0, $maxLength);
        }

        return $clean;
    }

    private static function sanitizeChildren(DOMNode $node): void
    {
        $children = [];
        foreach ($node->childNodes as $child) {
            $children[] = $child;
        }

        foreach ($children as $child) {
            if ($child instanceof DOMComment) {
                $child->parentNode?->removeChild($child);
                continue;
            }

            if ($child instanceof DOMElement) {
                self::sanitizeElement($child);
            }
        }
    }

    private static function sanitizeElement(DOMElement $element): void
    {
        $tag = strtolower($element->tagName);

        if (in_array($tag, self::DROP_WITH_CONTENT, true)) {
            $element->parentNode?->removeChild($element);
            return;
        }

        if (!in_array($tag, self::ALLOWED_TAGS, true)) {
            self::unwrapElement($element);
            return;
        }

        self::sanitizeAttributes($element, $tag);

        if ($tag === 'img' && !$element->hasAttribute('src')) {
            $element->parentNode?->removeChild($element);
            return;
        }

        self::sanitizeChildren($element);
    }

    private static function unwrapElement(DOMElement $element): void
    {
        $parent = $element->parentNode;
        if (!$parent) {
            return;
        }

        while ($element->firstChild) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }

    private static function sanitizeAttributes(DOMElement $element, string $tag): void
    {
        $allowedAttributes = self::ALLOWED_ATTRIBUTES[$tag] ?? [];
        $attributeNames = [];

        foreach ($element->attributes as $attribute) {
            $attributeNames[] = $attribute->nodeName;
        }

        foreach ($attributeNames as $attributeName) {
            $name = strtolower($attributeName);
            $value = trim((string) $element->getAttribute($attributeName));

            if (str_starts_with($name, 'on') || $name === 'style') {
                $element->removeAttribute($attributeName);
                continue;
            }

            if (!in_array($name, $allowedAttributes, true)) {
                $element->removeAttribute($attributeName);
                continue;
            }

            if (in_array($name, ['href', 'src'], true) && !self::isSafeUrl($value, $name === 'src')) {
                $element->removeAttribute($attributeName);
                continue;
            }

            if ($name === 'target' && !in_array($value, ['_blank', '_self'], true)) {
                $element->removeAttribute($attributeName);
                continue;
            }

            if (in_array($name, ['width', 'height'], true) && !preg_match('/^\d{1,4}$/', $value)) {
                $element->removeAttribute($attributeName);
                continue;
            }

            $element->setAttribute($name, $value);
        }

        if ($tag === 'a' && !$element->hasAttribute('href')) {
            $element->removeAttribute('target');
            $element->removeAttribute('rel');
        }

        if ($tag === 'a' && $element->getAttribute('target') === '_blank') {
            $element->setAttribute('rel', 'noopener noreferrer nofollow');
        }
    }

    private static function isSafeUrl(string $url, bool $isImage): bool
    {
        if ($url === '') {
            return false;
        }

        $normalized = strtolower(preg_replace('/[\x00-\x20]+/u', '', $url) ?? '');
        if (
            str_starts_with($normalized, 'javascript:') ||
            str_starts_with($normalized, 'vbscript:') ||
            str_starts_with($normalized, 'data:')
        ) {
            return false;
        }

        if (
            str_starts_with($url, '/') ||
            str_starts_with($url, './') ||
            str_starts_with($url, '../') ||
            str_starts_with($url, '#')
        ) {
            return true;
        }

        $parsed = parse_url($url);
        if ($parsed === false) {
            return false;
        }

        $scheme = strtolower((string) ($parsed['scheme'] ?? ''));
        if ($scheme === '') {
            return !str_contains($url, ':');
        }

        if ($isImage) {
            return in_array($scheme, ['http', 'https'], true);
        }

        return in_array($scheme, ['http', 'https', 'mailto', 'tel'], true);
    }

    private static function innerHtml(DOMElement $element): string
    {
        $html = '';
        foreach ($element->childNodes as $child) {
            $html .= $element->ownerDocument?->saveHTML($child) ?? '';
        }

        return $html;
    }
}
