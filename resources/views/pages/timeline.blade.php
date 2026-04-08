@extends('layouts.app')

@section('title', 'Timeline Pilrek Unmul 2026-2030')

@section('content')
    <style>
        .pilrek-roadmap-page-shell {
            background: transparent;
        }

        .pilrek-roadmap-page-canvas {
            display: grid;
            grid-template-columns: minmax(460px, 60%) minmax(320px, 40%);
            gap: 20px;
            align-items: stretch;
            position: relative;
            background: transparent;
        }

        .pilrek-roadmap-page-left {
            position: relative;
            z-index: 5;
        }

        .pilrek-roadmap-page-heading {
            margin-bottom: 16px;
        }

        .pilrek-roadmap-page-heading h2 {
            margin: 0;
            font-size: clamp(28px, 2.4vw, 42px);
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #0c2230;
        }

        .pilrek-roadmap-page-heading p {
            margin: 10px 0 0;
            font-size: clamp(14px, 1.02vw, 18px);
            color: #253745;
        }

        .pilrek-roadmap-page-steps {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pilrek-roadmap-page-step {
            position: relative;
            min-height: 106px;
            padding: 16px 28px 16px 112px;
            background: rgba(255, 255, 255, 0.58);
            clip-path: polygon(30px 0, calc(100% - 30px) 0, 100% 50%, calc(100% - 30px) 100%, 30px 100%, 0 50%);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.06);
        }

        .pilrek-roadmap-page-step-number {
            position: absolute;
            left: 36px;
            top: 50%;
            transform: translateY(-50%);
            margin: 0;
            font-size: 30px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 0.02em;
            color: var(--step-color, #f2c400);
        }

        .pilrek-roadmap-page-step-date {
            margin: 0 0 6px;
            color: #0f7180;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .pilrek-roadmap-page-step-title {
            margin: 0 0 4px;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 800;
            color: #0a3d4b;
        }

        .pilrek-roadmap-page-step-desc {
            margin: 0;
            font-size: 15px;
            line-height: 1.45;
            color: #243540;
            max-width: 440px;
        }

        .pilrek-roadmap-page-right {
            position: relative;
            min-height: 780px;
            overflow: visible;
            background: transparent;
        }

        .pilrek-roadmap-page-svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
        }

        .pilrek-roadmap-page-fill {
            fill: none;
            stroke: #000;
            stroke-width: 124;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .pilrek-roadmap-page-lane {
            fill: none;
            stroke: #dddddd;
            stroke-width: 3.2;
            stroke-dasharray: 22 16;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.95;
        }

        .pilrek-roadmap-page-milestones {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        .pilrek-roadmap-page-milestone {
            --size: 82px;
            position: absolute;
            width: var(--size);
            height: var(--size);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            display: grid;
            place-items: center;
            cursor: pointer;
            pointer-events: auto;
        }

        .pilrek-roadmap-page-milestone::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: var(--color, #f2c400);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.14);
        }

        .pilrek-roadmap-page-milestone .icon {
            position: relative;
            z-index: 1;
            color: #fff;
            font-size: 21px;
            display: grid;
            place-items: center;
        }

        .pilrek-roadmap-page-milestone .icon i,
        .pilrek-roadmap-page-milestone .icon svg {
            color: #fff !important;
            fill: #fff;
            stroke: #fff;
        }

        .pilrek-roadmap-page-milestone .connector {
            position: absolute;
            top: calc(100% - 2px);
            left: 50%;
            width: 3px;
            height: var(--line, 36px);
            transform: translateX(-50%);
            background: repeating-linear-gradient(to bottom,
                    color-mix(in srgb, var(--color, #f2c400) 96%, white 4%) 0 5px,
                    transparent 5px 10px);
        }

        .pilrek-roadmap-page-milestone .dot {
            position: absolute;
            left: 50%;
            bottom: calc(-1 * var(--line, 36px) - 10px);
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--color, #f2c400);
        }

        .pilrek-road-flag {
            position: absolute;
            transform: translate(-50%, -50%) rotate(var(--rot, 0deg));
            transform-origin: center center;
            z-index: 2;
            pointer-events: none;
            opacity: 0.56;
            text-align: center;
        }

        .pilrek-road-flag-line {
            position: relative;
            width: 16px;
            height: 58px;
            border-radius: 3px;
            border: 2px solid rgba(255, 255, 255, 0.88);
            background-color: #e9ecef;
            background-image:
                linear-gradient(45deg, #101010 25%, transparent 25%, transparent 75%, #101010 75%, #101010),
                linear-gradient(45deg, #101010 25%, transparent 25%, transparent 75%, #101010 75%, #101010);
            background-size: 10px 10px;
            background-position: 0 0, 5px 5px;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.28);
        }

        .pilrek-road-flag-line::before,
        .pilrek-road-flag-line::after {
            content: "";
            position: absolute;
            left: 50%;
            width: 30px;
            height: 5px;
            transform: translateX(-50%);
            border-radius: 999px;
            background: repeating-linear-gradient(90deg,
                    #d61f1f 0 8px,
                    #ffffff 8px 16px);
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
        }

        .pilrek-road-flag-line::before {
            top: -8px;
        }

        .pilrek-road-flag-line::after {
            bottom: -8px;
        }

        .pilrek-road-flag-text {
            margin-top: 10px;
            font-size: 9px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #f8fbfd;
            font-weight: 700;
            text-shadow: 0 2px 7px rgba(0, 0, 0, 0.35);
        }

        .pilrek-roadmap-page-milestone:focus-visible {
            outline: 3px solid rgba(3, 166, 166, 0.65);
            outline-offset: 4px;
        }

        .pilrek-tl-modal[hidden] {
            display: none !important;
        }

        .pilrek-tl-modal {
            position: fixed;
            inset: 0;
            z-index: 1200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .pilrek-tl-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(6, 19, 27, 0.62);
            backdrop-filter: blur(2px);
        }

        .pilrek-tl-modal-dialog {
            position: relative;
            width: min(560px, 100%);
            border-radius: 18px;
            padding: 24px 24px 22px;
            background: #fff;
            border: 1px solid rgba(2, 34, 53, 0.08);
            box-shadow: 0 22px 45px rgba(2, 34, 53, 0.24);
        }

        .pilrek-tl-modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 50%;
            font-size: 24px;
            line-height: 1;
            color: #29414f;
            background: #f1f5f7;
            cursor: pointer;
        }

        .pilrek-tl-modal-kicker {
            margin: 0 0 8px;
            font-size: 12px;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: #6c7b88;
        }

        .pilrek-tl-modal-title {
            margin: 0 0 10px;
            font-size: 28px;
            line-height: 1.2;
            color: #0a3d4b;
        }

        .pilrek-tl-modal-date {
            margin: 0 0 12px;
            font-size: 14px;
            color: #0f7180;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .pilrek-tl-modal-desc {
            margin: 0;
            color: #304551;
            font-size: 16px;
            line-height: 1.65;
        }

        @media (max-width: 991px) {
            .pilrek-roadmap-page-canvas {
                grid-template-columns: 1fr;
            }

            .pilrek-roadmap-page-right {
                order: 1;
                display: block;
                width: 100%;
                min-height: 520px;
                margin-bottom: 18px;
            }

            .pilrek-roadmap-page-left {
                order: 2;
            }

            .pilrek-roadmap-page-step {
                min-height: 96px;
                padding: 16px 22px 16px 92px;
            }

            .pilrek-roadmap-page-step-number {
                left: 28px;
                font-size: 26px;
            }

            .pilrek-roadmap-page-step-title {
                font-size: 19px;
            }

            .pilrek-roadmap-page-step-desc {
                font-size: 14px;
                max-width: none;
            }

            .pilrek-roadmap-page-fill {
                stroke-width: 112;
            }

            .pilrek-roadmap-page-lane {
                stroke-width: 3;
                stroke-dasharray: 18 14;
            }
        }

        @media (max-width: 575px) {
            .pilrek-roadmap-page-right {
                min-height: 420px;
            }
        }
    </style>

    <div id="smooth-wrapper" class="mil-wrapper">
        <div class="mil-preloader">
            <div class="mil-load"></div>
            <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span
                    class="mil-light">%</span></p>
        </div>

        <div class="mil-progress-track">
            <div class="mil-progress"></div>
        </div>

        <div class="progress-wrap active-progress"></div>
        @include('partials.navbar', ['activePage' => 'timeline'])

        <div id="smooth-content">
            <div class="mil-banner mil-banner-inner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-10">
                            <div class="mil-banner-text mil-text-center">
                                <div class="mil-text-m mil-mb-20">Timeline Pilrek</div>
                                <h1 class="mil-mb-30">Tahapan Lengkap Pemilihan Rektor Universitas Mulawarman</h1>
                                <p class="mil-text-m mil-soft mil-mb-40">Periode 2026-2030</p>
                                <ul class="mil-breadcrumbs mil-center">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('timeline') }}">Timeline</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $timelineItems = $timelineItems ?? [];
                $timelineStepColors = ['#f2c400', '#a8b42d', '#56a35f', '#158a7b', '#0f463d'];
                $timelineStepIcons = ['fa-chart-line', 'fa-user-check', 'fa-file-signature', 'fa-bullseye', 'fa-flag-checkered'];
            @endphp

            <div class="mil-p-0-160">
                <div class="container">
                    <div class="pilrek-roadmap-page-shell mil-up" data-roadmap-page-section>
                        <div class="pilrek-roadmap-page-canvas" data-roadmap-page-canvas>
                            <div class="pilrek-roadmap-page-left" data-roadmap-page-left>
                                <!-- <div class="pilrek-roadmap-page-heading">
                                    <h2>Optimization Path Roadmap</h2>
                                    <p>Focuses on ongoing improvement and long-term planning</p>
                                </div> -->
                                <div class="pilrek-roadmap-page-steps">
                                    @foreach ($timelineItems as $itemIndex => $item)
                                        @php
                                            $stepNumber = str_pad((string) ($itemIndex + 1), 2, '0', STR_PAD_LEFT);
                                            $stepColor = $timelineStepColors[$itemIndex % count($timelineStepColors)];
                                        @endphp
                                        <article class="pilrek-roadmap-page-step" data-roadmap-page-step>
                                            <p class="pilrek-roadmap-page-step-number" style="--step-color: {{ $stepColor }};">
                                                {{ $stepNumber }}</p>
                                            <p class="pilrek-roadmap-page-step-date">{{ $item['date'] }}</p>
                                            <h4 class="pilrek-roadmap-page-step-title">{{ $item['title'] }}</h4>
                                            <p class="pilrek-roadmap-page-step-desc">{{ $item['description'] }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pilrek-roadmap-page-right" data-roadmap-page-visual>
                                <svg class="pilrek-roadmap-page-svg" viewBox="0 0 1000 1000" preserveAspectRatio="none"
                                    aria-hidden="true">
                                    <path class="pilrek-roadmap-page-fill" data-roadmap-page-fill />
                                    <path class="pilrek-roadmap-page-lane" data-roadmap-page-lane />
                                </svg>
                                <div class="pilrek-roadmap-page-milestones" data-roadmap-page-milestones></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pilrek-tl-modal" data-pilrek-tl-modal hidden>
                <div class="pilrek-tl-modal-backdrop" data-pilrek-tl-close></div>
                <div class="pilrek-tl-modal-dialog" role="dialog" aria-modal="true"
                    aria-labelledby="pilrekTlTitleTimeline">
                    <button type="button" class="pilrek-tl-modal-close" data-pilrek-tl-close
                        aria-label="Tutup detail timeline">&times;</button>
                    <p class="pilrek-tl-modal-kicker" data-pilrek-tl-number>Timeline</p>
                    <h4 class="pilrek-tl-modal-title" id="pilrekTlTitleTimeline" data-pilrek-tl-title>-</h4>
                    <p class="pilrek-tl-modal-date" data-pilrek-tl-date>-</p>
                    <p class="pilrek-tl-modal-desc" data-pilrek-tl-desc>-</p>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>

    <script>
        (function () {
            var roadmapSection = document.querySelector("[data-roadmap-page-section]");
            if (!roadmapSection) return;

            var steps = Array.prototype.slice.call(roadmapSection.querySelectorAll("[data-roadmap-page-step]"));
            if (!steps.length) return;

            var roadmapCanvas = roadmapSection.querySelector("[data-roadmap-page-canvas]");
            var roadVisual = roadmapSection.querySelector("[data-roadmap-page-visual]");
            var roadSvg = roadmapSection.querySelector(".pilrek-roadmap-page-svg");
            var roadFill = roadmapSection.querySelector("[data-roadmap-page-fill]");
            var roadLane = roadmapSection.querySelector("[data-roadmap-page-lane]");
            var milestonesHost = roadmapSection.querySelector("[data-roadmap-page-milestones]");
            var roadmapLeft = roadmapSection.querySelector("[data-roadmap-page-left]");
            var modal = document.querySelector("[data-pilrek-tl-modal]");
            var modalNumber = modal ? modal.querySelector("[data-pilrek-tl-number]") : null;
            var modalTitle = modal ? modal.querySelector("[data-pilrek-tl-title]") : null;
            var modalDate = modal ? modal.querySelector("[data-pilrek-tl-date]") : null;
            var modalDesc = modal ? modal.querySelector("[data-pilrek-tl-desc]") : null;

            var milestoneColors = @json($timelineStepColors);
            var milestoneIcons = @json($timelineStepIcons);

            function isCompactView() {
                return window.matchMedia("(max-width: 991px)").matches;
            }

            function getStepDetail(index) {
                var step = steps[index];
                if (!step) return null;

                var numberEl = step.querySelector(".pilrek-roadmap-page-step-number");
                var titleEl = step.querySelector(".pilrek-roadmap-page-step-title");
                var dateEl = step.querySelector(".pilrek-roadmap-page-step-date");
                var descEl = step.querySelector(".pilrek-roadmap-page-step-desc");

                return {
                    number: numberEl ? numberEl.textContent.trim() : String(index + 1),
                    title: titleEl ? titleEl.textContent.trim() : "Timeline",
                    date: dateEl ? dateEl.textContent.trim() : "-",
                    description: descEl ? descEl.textContent.trim() : "-"
                };
            }

            function openModal(index) {
                if (!modal) return;
                var detail = getStepDetail(index);
                if (!detail) return;

                if (modalNumber) modalNumber.textContent = "Tahap " + detail.number;
                if (modalTitle) modalTitle.textContent = detail.title;
                if (modalDate) modalDate.textContent = detail.date;
                if (modalDesc) modalDesc.textContent = detail.description;
                modal.hidden = false;
                document.body.style.overflow = "hidden";
            }

            function closeModal() {
                if (!modal) return;
                modal.hidden = true;
                document.body.style.overflow = "";
            }

            if (modal) {
                Array.prototype.forEach.call(modal.querySelectorAll("[data-pilrek-tl-close]"), function (closeEl) {
                    closeEl.addEventListener("click", closeModal);
                });

                document.addEventListener("keydown", function (event) {
                    if (event.key === "Escape" && !modal.hidden) {
                        closeModal();
                    }
                });
            }

            function buildRoadPath(width, height, count, compact) {
                if (compact) {
                    var samples = Math.max(150, count * 24);
                    var startY = height * 0.05;
                    var endY = height * 1.03;
                    var centerX = width * 0.53;
                    var amplitude = width * 0.39;
                    var waves = Math.max(1.6, Math.min(2.8, count / 4));
                    var path = "";

                    for (var s = 0; s <= samples; s++) {
                        var t = s / samples;
                        var envelope = 0.72 + 0.28 * Math.sin(Math.PI * t);
                        var waveX = centerX + amplitude * envelope * Math.sin(Math.PI / 2 + (t * Math.PI * 2 * waves));
                        var waveY = startY + (endY - startY) * t;

                        if (s === 0) {
                            path = "M " + waveX + " " + waveY;
                        } else {
                            path += " L " + waveX + " " + waveY;
                        }
                    }

                    return path;
                }

                function x(value) {
                    return width * value;
                }

                function y(value) {
                    return height * value;
                }

                var rightX = 0.84;
                var leftX = 0.18;
                var topEntryX = 0.43;
                var topStartY = -0.02;
                var firstNodeY = 0.10;
                var lastNodeY = 1.03;
                var nodeCount = Math.max(5, Math.ceil(count / 2.6) + 1);
                var nodes = [];
                var d = "";

                if (nodeCount % 2 === 0) {
                    nodeCount += 1;
                }

                for (var i = 0; i < nodeCount; i++) {
                    var t = i / (nodeCount - 1);
                    var drift = (i / (nodeCount - 1)) * 0.06;
                    var nodeX = i % 2 === 0 ? (rightX - drift) : (leftX + drift * 0.45);
                    var nodeY = firstNodeY + (lastNodeY - firstNodeY) * t;
                    nodes.push({ x: x(nodeX), y: y(nodeY) });
                }

                d = "M " + x(topEntryX) + " " + y(topStartY);
                d += " C " + x(0.56) + " " + y(0.01) + ", " + x(0.70) + " " + y(0.06) + ", " + nodes[0].x + " " + nodes[0].y;

                for (var j = 1; j < nodes.length; j++) {
                    var prev = nodes[j - 1];
                    var curr = nodes[j];
                    var cpOffset = (curr.y - prev.y) * 0.56;
                    d += " C " + prev.x + " " + (prev.y + cpOffset) + ", " + curr.x + " " + (curr.y - cpOffset) + ", " + curr.x + " " + curr.y;
                }

                return d;
            }

            function drawRoad() {
                if (!roadVisual || !roadSvg || !roadFill || !roadLane || !milestonesHost) return;

                var compact = isCompactView();
                if (compact) {
                    var compactHeight = Math.max(420, Math.min(920, 260 + steps.length * 58));
                    roadVisual.style.height = compactHeight + "px";
                    roadVisual.style.minHeight = compactHeight + "px";
                } else {
                    var leftHeight = roadmapLeft ? roadmapLeft.offsetHeight : (roadmapCanvas ? roadmapCanvas.offsetHeight : 900);
                    roadVisual.style.height = leftHeight + "px";
                    roadVisual.style.minHeight = leftHeight + "px";
                }

                var width = roadVisual.clientWidth;
                var height = roadVisual.clientHeight;
                if (width < 40 || height < 40) return;

                roadSvg.setAttribute("viewBox", "0 0 " + width + " " + height);
                var path = buildRoadPath(width, height, steps.length, compact);
                roadFill.setAttribute("d", path);
                roadLane.setAttribute("d", path);

                milestonesHost.innerHTML = "";
                var totalLength = roadLane.getTotalLength();
                var startRatio = 0.08;
                var endRatio = 0.92;

                function createRoadFlag(label, ratio, yOffset) {
                    var atLength = totalLength * ratio;
                    var p = roadLane.getPointAtLength(atLength);
                    var pPrev = roadLane.getPointAtLength(Math.max(0, atLength - 2));
                    var pNext = roadLane.getPointAtLength(Math.min(totalLength, atLength + 2));
                    var angle = Math.atan2(pNext.y - pPrev.y, pNext.x - pPrev.x) * 180 / Math.PI;
                    var flag = document.createElement("div");

                    flag.className = "pilrek-road-flag";
                    flag.style.left = p.x + "px";
                    flag.style.top = (p.y + yOffset) + "px";
                    flag.style.setProperty("--rot", angle + "deg");
                    flag.innerHTML = '<div class="pilrek-road-flag-text">' + label + '</div>';
                    milestonesHost.appendChild(flag);
                }

                createRoadFlag("Start", compact ? 0.1 : 0.12, compact ? -8 : -10);
                createRoadFlag("Finish", compact ? 0.93 : 0.94, compact ? 10 : 12);

                for (var i = 0; i < steps.length; i++) {
                    var ratio = steps.length === 1
                        ? 0.5
                        : startRatio + ((endRatio - startRatio) * i) / (steps.length - 1);
                    var point = roadLane.getPointAtLength(totalLength * ratio);
                    var color = milestoneColors[i % milestoneColors.length];
                    var icon = milestoneIcons[i % milestoneIcons.length];
                    var marker = document.createElement("div");
                    var size = compact ? 72 : 82;
                    var offset = compact ? 60 : 70;
                    var lineHeight = Math.max(26, Math.round(offset - size / 2 - 5));

                    marker.className = "pilrek-roadmap-page-milestone";
                    marker.style.left = point.x + "px";
                    marker.style.top = (point.y - offset) + "px";
                    marker.style.setProperty("--size", size + "px");
                    marker.style.setProperty("--line", lineHeight + "px");
                    marker.style.setProperty("--color", color);
                    marker.innerHTML = '<div class="icon"><i class="fas ' + icon + '"></i></div><span class="connector"></span><span class="dot"></span>';
                    marker.setAttribute("role", "button");
                    marker.setAttribute("tabindex", "0");
                    marker.setAttribute("aria-label", "Lihat detail tahap " + (i + 1));
                    marker.addEventListener("click", (function (index) {
                        return function () {
                            openModal(index);
                        };
                    })(i));
                    marker.addEventListener("keydown", (function (index) {
                        return function (event) {
                            if (event.key === "Enter" || event.key === " ") {
                                event.preventDefault();
                                openModal(index);
                            }
                        };
                    })(i));

                    milestonesHost.appendChild(marker);
                }
            }

            window.addEventListener("resize", function () {
                window.requestAnimationFrame(drawRoad);
            });

            window.requestAnimationFrame(drawRoad);
        })();
    </script>
@endsection
