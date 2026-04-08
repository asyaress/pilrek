<?php

namespace Tests\Unit;

use App\Support\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_sanitizer_removes_dangerous_html(): void
    {
        $dirty = '<p>Halo<script>alert(1)</script><a href="javascript:alert(1)" onclick="x()">Klik</a></p>'
            . '<img src="javascript:alert(2)" onerror="alert(3)">';

        $clean = HtmlSanitizer::sanitizeArticle($dirty);

        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('onclick=', $clean);
        $this->assertStringNotContainsString('javascript:', strtolower($clean));
        $this->assertStringContainsString('Halo', $clean);
    }

    public function test_sanitizer_keeps_allowed_tags_and_safe_link(): void
    {
        $dirty = '<p><strong>Judul</strong></p><ul><li>Poin 1</li></ul>'
            . '<a href="https://example.com" target="_blank">Sumber</a>';

        $clean = HtmlSanitizer::sanitizeArticle($dirty);

        $this->assertStringContainsString('<strong>Judul</strong>', $clean);
        $this->assertStringContainsString('<ul><li>Poin 1</li></ul>', str_replace("\n", '', $clean));
        $this->assertStringContainsString('href="https://example.com"', $clean);
        $this->assertStringContainsString('target="_blank"', $clean);
        $this->assertStringContainsString('rel="noopener noreferrer nofollow"', $clean);
    }

    public function test_plain_text_sanitizer_strips_tags_and_normalizes_spaces(): void
    {
        $clean = HtmlSanitizer::sanitizePlainText("  <b>Halo</b>\n Dunia\t ", 100);

        $this->assertSame('Halo Dunia', $clean);
    }
}
