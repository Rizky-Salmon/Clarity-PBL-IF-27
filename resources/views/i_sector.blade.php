@extends('layouts.admin')

@section('title', 'Interactive Visualization')

@push('head-script')
    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>
    <title>CodePen - D3 Packed Bubble Chart</title>
    <link rel="canonical" href="https://codepen.io/kendsnyder/pen/vPmQbY">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i");

        body {
            background-color: #e0e0e0;
        }

        select,
        input {
            font: 14px Arial;
        }

        h3 {
            font-size: 16px;
            margin: 15px 0 4px 0;
            padding: 0;
        }

        .first-h3 {
            margin-top: 0;
        }

        fieldset {
            float: left;
            padding: 15px;
            margin: 0;
            background-color: white;
            border: 1px solid #bbb;
        }

        legend {
            background-color: white;
            padding: 3px 8px;
            border: 1px solid #bbb;
        }

        #container {
            width: 960px;
            margin: 0 auto;
            background-color: #e0e0e0;
        }

        .bubble-label {
            text-align: center;
            font-family: Roboto, Arial;
            font-weight: 400;
            line-height: 1.2;
            cursor: default;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .bubble-value {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 300;
            cursor: default;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        button {
            clear: left;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
            padding: 8px 15px;
            background-color: white;
            border: 1px solid #bbb;
        }

        text {
            fill: #fff;
            transition: all 0.3s;
            text-overflow: ellipsis;
        }

        .label {
            fill: #000;
        }

        .chart {
            margin: 0 auto;
            max-width: 700px;
        }

        .chart-svg {
            width: 100%;
            height: 100%;
        }

        .node {
            cursor: default;
        }

        .node:nth-child(1) .graph {
            -webkit-animation-delay: 0.033s;
            animation-delay: 0.033s;
        }

        .node:nth-child(2) .graph {
            -webkit-animation-delay: 0.066s;
            animation-delay: 0.066s;
        }

        .node:nth-child(3) .graph {
            -webkit-animation-delay: 0.099s;
            animation-delay: 0.099s;
        }

        .node:nth-child(4) .graph {
            -webkit-animation-delay: 0.132s;
            animation-delay: 0.132s;
        }

        .node:nth-child(5) .graph {
            -webkit-animation-delay: 0.165s;
            animation-delay: 0.165s;
        }

        .node:nth-child(6) .graph {
            -webkit-animation-delay: 0.198s;
            animation-delay: 0.198s;
        }

        .node:nth-child(7) .graph {
            -webkit-animation-delay: 0.231s;
            animation-delay: 0.231s;
        }

        .node:nth-child(8) .graph {
            -webkit-animation-delay: 0.264s;
            animation-delay: 0.264s;
        }

        .node:nth-child(9) .graph {
            -webkit-animation-delay: 0.297s;
            animation-delay: 0.297s;
        }

        .node:nth-child(10) .graph {
            -webkit-animation-delay: 0.33s;
            animation-delay: 0.33s;
        }

        .node:nth-child(11) .graph {
            -webkit-animation-delay: 0.363s;
            animation-delay: 0.363s;
        }

        .node:nth-child(12) .graph {
            -webkit-animation-delay: 0.396s;
            animation-delay: 0.396s;
        }

        .node:nth-child(13) .graph {
            -webkit-animation-delay: 0.429s;
            animation-delay: 0.429s;
        }

        .node:nth-child(14) .graph {
            -webkit-animation-delay: 0.462s;
            animation-delay: 0.462s;
        }

        .node:nth-child(15) .graph {
            -webkit-animation-delay: 0.495s;
            animation-delay: 0.495s;
        }

        .node:nth-child(16) .graph {
            -webkit-animation-delay: 0.528s;
            animation-delay: 0.528s;
        }

        .node:nth-child(17) .graph {
            -webkit-animation-delay: 0.561s;
            animation-delay: 0.561s;
        }

        .node:nth-child(18) .graph {
            -webkit-animation-delay: 0.594s;
            animation-delay: 0.594s;
        }

        .node:nth-child(19) .graph {
            -webkit-animation-delay: 0.627s;
            animation-delay: 0.627s;
        }

        .node:nth-child(20) .graph {
            -webkit-animation-delay: 0.66s;
            animation-delay: 0.66s;
        }

        .node:nth-child(21) .graph {
            -webkit-animation-delay: 0.693s;
            animation-delay: 0.693s;
        }

        .node:nth-child(22) .graph {
            -webkit-animation-delay: 0.726s;
            animation-delay: 0.726s;
        }

        .node:nth-child(23) .graph {
            -webkit-animation-delay: 0.759s;
            animation-delay: 0.759s;
        }

        .node:nth-child(24) .graph {
            -webkit-animation-delay: 0.792s;
            animation-delay: 0.792s;
        }

        .node:nth-child(25) .graph {
            -webkit-animation-delay: 0.825s;
            animation-delay: 0.825s;
        }

        .node:nth-child(26) .graph {
            -webkit-animation-delay: 0.858s;
            animation-delay: 0.858s;
        }

        .node:nth-child(27) .graph {
            -webkit-animation-delay: 0.891s;
            animation-delay: 0.891s;
        }

        .node:nth-child(28) .graph {
            -webkit-animation-delay: 0.924s;
            animation-delay: 0.924s;
        }

        .node:nth-child(29) .graph {
            -webkit-animation-delay: 0.957s;
            animation-delay: 0.957s;
        }

        .node:nth-child(30) .graph {
            -webkit-animation-delay: 0.99s;
            animation-delay: 0.99s;
        }

        .node circle {
            transition: transform 200ms ease-in-out;
        }

        .node:hover circle {
            transform: scale(1.05);
        }

        .graph {
            opacity: 0;
            -webkit-animation-name: animateIn;
            animation-name: animateIn;
            -webkit-animation-duration: 900ms;
            animation-duration: 900ms;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
            -webkit-animation-timing-function: cubic-bezier(0.7, 0.85, 0.41, 1.21);
            animation-timing-function: cubic-bezier(0.7, 0.85, 0.41, 1.21);
        }

        @-webkit-keyframes animateIn {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-8deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0);
            }
        }

        @keyframes animateIn {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-8deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0);
            }
        }

        .d3-tip-outer {
            position: relative;
        }

        .d3-tip {
            font-family: Roboto, sans-serif;
            font-size: 18px;
            font-weight: 100;
            line-height: 1;
            padding: 16px 20px;
            color: #fff;
            border-radius: 6px;
        }

        .d3-stem {
            width: 0;
            height: 0;
            position: absolute;
            bottom: -45px;
            left: 55%;
            border-style: solid;
            border-width: 48px 15px 0 0;
            transform: rotate(17deg);
            transform-origin: 100% 0;
            z-index: 2;
        }
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0" style="font-weight: 600;">
                <i class="fa-solid fas fa-globe  fa-lg me-2"></i>
                Sector
            </h4>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-fw fa-chart-area"></i>
                Data Visualization
            </h1>
        </div>

        <fieldset style="display: flex; flex-direction: column;">
            <legend>Graph Options</legend>
            <h3 class="first-h3">Sector Name</h3>
            <div style="display: flex; flex-direction: column;">
                <select id="limit" style="width: 100%; max-width: 170px;">
                    <option value="All">All</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->sector_name }}">{{ $sector->sector_name }}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>


        <div id="chart" class="chart">
            {{-- <svg viewBox="0 0 625 600" width="625" height="600" class="chart-svg">
                <g class="node" transform="translate(267.9683820554086 316.1031465225012)">
                    <g class="graph">
                        <circle r="29.14688745340708" style="fill: rgb(240, 90, 36);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(357.7893541108392 316.1031465225012)">
                    <g class="graph">
                        <circle r="60.67408460202353" style="fill: rgb(238, 63, 101);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 17px; fill: rgb(255, 255, 255); pointer-events: none;">Research</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 17px; fill: rgb(255, 255, 255); pointer-events: none;">26</text>
                    </g>
                </g>
                <g class="node" transform="translate(273.1224580888648 413.469223956467)">
                    <g class="graph">
                        <circle r="68.35551013063018" style="fill: rgb(236, 41, 123);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 20px; fill: rgb(255, 255, 255); pointer-events: none;">Consumer</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 20px; fill: rgb(255, 255, 255); pointer-events: none;">33</text>
                    </g>
                </g>
                <g class="node" transform="translate(288.76204476527136 267.41207895764103)">
                    <g class="graph">
                        <circle r="23.798333950392117" style="fill: rgb(227, 35, 108);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(407.2018468010204 434.1658665440344)">
                    <g class="graph">
                        <circle r="67.31185326905722" style="fill: rgb(188, 30, 96);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 19px; fill: rgb(255, 255, 255); pointer-events: none;">Home
                            &amp; Gard...</text><text dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 19px; fill: rgb(255, 255, 255); pointer-events: none;">32</text>
                    </g>
                </g>
                <g class="node" transform="translate(326.91065593175597 234.46642581896447)">
                    <g class="graph">
                        <circle r="26.607346232158942" style="fill: rgb(158, 31, 99);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(222.4456047306468 260.25629171387317)">
                    <g class="graph">
                        <circle r="42.903056664377125" style="fill: rgb(153, 34, 113);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(377.3133522140093 233.91797149584625)">
                    <g class="graph">
                        <circle r="23.798333950392117" style="fill: rgb(149, 36, 128);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(219.87909943131177 338.25303063499837)">
                    <g class="graph">
                        <circle r="23.798333950392117" style="fill: rgb(122, 42, 143);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(267.04020792621446 141.29742062969152)">
                    <g class="graph">
                        <circle r="84.13981658632152" style="fill: rgb(101, 45, 144);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 25px; fill: rgb(255, 255, 255); pointer-events: none;">Jonatan</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 25px; fill: rgb(255, 255, 255); pointer-events: none;">50</text>
                    </g>
                </g>
                <g class="node" transform="translate(447.61223755647256 253.0654353433921)">
                    <g class="graph">
                        <circle r="49.06152229559475" style="fill: rgb(80, 41, 128);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 13px; fill: rgb(255, 255, 255); pointer-events: none;">Entertainme...</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 13px; fill: rgb(255, 255, 255); pointer-events: none;">17</text>
                    </g>
                </g>
                <g class="node" transform="translate(520.7904535550645 351.1973372583658)">
                    <g class="graph">
                        <circle r="73.35139152556458" style="fill: rgb(59, 38, 113);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 22px; fill: rgb(255, 255, 255); pointer-events: none;">Marketing</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 22px; fill: rgb(255, 255, 255); pointer-events: none;">38</text>
                    </g>
                </g>
                <g class="node" transform="translate(142.75454192484182 318.51438024576646)">
                    <g class="graph">
                        <circle r="55.812040309230085" style="fill: rgb(38, 34, 97);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">Mobile</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">22</text>
                    </g>
                </g>
                <g class="node" transform="translate(427.78334389154503 128.45630784352008)">
                    <g class="graph">
                        <circle r="77.11541569330385" style="fill: rgb(41, 45, 120);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 23px; fill: rgb(255, 255, 255); pointer-events: none;">Brand</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 23px; fill: rgb(255, 255, 255); pointer-events: none;">42</text>
                    </g>
                </g>
                <g class="node" transform="translate(177.16268085308656 396.1938458854811)">
                    <g class="graph">
                        <circle r="29.14688745340708" style="fill: rgb(42, 51, 132);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(327.651615708334 510.4488076562859)">
                    <g class="graph">
                        <circle r="42.903056664377125" style="fill: rgb(43, 56, 143);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(153.1437550431809 204.4335642957598)">
                    <g class="graph">
                        <circle r="46.085275528675616" style="fill: rgb(42, 79, 159);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 12px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 12px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(60.87349232115383 244.5508613985622)">
                    <g class="graph">
                        <circle r="54.528833370754654" style="fill: rgb(39, 124, 192);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">Technology</text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">21</text>
                    </g>
                </g>
                <g class="node" transform="translate(187.7138640680131 448.07707055648984)">
                    <g class="graph">
                        <circle r="23.798333950392117" style="fill: rgb(38, 146, 208);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
                <g class="node" transform="translate(536.5798346231343 237.71922623785468)">
                    <g class="graph">
                        <circle r="41.219923537570494" style="fill: rgb(37, 169, 224);"></circle><text dy="0.2em"
                            style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                            dy="1.3em"
                            style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                    </g>
                </g>
            </svg> --}}
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js"></script>
        <script src="https://d3js.org/d3-hierarchy.v1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.19.0/d3-legend.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.9.1/d3-tip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.9.1/d3-tip.min.js"></script>

        <script id="rendered-js">
            var activityData = {!! $datavisual !!};

            function getColor(idx, total) {
                const hue = (360 * idx / total) % 360;
                return `hsl(${hue}, 70%, 50%)`;
            }

            const activitySelect = document.querySelector('#limit');

            activitySelect.selectedIndex = 0;
            activitySelect.addEventListener('change', render);

            render();

            function render() {
                let idx = 0;
                const activityValue = activitySelect.options[activitySelect.selectedIndex].value;
                let filteredData = activityValue === "All" ? activityData : activityData.filter(d => d.sector ===
                activityValue);

                if (activityValue !== "All") {
                    // Split subsectors into individual entries
                    let subsectorData = [];
                    filteredData.forEach(activity => {
                        let subsectors = activity.subsector.split(', ');
                        subsectors.forEach(name => {
                            subsectorData.push({
                                sector: activity.sector,
                                subsector: name,
                                deskripsi: activity.deskripsi
                            });
                        });
                    });
                    filteredData = subsectorData;
                }

                document.querySelector('#chart').innerHTML = '';

                var json = {
                    'children': filteredData
                };

                const values = json.children.map(d => d.total_subsectors || 1);
                const min = Math.min.apply(null, values);
                const max = Math.max.apply(null, values);
                const total = json.children.length;

                var diameter = 600;

                var bubble = d3.pack().size([diameter, diameter]).padding(0);

                var tip = d3.tip()
                    .attr('class', 'd3-tip-outer')
                    .offset([-38, 0])
                    .html((d, i) => {
                        const item = json.children[i];
                        const color = getColor(i, total);
                        if (activityValue === "All") {
                            return `<div class="d3-tip" style="background-color: ${color}; color: white;">
                        <strong style="color: black;">Sector:</strong> <strong style="color: white;">${item.sector}</strong> <br>
                        <strong style="color: black;">Subsector:</strong> <strong style="color: white;">${item.subsector}</strong> <br>
                        <strong style="color: black;">Description:</strong> <strong style="color: white;">${item.deskripsi}</strong>
                    </div>
                    <div class="d3-stem" style="border-color: ${color} transparent transparent transparent"></div>`;
                        } else {
                            return `<div class="d3-tip" style="background-color: ${color}; color: white;">
                        <strong style="color: black;">Sector:</strong> <strong style="color: white;">${item.sector}</strong> <br>
                    </div>
                    <div class="d3-stem" style="border-color: ${color} transparent transparent transparent"></div>`;
                        }
                    });

                var margin = {
                    left: 25,
                    right: 25,
                    top: 25,
                    bottom: 25
                };

                var svg = d3.select('#chart').append('svg')
                    .attr('viewBox', '0 0 ' + (diameter + margin.right) + ' ' + diameter)
                    .attr('width', diameter + margin.right)
                    .attr('height', diameter)
                    .attr('class', 'chart-svg');

                var root = d3.hierarchy(json)
                    .sum(function(d) {
                        return activityValue === "All" ? d.total_subsectors : 1;
                    });

                bubble(root);

                var node = svg.selectAll('.node')
                    .data(root.children)
                    .enter()
                    .append('g').attr('class', 'node')
                    .attr('transform', function(d) {
                        return 'translate(' + d.x + ' ' + d.y + ')';
                    })
                    .append('g').attr('class', 'graph');

                node.append("circle")
                    .attr("r", function(d) {
                        return d.r;
                    })
                    .style("fill", getItemColor)
                    .on('mouseover', tip.show)
                    .on('mouseout', tip.hide);

                node.call(tip);

                node.append("text")
                    .attr("dy", "0.2em")
                    .style("text-anchor", "middle")
                    .style('font-family', 'Roboto')
                    .style('font-size', '14px')
                    .text(d => activityValue === "All" ? d.data.total_subsectors : d.data.subsector)
                    .style("fill", "black")
                    .style('pointer-events', 'none');

                function getItemColor(item) {
                    return getColor(idx++, total);
                }
            }
        </script>

    </div>
    <!-- /.container-fluid -->

    @if (session('openModal'))
        <script>
            let modal = "{{ session('openModal') }}";
            setTimeout(function() {
                $('#' + modal).modal('show');
            }, 2000);
        </script>
    @endif

@endsection
