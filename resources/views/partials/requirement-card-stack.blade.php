@php
    $items = is_array($items ?? null) ? $items : [];
    $showHeading = $showHeading ?? true;
    $heading = $heading ?? 'Persyaratan Pendaftaran';
    $subtitle = $subtitle ?? 'Klik tab untuk melihat detail persyaratan.';
    $stackId = $stackId ?? ('pilrek-req-stack-' . uniqid());
@endphp

@once
    <style>
        .pilrek-req-wrap {
            width: min(100%, 1240px);
            margin: 0 auto;
        }

        .pilrek-req-title {
            margin: 0 0 10px;
            text-align: center;
            font-size: clamp(28px, 3vw, 42px);
            font-weight: 900;
            letter-spacing: -0.04em;
            color: #0f4b66;
        }

        .pilrek-req-subtitle {
            margin: 0 0 22px;
            text-align: center;
            color: #5c6f7e;
            font-size: 14px;
            font-weight: 500;
        }

        .pilrek-req-frame {
            --tab-h: 68px;
            --peek: 44px;
            --radius: 22px;
            --ease: cubic-bezier(.16, 1, .3, 1);
            --header-stack-h: 244px;
            --content-top: 244px;
            --glass: rgba(255, 255, 255, .12);
            --glass-border: rgba(255, 255, 255, .10);
            --text: #0f4b44;
            --muted: #4b6f69;
            --shadow-soft: 0 20px 50px rgba(78, 46, 140, .14);
            --shadow-strong: 0 34px 80px rgba(56, 34, 128, .24);
            position: relative;
            height: clamp(760px, 74vw, 940px);
            background: transparent;
            border: 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: none;
            padding: 0;
        }

        .pilrek-req-scene {
            position: relative;
            width: 100%;
            height: 100%;
            perspective: 1800px;
            transform-style: preserve-3d;
            isolation: isolate;
        }

        .pilrek-req-headers {
            position: absolute;
            inset: 0 0 auto 0;
            height: var(--header-stack-h);
            z-index: 3;
            pointer-events: auto;
        }

        .pilrek-req-header-card {
            position: absolute;
            left: 0;
            right: 0;
            height: var(--tab-h);
            border: 0;
            border-radius: 22px 22px 0 0;
            appearance: none;
            -webkit-appearance: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 18px 0 20px;
            color: #fff;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: var(--shadow-soft);
            transition:
                top .82s var(--ease),
                transform .82s var(--ease),
                box-shadow .82s var(--ease),
                filter .82s var(--ease),
                opacity .5s ease;
            will-change: top, transform;
            transform-origin: center top;
            user-select: none;
            overflow: hidden;
            backface-visibility: hidden;
            background: #ffffff;
            color: #145843;
            border: 1px solid #d7e9e4;
        }

        .pilrek-req-header-card:focus-visible {
            outline: 2px solid rgba(20, 88, 67, .35);
            outline-offset: -4px;
        }

        .pilrek-req-header-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: transparent;
            pointer-events: none;
        }

        .pilrek-req-header-card .left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
            position: relative;
            z-index: 1;
        }

        .pilrek-req-header-card .num {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: #e6f1ee;
            backdrop-filter: blur(10px);
            font-size: 14px;
            font-weight: 900;
            flex: 0 0 auto;
            color: #145843;
        }

        .pilrek-req-header-card .label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .01em;
            text-shadow: 0 1px 0 rgba(0, 0, 0, .04);
            color: inherit;
        }

        .pilrek-req-header-card .hint {
            font-size: 12px;
            font-weight: 800;
            opacity: .95;
            position: relative;
            z-index: 1;
            flex: 0 0 auto;
            color: inherit;
        }

        .pilrek-req-header-card:not(.active) {
            transform: translate3d(0, 0, -40px) scale(.997);
            filter: none;
            background: #ffffff;
            color: #145843;
            border: 1px solid #d7e9e4;
            box-shadow: 0 10px 24px rgba(20, 88, 67, .08);
        }

        .pilrek-req-header-card.active {
            transform: translate3d(0, 0, 70px) scale(1.003);
            box-shadow: var(--shadow-strong);
            filter: none;
            background: #ffffff;
            color: #145843;
            border: 1px solid #d7e9e4;
        }

        .pilrek-req-header-card:not(.active)::after {
            background: transparent;
        }

        .pilrek-req-header-card:not(.active) .num {
            background: #f1f8f6;
            color: #145843;
            border: 1px solid #c8ddd7;
        }

        .pilrek-req-header-card.active .num {
            background: #dcede8;
            border: 1px solid #9fc4bb;
        }

        .pilrek-req-content-shell {
            position: absolute;
            left: 0;
            right: 0;
            top: var(--content-top);
            bottom: 0;
            z-index: 1;
            border-radius: 0 0 var(--radius) var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-strong);
            transition: background .82s var(--ease);
            background: #f8fcfb;
            border: 1px solid #d8eae5;
        }

        .pilrek-req-mac-dots {
            position: absolute;
            top: 14px;
            left: 18px;
            z-index: 3;
            display: inline-flex;
            gap: 7px;
        }

        .pilrek-req-mac-dots span {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .09);
        }

        .pilrek-req-mac-dots .dot-red {
            background: #ff5f57;
        }

        .pilrek-req-mac-dots .dot-yellow {
            background: #febc2e;
        }

        .pilrek-req-mac-dots .dot-green {
            background: #28c840;
        }

        .pilrek-req-content-inner {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: 1.08fr .92fr;
            color: var(--text);
            padding: 0;
        }

        .pilrek-req-content {
            padding: 34px 30px 28px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }

        .pilrek-req-card-title {
            margin: 0 0 12px;
            font-size: clamp(28px, 3.2vw, 54px);
            line-height: 1.08;
            font-weight: 900;
            letter-spacing: -0.045em;
            max-width: 470px;
        }

        .pilrek-req-card-desc {
            margin: 0 0 18px;
            max-width: 460px;
            font-size: 14px;
            line-height: 1.8;
            font-weight: 600;
            color: var(--muted);
        }

        .pilrek-req-detail-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 12px;
            max-width: 460px;
        }

        .pilrek-req-detail-list li {
            display: grid;
            grid-template-columns: 32px 1fr;
            gap: 10px;
            align-items: start;
            font-size: 14px;
            line-height: 1.6;
            color: #315f57;
        }

        .pilrek-req-badge {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: #eef8f5;
            border: 1px solid #b9dad1;
            backdrop-filter: blur(10px);
            font-size: 13px;
            font-weight: 800;
            color: #145843;
        }

        .pilrek-req-visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 18px 18px 0;
        }

        .pilrek-req-visual-panel {
            width: 92%;
            height: 88%;
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            background: #eef8f5;
            border: 1px solid rgba(126, 188, 172, .52);
            box-shadow:
                inset 0 -16px 24px rgba(32, 117, 101, .12),
                inset 0 0 0 1px rgba(255, 255, 255, .4);
        }

        .pilrek-req-big-number {
            position: absolute;
            right: 58px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 120px;
            line-height: 1;
            font-weight: 900;
            color: rgba(20, 88, 67, .18);
            letter-spacing: -.06em;
            user-select: none;
        }

        .pilrek-req-doc-card {
            position: absolute;
            left: 50%;
            top: 55%;
            transform: translate(-50%, -50%) rotate(-8deg);
            width: 180px;
            height: 220px;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 20px 36px rgba(26, 95, 82, .18);
            border: 1px solid #c9e2db;
            padding: 18px 16px;
        }

        .pilrek-req-doc-lines {
            margin-top: 42px;
            display: grid;
            gap: 12px;
        }

        .pilrek-req-doc-lines span {
            display: block;
            height: 10px;
            border-radius: 999px;
            background: #d4d9f7;
        }

        .pilrek-req-doc-lines span:nth-child(1) {
            width: 62%;
            background: #2d8b76;
        }

        .pilrek-req-doc-lines span:nth-child(2) {
            width: 82%;
        }

        .pilrek-req-doc-lines span:nth-child(3) {
            width: 75%;
        }

        .pilrek-req-doc-lines span:nth-child(4) {
            width: 56%;
        }

        @media (max-width: 920px) {
            .pilrek-req-frame {
                height: clamp(760px, 152vw, 980px);
            }

            .pilrek-req-content-inner {
                grid-template-columns: 1fr;
            }

            .pilrek-req-visual {
                display: none;
            }

            .pilrek-req-content {
                padding: 26px 22px 24px;
            }

            .pilrek-req-mac-dots {
                top: 10px;
                left: 12px;
            }

            .pilrek-req-header-card .label {
                max-width: 170px;
            }
        }
    </style>
@endonce

<div class="pilrek-req-wrap" id="{{ $stackId }}" data-req-stack>
    @if ($showHeading)
        <h3 class="pilrek-req-title">{{ $heading }}</h3>
        <p class="pilrek-req-subtitle">{{ $subtitle }}</p>
    @endif

    @if (!empty($items))
        <div class="pilrek-req-frame">
            <div class="pilrek-req-scene">
                <div class="pilrek-req-headers" data-req-headers></div>
                <div class="pilrek-req-content-shell" data-req-shell>
                    <div class="pilrek-req-mac-dots" aria-hidden="true">
                        <span class="dot-red"></span>
                        <span class="dot-yellow"></span>
                        <span class="dot-green"></span>
                    </div>
                    <div class="pilrek-req-content-inner" data-req-content></div>
                </div>
            </div>
        </div>
        <script type="application/json" data-req-data>@json($items)</script>
    @else
        <div class="alert alert-light text-center">Data persyaratan belum tersedia.</div>
    @endif
</div>

@once
    <script>
        (function () {
            if (window.__pilrekRequirementStackInit) {
                window.__pilrekRequirementStackInit();
                return;
            }

            window.__pilrekRequirementStackInit = function () {
                var stacks = document.querySelectorAll("[data-req-stack]");

                stacks.forEach(function (stack) {
                    if (stack.dataset.reqReady === "1") {
                        return;
                    }

                    var dataEl = stack.querySelector("[data-req-data]");
                    var headersEl = stack.querySelector("[data-req-headers]");
                    var contentShell = stack.querySelector("[data-req-shell]");
                    var contentInner = stack.querySelector("[data-req-content]");
                    var frameEl = stack.querySelector(".pilrek-req-frame");
                    if (!dataEl || !headersEl || !contentShell || !contentInner) {
                        return;
                    }

                    var items = [];
                    try {
                        items = JSON.parse(dataEl.textContent || "[]");
                    } catch (error) {
                        items = [];
                    }

                    if (!Array.isArray(items) || items.length === 0) {
                        return;
                    }

                    if (frameEl) {
                        var tabHeight = 68;
                        var peekHeight = 44;
                        var headerStackHeight = tabHeight + ((items.length - 1) * peekHeight);
                        frameEl.style.setProperty("--header-stack-h", headerStackHeight + "px");
                        frameEl.style.setProperty("--content-top", headerStackHeight + "px");
                        frameEl.style.minHeight = Math.max(760, headerStackHeight + 460) + "px";
                    }

                    var active = Math.max(0, items.length - 1);
                    var order = items.map(function (_, index) {
                        return index;
                    });

                    function formatNumber(value) {
                        return String(value).padStart(2, "0");
                    }

                    function escapeHtml(value) {
                        var text = String(value == null ? "" : value);
                        return text
                            .replace(/&/g, "&amp;")
                            .replace(/</g, "&lt;")
                            .replace(/>/g, "&gt;")
                            .replace(/"/g, "&quot;")
                            .replace(/'/g, "&#039;");
                    }

                    function buildHeaders() {
                        headersEl.innerHTML = "";
                        items.forEach(function (item, index) {
                            var itemNumber = parseInt(item.order, 10);
                            var numberText = Number.isFinite(itemNumber) ? formatNumber(itemNumber) : formatNumber(index + 1);
                            var btn = document.createElement("button");
                            btn.type = "button";
                            btn.className = "pilrek-req-header-card";
                            btn.dataset.index = String(index);
                            btn.innerHTML =
                                '<span class="left">' +
                                '<span class="num">' + numberText + "</span>" +
                                '<span class="label">' + escapeHtml(item.label || "Persyaratan") + "</span>" +
                                "</span>" +
                                '<span class="hint">Klik detail</span>';
                            btn.addEventListener("click", function () {
                                changeActive(index);
                            });
                            headersEl.appendChild(btn);
                        });
                    }

                    function renderContent(index) {
                        var item = items[index] || {};
                        var itemNumber = parseInt(item.order, 10);
                        var numberText = Number.isFinite(itemNumber) ? formatNumber(itemNumber) : formatNumber(index + 1);
                        var details = Array.isArray(item.details) ? item.details.filter(function (detail) {
                            return String(detail || "").trim() !== "";
                        }) : [];
                        if (!details.length) {
                            details = ["Detail persyaratan belum diisi."];
                        }

                        var detailHtml = details.map(function (text, i) {
                            return '<li><span class="pilrek-req-badge">' + (i + 1) + "</span><span>" + escapeHtml(text) + "</span></li>";
                        }).join("");

                        contentInner.innerHTML =
                            '<div class="pilrek-req-content">' +
                            '<h4 class="pilrek-req-card-title">' + escapeHtml(item.title || "Persyaratan") + "</h4>" +
                            '<p class="pilrek-req-card-desc">' + escapeHtml(item.description || "-") + "</p>" +
                            '<ul class="pilrek-req-detail-list">' + detailHtml + "</ul>" +
                            "</div>" +
                            '<div class="pilrek-req-visual">' +
                            '<div class="pilrek-req-visual-panel">' +
                            '<div class="pilrek-req-big-number">' + numberText + "</div>" +
                            '<div class="pilrek-req-doc-card">' +
                            '<div class="pilrek-req-doc-lines"><span></span><span></span><span></span><span></span></div>' +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }

                    function layoutHeaders() {
                        var buttons = Array.prototype.slice.call(headersEl.querySelectorAll(".pilrek-req-header-card"));
                        buttons.forEach(function (btn, index) {
                            var pos = order.indexOf(index);
                            var isActive = index === active;
                            btn.style.top = (pos * 44) + "px";
                            btn.style.zIndex = isActive ? "30" : String(10 + pos);
                            btn.classList.toggle("active", isActive);
                        });
                    }

                    function changeActive(index) {
                        if (index === active) {
                            return;
                        }

                        active = index;
                        order = order.filter(function (i) {
                            return i !== index;
                        }).concat(index);
                        layoutHeaders();
                        renderContent(index);
                    }

                    buildHeaders();
                    order = order.filter(function (i) {
                        return i !== active;
                    }).concat(active);
                    layoutHeaders();
                    renderContent(active);
                    stack.dataset.reqReady = "1";
                });
            };

            window.__pilrekRequirementStackInit();
        })();
    </script>
@endonce
