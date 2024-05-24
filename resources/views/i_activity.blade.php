<!DOCTYPE html>
<html lang="en">

<head>
    @include('form.head')

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
            font: 14px Arial;
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
            float: left;
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
            max-width: 675px;
            max-height: 675px;
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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('form.sidebar')

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('form.navbar')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <div class="h3">
                            <i class="fa-solid fa-globe-europe fa-lg"></i>
                            INTERACTIVE VISUALIZATIONS
                        </div>
                    </div>
                    <div class="h3 mx-1">Overall Activity</div>

                    <fieldset>
                        <legend>Graph Options</legend>
                        <h3 class="first-h3">Number of Bubbles to show</h3>
                        <div><select id="limit">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                                <option>24</option>
                                <option>25</option>
                            </select></div>
                        <h3>Order</h3>
                        <select id="shuffle">
                            <option value="0">Largest to smallest</option>
                            <option value="1">Random</option>
                        </select>
                        <h3>Bg Color</h3>
                        <select id="bg">
                            <option value="#e0e0e0">Gray</option>
                            <option value="#eeeeee">Gray 2</option>
                            <option value="#111111">Dark</option>
                        </select>
                    </fieldset>

                    <div id="chart" class="chart"><svg viewBox="0 0 625 600" width="625" height="600"
                            class="chart-svg">
                            <g class="node" transform="translate(267.9683820554086 316.1031465225012)">
                                <g class="graph">
                                    <circle r="29.14688745340708" style="fill: rgb(240, 90, 36);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(357.7893541108392 316.1031465225012)">
                                <g class="graph">
                                    <circle r="60.67408460202353" style="fill: rgb(238, 63, 101);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 17px; fill: rgb(255, 255, 255); pointer-events: none;">Research</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 17px; fill: rgb(255, 255, 255); pointer-events: none;">26</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(273.1224580888648 413.469223956467)">
                                <g class="graph">
                                    <circle r="68.35551013063018" style="fill: rgb(236, 41, 123);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 20px; fill: rgb(255, 255, 255); pointer-events: none;">Consumer</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 20px; fill: rgb(255, 255, 255); pointer-events: none;">33</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(288.76204476527136 267.41207895764103)">
                                <g class="graph">
                                    <circle r="23.798333950392117" style="fill: rgb(227, 35, 108);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(407.2018468010204 434.1658665440344)">
                                <g class="graph">
                                    <circle r="67.31185326905722" style="fill: rgb(188, 30, 96);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 19px; fill: rgb(255, 255, 255); pointer-events: none;">Home
                                        &amp; Gard...</text><text dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 19px; fill: rgb(255, 255, 255); pointer-events: none;">32</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(326.91065593175597 234.46642581896447)">
                                <g class="graph">
                                    <circle r="26.607346232158942" style="fill: rgb(158, 31, 99);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(222.4456047306468 260.25629171387317)">
                                <g class="graph">
                                    <circle r="42.903056664377125" style="fill: rgb(153, 34, 113);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(377.3133522140093 233.91797149584625)">
                                <g class="graph">
                                    <circle r="23.798333950392117" style="fill: rgb(149, 36, 128);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(219.87909943131177 338.25303063499837)">
                                <g class="graph">
                                    <circle r="23.798333950392117" style="fill: rgb(122, 42, 143);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(267.04020792621446 141.29742062969152)">
                                <g class="graph">
                                    <circle r="84.13981658632152" style="fill: rgb(101, 45, 144);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 25px; fill: rgb(255, 255, 255); pointer-events: none;">Jonatan</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 25px; fill: rgb(255, 255, 255); pointer-events: none;">50</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(447.61223755647256 253.0654353433921)">
                                <g class="graph">
                                    <circle r="49.06152229559475" style="fill: rgb(80, 41, 128);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 13px; fill: rgb(255, 255, 255); pointer-events: none;">Entertainme...</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 13px; fill: rgb(255, 255, 255); pointer-events: none;">17</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(520.7904535550645 351.1973372583658)">
                                <g class="graph">
                                    <circle r="73.35139152556458" style="fill: rgb(59, 38, 113);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 22px; fill: rgb(255, 255, 255); pointer-events: none;">Marketing</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 22px; fill: rgb(255, 255, 255); pointer-events: none;">38</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(142.75454192484182 318.51438024576646)">
                                <g class="graph">
                                    <circle r="55.812040309230085" style="fill: rgb(38, 34, 97);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">Mobile</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">22</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(427.78334389154503 128.45630784352008)">
                                <g class="graph">
                                    <circle r="77.11541569330385" style="fill: rgb(41, 45, 120);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 23px; fill: rgb(255, 255, 255); pointer-events: none;">Brand</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 23px; fill: rgb(255, 255, 255); pointer-events: none;">42</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(177.16268085308656 396.1938458854811)">
                                <g class="graph">
                                    <circle r="29.14688745340708" style="fill: rgb(42, 51, 132);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(327.651615708334 510.4488076562859)">
                                <g class="graph">
                                    <circle r="42.903056664377125" style="fill: rgb(43, 56, 143);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(153.1437550431809 204.4335642957598)">
                                <g class="graph">
                                    <circle r="46.085275528675616" style="fill: rgb(42, 79, 159);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 12px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 12px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(60.87349232115383 244.5508613985622)">
                                <g class="graph">
                                    <circle r="54.528833370754654" style="fill: rgb(39, 124, 192);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">Technology</text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 15px; fill: rgb(255, 255, 255); pointer-events: none;">21</text>
                                </g>
                            </g>
                            <g class="node" transform="translate(187.7138640680131 448.07707055648984)">
                                <g class="graph">
                                    <circle r="23.798333950392117" style="fill: rgb(38, 146, 208);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 8px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                            <g class="node" transform="translate(536.5798346231343 237.71922623785468)">
                                <g class="graph">
                                    <circle r="41.219923537570494" style="fill: rgb(37, 169, 224);"></circle><text
                                        dy="0.2em"
                                        style="text-anchor: middle; font-family: Roboto; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text><text
                                        dy="1.3em"
                                        style="text-anchor: middle; font-family: Roboto; font-weight: 100; font-size: 11px; fill: rgb(255, 255, 255); pointer-events: none;"></text>
                                </g>
                            </g>
                        </svg></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js"></script>
                    <script src="https://d3js.org/d3-hierarchy.v1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.19.0/d3-legend.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.9.1/d3-tip.min.js"></script>
                    <script id="rendered-js">
                        const defaultLimit = 20;

                        // setup controls
                        const satInput = document.querySelector('#sat');
                        const lumInput = document.querySelector('#lum');
                        const limitSelect = document.querySelector('#limit');
                        const shuffleSelect = document.querySelector('#shuffle');
                        const options = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
                        options.forEach((val, i) => limitSelect.options[i] = new Option(val));
                        limitSelect.selectedIndex = defaultLimit - 1;
                        const bgSelect = document.querySelector('#bg');
                        bgSelect.selectedIndex = 0;
                        limitSelect.addEventListener('change', render);
                        bgSelect.addEventListener('change', render);
                        shuffleSelect.addEventListener('change', render);

                        render();

                        function render() {
                            let idx = 0;
                            const limit = limitSelect.selectedIndex + 1;
                            const bgColor = bgSelect.options[bgSelect.selectedIndex].value;
                            const doShuffle = shuffleSelect.selectedIndex === 1;
                            document.querySelector('#chart').innerHTML = '';

                            var json = {
                                'children': [{
                                        "name": "Représentation institutionelle",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accompagnement renforcé EUNICE",
                                        "value": 10
                                    },
                                    {
                                        "name": "Collecte des indicateurs",
                                        "value": 30
                                    },
                                    {
                                        "name": "Contrôle financier de projet",
                                        "value": 40
                                    },
                                    {
                                        "name": "Gestion réunion 'Statut Projet'",
                                        "value": 10
                                    },
                                    {
                                        "name": "Représentation UPHF Board of Director EUNICE",
                                        "value": 10
                                    },
                                    {
                                        "name": "Conseil au pilotage des Projets Erasmus+ de l’UPHF",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi du respect de la Charte Erasmus+",
                                        "value": 40
                                    },
                                    {
                                        "name": "Etablissement et suivi des budgets",
                                        "value": 40
                                    },
                                    {
                                        "name": "Etablissement des rapports, bilans et statistiques",
                                        "value": 30
                                    },
                                    {
                                        "name": "Encadrement d'agents",
                                        "value": 30
                                    },
                                    {
                                        "name": "Amélioration permanente du branding RI de l’UPHF",
                                        "value": 20
                                    },
                                    {
                                        "name": "Liaison entre la Cellule mobilité et la Cellule Projets et Partenariats",
                                        "value": 40
                                    },
                                    {
                                        "name": "Réponses aux sollicitations des partenaires et acteurs internes sur les accords",
                                        "value": 50
                                    },
                                    {
                                        "name": "Gestion personnel, chronotime",
                                        "value": 20
                                    },
                                    {
                                        "name": "Prospection des universités dans les pays anglophones BRIDGE",
                                        "value": 10
                                    },
                                    {
                                        "name": "Participation à la coordination et à l'organisation de l'accueil des délégations étrangères à l'université en lien avec la présidence",
                                        "value": 30
                                    },
                                    {
                                        "name": "Contribution aux partages de connaissances intra-service et intra-universitaire",
                                        "value": 50
                                    },
                                    {
                                        "name": "Accompagnement des enseignants et particulièrement les chargés de mission par zone géographique dans le développement et le suivi de leurs activités internationales",
                                        "value": 20
                                    },
                                    {
                                        "name": "Evaluation des partenariats en cours (fiches de synthèse, tableaux de bord, statistiques) et proposer des pistes d’amélioration",
                                        "value": 20
                                    },
                                    {
                                        "name": "Veille stratégique sur les opportunités de financement et sur les appels à projets en fonction de besoins identifiés (exemples non limitants ; Erasmus+, ADESFA, AUF, Ambassades, etc.)",
                                        "value": 30
                                    },
                                    {
                                        "name": "Identification des réseaux d’informations et partager les informations sur ces opportunités",
                                        "value": 20
                                    },
                                    {
                                        "name": "Relecture et traduction de documents en anglais et en français",
                                        "value": 20
                                    },
                                    {
                                        "name": "Coordination d'un volet de projet : IUMEME",
                                        "value": 10
                                    },
                                    {
                                        "name": "Accompagnement du PRI à organiser et stabiliser la gestion de projet",
                                        "value": 20
                                    },
                                    {
                                        "name": "Accompagnement des Chargé de mission pour la coordination et le développement de leur perimètre",
                                        "value": 10
                                    },
                                    {
                                        "name": "veille et participation aux montages et dépôts de projets Erasmus+",
                                        "value": 50
                                    },
                                    {
                                        "name": "contribution au dévelopement d'outils de communication en faveur de ces publics et de la promotion du label EURAXESS",
                                        "value": 30
                                    },
                                    {
                                        "name": "élaboration et mise en œuvre la politique de coopération internationale de l'établissement",
                                        "value": 20
                                    },
                                    {
                                        "name": "conseil à l'équipe de direction dans le domaine de la coopération internationale en relation avec la politique scientifique de l'établissement, synthétiser et préparer des éléments d'aide à la décision",
                                        "value": 20
                                    },
                                    {
                                        "name": "représentation de l'établissement et animer les relations avec les partenaires, constituer des réseaux professionnels, impulser et coordonner des manifestations internationales",
                                        "value": 10
                                    },
                                    {
                                        "name": "promotion des activités scientifiques et/ou pédagogiques de l'établissement sur le plan international, rechercher et fédérer des partenaires potentiels",
                                        "value": 10
                                    },
                                    {
                                        "name": "pilotage des programmes de coopération internationale",
                                        "value": 10
                                    },
                                    {
                                        "name": "négociation des conventions correspondantes aux programmes de coopération internationale et en assurer le suivi ",
                                        "value": 10
                                    },
                                    {
                                        "name": "promotion et organisation de la veille sur les dispositifs européens et/ou internationaux existants dans le domaine de la recherche et/ou de la formation",
                                        "value": 10
                                    },
                                    {
                                        "name": "promotion et organisation de la diffusion de l'information sur la coopération internationale",
                                        "value": 20
                                    },
                                    {
                                        "name": "organisation et réflexion prospective sur le développement de l’offre de formations proposée en co-diplomation et sur l’internationalisation des formations et proposer les actions à mener",
                                        "value": 10
                                    },
                                    {
                                        "name": "Planification, organisation et le contrôle des activités du service, ainsi que l'encadrement des personnels",
                                        "value": 10
                                    },
                                    {
                                        "name": "Mise en place d'une méthodologie de gestion de projet cohérente à l’UPHF",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation au bon accueil des délégations étrangères",
                                        "value": 60
                                    },
                                    {
                                        "name": "Animation équipe projet local",
                                        "value": 20
                                    },
                                    {
                                        "name": "Lien avec coordinateur du projet",
                                        "value": 10
                                    },
                                    {
                                        "name": "Rédaction et mise à jour Procédure DAF/AC",
                                        "value": 30
                                    },
                                    {
                                        "name": "Représentation UPHF Project Management Team meeting",
                                        "value": 10
                                    },
                                    {
                                        "name": "Représentation UPHF Student Board EUNICE",
                                        "value": 10
                                    },
                                    {
                                        "name": "Participations aux activités AISBL",
                                        "value": 10
                                    },
                                    {
                                        "name": "Mise à jour/netttoyage/archive Arborescence serveur",
                                        "value": 80
                                    },
                                    {
                                        "name": "Définition de la stratégie pour la participation aux actions de mobilité Erasmus+ et autres",
                                        "value": 20
                                    },
                                    {
                                        "name": "Coordination de la transition vers le nouveau programme Erasmus+",
                                        "value": 20
                                    },
                                    {
                                        "name": "Demandes de financements projets de mobilité",
                                        "value": 20
                                    },
                                    {
                                        "name": "Référente de la mobilité EUNICE",
                                        "value": 30
                                    },
                                    {
                                        "name": "Pilotage et planification des aspects administratifs et financiers de la mobilité internationale ",
                                        "value": 20
                                    },
                                    {
                                        "name": "Développement de la mobilité internationale du personnel (entrants & sortants)",
                                        "value": 40
                                    },
                                    {
                                        "name": "Pilotage de la promotion de la mobilité étudiante entrante et sortante",
                                        "value": 40
                                    },
                                    {
                                        "name": "Liaison avec Direction de la Communication ",
                                        "value": 30
                                    },
                                    {
                                        "name": "Mise à jour du site web et de l’ENT, référent DRUPAL du PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation aux outputs des Projets",
                                        "value": 20
                                    },
                                    {
                                        "name": "Mise à jour et développement des accords de mobilité Erasmus+",
                                        "value": 30
                                    },
                                    {
                                        "name": "Maintien du contact partenaires Erasmus+ en lien avec les composantes de formation ",
                                        "value": 20
                                    },
                                    {
                                        "name": "Saisie et mise à jour du logiciel de gestion MoveOn en lien avec les accords",
                                        "value": 50
                                    },
                                    {
                                        "name": "Gestion du budget « Soutien Organisationnel » Erasmus+ ",
                                        "value": 30
                                    },
                                    {
                                        "name": "Saisie de données sur Mobility Tool et Beneficiary Module",
                                        "value": 30
                                    },
                                    {
                                        "name": "Assistance à l'élaboration des rapports qualitatifs et financiers des mobilités Erasmus+ ",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réponses aux sollications des personnels sur la mobilité Erasmus+",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion administrative et financière des mobilités de personnel",
                                        "value": 30
                                    },
                                    {
                                        "name": "Organisation de l'accueil des mobilités entrantes du personnel/enseignants-chercheurs",
                                        "value": 40
                                    },
                                    {
                                        "name": "Actualisation de la documentation en lien avec le programme Erasmus+ ",
                                        "value": 50
                                    },
                                    {
                                        "name": "Organisation et participation à des événements pour la promotion de la mobilité ",
                                        "value": 40
                                    },
                                    {
                                        "name": "Organisation et participation aux  sorties culturelles ",
                                        "value": 50
                                    },
                                    {
                                        "name": "Organisation et participation aux journées d'intégration ",
                                        "value": 60
                                    },
                                    {
                                        "name": "Gestion des réseaux sociaux RI ",
                                        "value": 30
                                    },
                                    {
                                        "name": "Elaboration de documents d'information et de promotion à l’International ",
                                        "value": 50
                                    },
                                    {
                                        "name": "Elaboration d'outils et événements de promotion de la mobilité internationale étudiante",
                                        "value": 50
                                    },
                                    {
                                        "name": "Valorisation des activités du PRI en interne et en externe",
                                        "value": 40
                                    },
                                    {
                                        "name": "Participation à la communication des projets du portefeuille PRI",
                                        "value": 40
                                    },
                                    {
                                        "name": "Participation à des réunions de référents (différentes thématiques)",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi des installations techniques et des matériels",
                                        "value": 20
                                    },
                                    {
                                        "name": "Vérification de l'état des espaces publics et internes : fuites, propreté, sobriété énergétique",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion des interventions en lien avec les services techniques",
                                        "value": 20
                                    },
                                    {
                                        "name": "Assurer le suivi et la mise à jour de la signalétique dans les espaces",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation aux réaménagements de salles et changement de mobilier  du PRI",
                                        "value": 30
                                    },
                                    {
                                        "name": "Suivi du stock des documents de communication",
                                        "value": 20
                                    },
                                    {
                                        "name": "Recherche et achat des goodies",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi du stock des goodies",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi du tri des déchets pour les locaux du PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Assistance à la préparation du budget du PRI et en suivre l'exécution",
                                        "value": 20
                                    },
                                    {
                                        "name": "Demandes de création de fournisseurs",
                                        "value": 50
                                    },
                                    {
                                        "name": "Demandes de devis auprès des fournisseurs",
                                        "value": 50
                                    },
                                    {
                                        "name": "Demandes d'achat",
                                        "value": 50
                                    },
                                    {
                                        "name": "Attestations de service fait",
                                        "value": 50
                                    },
                                    {
                                        "name": "Réception des marchandises",
                                        "value": 30
                                    },
                                    {
                                        "name": "Suivi budgétaire PRI",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accompagnement à l'établissement des demandes de BR",
                                        "value": 30
                                    },
                                    {
                                        "name": "Rédaction de l'analyse financière budget PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réservation des billets de train des agents",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réservation des hôtels des agents et chargés de missions",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réservation des restaurants pour évènements",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception des justificatifs pour les missions",
                                        "value": 20
                                    },
                                    {
                                        "name": "Accompagnement au recrutement des contrats étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception et tri du courrier",
                                        "value": 20
                                    },
                                    {
                                        "name": "Classification et archive des documents administratifs et financiers",
                                        "value": 30
                                    },
                                    {
                                        "name": "Commandes de fourniture au magasin général UPHF et gestion des stocks",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réalisation de l'accueil physique et l'accueil téléphonique",
                                        "value": 70
                                    },
                                    {
                                        "name": "Gestion de la logistique pour les réunions",
                                        "value": 30
                                    },
                                    {
                                        "name": "Courses pour les événements organisés au PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Recensement des besoins à l'année en heures des étudiants contrat région en accueil et informatique et assurer un suivi fin de la consommation à des fins de prospective",
                                        "value": 20
                                    },
                                    {
                                        "name": "Relevé des heures effectuées par les étudiants contrat région en accueil et informatique",
                                        "value": 20
                                    },
                                    {
                                        "name": "Demandes, réception des contrats étudiants et suivi des signatures avec la DRH",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi des états de paiement des contractuels étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Tri des archives administratives, en lien avec le service des archives",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion administrative des bourses Eiffel",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants étrangers conventionnés",
                                        "value": 40
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants sortants L M D UPHF et INSA",
                                        "value": 40
                                    },
                                    {
                                        "name": "Participation aux événements de l’université et du PRI : Cap Campus, Forum Demo, …",
                                        "value": 40
                                    },
                                    {
                                        "name": "Information sur les aspects financiers des mobilités sortantes",
                                        "value": 40
                                    },
                                    {
                                        "name": "Préparation des commissions d’attribution des financements de la mobilité internationale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion de la documentation liée à l’attribution des financements",
                                        "value": 40
                                    },
                                    {
                                        "name": "Promotion de la mobilité internationale et communication",
                                        "value": 50
                                    },
                                    {
                                        "name": "Mise à jour des documents de promotion, de Moodle et du site web IN et OUT",
                                        "value": 50
                                    },
                                    {
                                        "name": "Interface avec les partenaires extérieurs Ministère et Région quant aux financements de la mobilité internationale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi d'un mailchimp aux partenaires",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation aux actions de promotions des partenaires",
                                        "value": 20
                                    },
                                    {
                                        "name": "Reception des nominations",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi de la procédure de candidature aux étudiants nominés",
                                        "value": 30
                                    },
                                    {
                                        "name": "Traitement des candidatures",
                                        "value": 40
                                    },
                                    {
                                        "name": "Envoi des candidatures aux composantes",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion de la demande de visa pour les étudiants conventionnés sur la plateforme Etudes en France",
                                        "value": 20
                                    },
                                    {
                                        "name": "Revue dossier inscription et process avec scolarité",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi des dossiers d'inscription et suivi des étudiants ",
                                        "value": 30
                                    },
                                    {
                                        "name": "Vérification des dossiers d'inscription et transmission à la scolarité centrale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi des lettres d'acceptations",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion d’un contingent de logements CROUS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion de la convention CROUS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation international academy",
                                        "value": 20
                                    },
                                    {
                                        "name": "Collecte des informations de rentrée des composantes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Complétion des attestations d'arrivée des étudiants Erasmus+",
                                        "value": 20
                                    },
                                    {
                                        "name": "Complétion des attestations de présence des étudiants Erasmus+",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation d'une session de préparation à l'arrivée",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception des contrats pédagogiques et transmissions aux composantes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Renvoi des avenants aux composantes si PRI destinataire ",
                                        "value": 20
                                    },
                                    {
                                        "name": "Récolte des notes du semestre",
                                        "value": 20
                                    },
                                    {
                                        "name": "Edition des Relevés de notes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Mise en place calendrier promotionnel Etudes annuel (remontée par les composantes après sollicitation)",
                                        "value": 20
                                    },
                                    {
                                        "name": "Erasmus Days Préparation",
                                        "value": 30
                                    },
                                    {
                                        "name": "Erasmus Days Evénement",
                                        "value": 40
                                    },
                                    {
                                        "name": "MAJ des ppt promotionnels Pourquoi partir,  Constituer son dossier, Canada",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accompagnement au recrutement des contrats étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception et tri du courrier",
                                        "value": 20
                                    },
                                    {
                                        "name": "Classification et archive des documents administratifs et financiers",
                                        "value": 30
                                    },
                                    {
                                        "name": "Commandes de fourniture au magasin général UPHF et gestion des stocks",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réalisation de l'accueil physique et l'accueil téléphonique",
                                        "value": 70
                                    },
                                    {
                                        "name": "Gestion de la logistique pour les réunions",
                                        "value": 30
                                    },
                                    {
                                        "name": "Courses pour les événements organisés au PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Recensement des besoins à l'année en heures des étudiants contrat région en accueil et informatique et assurer un suivi fin de la consommation à des fins de prospective",
                                        "value": 20
                                    },
                                    {
                                        "name": "Relevé des heures effectuées par les étudiants contrat région en accueil et informatique",
                                        "value": 20
                                    },
                                    {
                                        "name": "Demandes, réception des contrats étudiants et suivi des signatures avec la DRH",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi des états de paiement des contractuels étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Tri des archives administratives, en lien avec le service des archives",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion administrative des bourses Eiffel",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants étrangers conventionnés",
                                        "value": 40
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants sortants L M D UPHF et INSA",
                                        "value": 40
                                    },
                                    {
                                        "name": "Participation aux événements de l’université et du PRI : Cap Campus, Forum Demo, …",
                                        "value": 40
                                    },
                                    {
                                        "name": "Information sur les aspects financiers des mobilités sortantes",
                                        "value": 40
                                    },
                                    {
                                        "name": "Préparation des commissions d’attribution des financements de la mobilité internationale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accompagnement au recrutement des contrats étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception et tri du courrier",
                                        "value": 20
                                    },
                                    {
                                        "name": "Classification et archive des documents administratifs et financiers",
                                        "value": 30
                                    },
                                    {
                                        "name": "Commandes de fourniture au magasin général UPHF et gestion des stocks",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réalisation de l'accueil physique et l'accueil téléphonique",
                                        "value": 70
                                    },
                                    {
                                        "name": "Gestion de la logistique pour les réunions",
                                        "value": 30
                                    },
                                    {
                                        "name": "Courses pour les événements organisés au PRI",
                                        "value": 20
                                    },
                                    {
                                        "name": "Recensement des besoins à l'année en heures des étudiants contrat région en accueil et informatique et assurer un suivi fin de la consommation à des fins de prospective",
                                        "value": 20
                                    },
                                    {
                                        "name": "Relevé des heures effectuées par les étudiants contrat région en accueil et informatique",
                                        "value": 20
                                    },
                                    {
                                        "name": "Demandes, réception des contrats étudiants et suivi des signatures avec la DRH",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi des états de paiement des contractuels étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Tri des archives administratives, en lien avec le service des archives",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion administrative des bourses Eiffel",
                                        "value": 30
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants étrangers conventionnés",
                                        "value": 40
                                    },
                                    {
                                        "name": "Accueil physique et accompagnement des étudiants sortants L M D UPHF et INSA",
                                        "value": 40
                                    },
                                    {
                                        "name": "Participation aux événements de l’université et du PRI : Cap Campus, Forum Demo, …",
                                        "value": 40
                                    },
                                    {
                                        "name": "Information sur les aspects financiers des mobilités sortantes",
                                        "value": 40
                                    },
                                    {
                                        "name": "Préparation des commissions d’attribution des financements de la mobilité internationale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion de la documentation liée à l’attribution des financements",
                                        "value": 40
                                    },
                                    {
                                        "name": "Promotion de la mobilité internationale et communication",
                                        "value": 50
                                    },
                                    {
                                        "name": "Mise à jour des documents de promotion, de Moodle et du site web IN et OUT",
                                        "value": 50
                                    },
                                    {
                                        "name": "Interface avec les partenaires extérieurs Ministère et Région quant aux financements de la mobilité internationale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi d'un mailchimp aux partenaires",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation aux actions de promotions des partenaires",
                                        "value": 20
                                    },
                                    {
                                        "name": "Reception des nominations",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi de la procédure de candidature aux étudiants nominés",
                                        "value": 30
                                    },
                                    {
                                        "name": "Traitement des candidatures",
                                        "value": 40
                                    },
                                    {
                                        "name": "Envoi des candidatures aux composantes",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion de la demande de visa pour les étudiants conventionnés sur la plateforme Etudes en France",
                                        "value": 20
                                    },
                                    {
                                        "name": "Revue dossier inscription et process avec scolarité",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi des dossiers d'inscription et suivi des étudiants",
                                        "value": 30
                                    },
                                    {
                                        "name": "Vérification des dossiers d'inscription et transmission à la scolarité centrale",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi des lettres d'acceptations",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion d’un contingent de logements CROUS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Gestion de la convention CROUS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation international academy",
                                        "value": 20
                                    },
                                    {
                                        "name": "Collecte des informations de rentrée des composantes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Complétion des attestations d'arrivée des étudiants Erasmus+",
                                        "value": 20
                                    },
                                    {
                                        "name": "Complétion des attestations de présence des étudiants Erasmus+",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation d'une session de préparation à l'arrivée",
                                        "value": 20
                                    },
                                    {
                                        "name": "Réception des contrats pédagogiques et transmissions aux composantes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Renvoi des avenants aux composantes si PRI destinataire",
                                        "value": 20
                                    },
                                    {
                                        "name": "Récolte des notes du semestre",
                                        "value": 20
                                    },
                                    {
                                        "name": "Edition des Relevés de notes",
                                        "value": 20
                                    },
                                    {
                                        "name": "Mise en place calendrier promotionnel Etudes annuel (remontée par les composantes après sollicitation)",
                                        "value": 20
                                    },
                                    {
                                        "name": "Erasmus Days Préparation",
                                        "value": 30
                                    },
                                    {
                                        "name": "Erasmus Days Evénement",
                                        "value": 40
                                    },
                                    {
                                        "name": "MAJ des ppt promotionnels Pourquoi partir, Constituer son dossier, Canada",
                                        "value": 30
                                    },
                                    {
                                        "name": "Maj info Canada (immigration, BCI",
                                        "value": 20
                                    },
                                    {
                                        "name": "MAJ site web (financements, étapes…)",
                                        "value": 30
                                    },
                                    {
                                        "name": "MAJ des todolist Etudes et stages",
                                        "value": 40
                                    },
                                    {
                                        "name": "MAJ des documents financements: contrats de mobilité, contrats pédagogiques hors europe et SMT, formulaires allocations SMS SMT, attestation arrivée et présence",
                                        "value": 40
                                    },
                                    {
                                        "name": "Gestion des procédures et de leur suivi auprès des étudiants sortants UPHF et INSA",
                                        "value": 40
                                    },
                                    {
                                        "name": "Nomination auprès des partenaires",
                                        "value": 30
                                    },
                                    {
                                        "name": "Gestion plateforme BCI du programme PQEE",
                                        "value": 30
                                    },
                                    {
                                        "name": "Team JEKI formulaires publicateur back office moveon",
                                        "value": 40
                                    },
                                    {
                                        "name": "Gestion des mobilité dans moveon: fiches séjours, suivi et MAJ",
                                        "value": 40
                                    },
                                    {
                                        "name": "Edition contrats de mobilité",
                                        "value": 20
                                    },
                                    {
                                        "name": "Sessions préparation au départ pour les études et le stage",
                                        "value": 40
                                    },
                                    {
                                        "name": "Canada-Québec: Protocoles d'entente RAMQ AMELI",
                                        "value": 30
                                    },
                                    {
                                        "name": "Récolter les lettres d'admission ou courriels d'admission",
                                        "value": 20
                                    },
                                    {
                                        "name": "Conseils et orientation des étudiants tout au long du processus",
                                        "value": 40
                                    },
                                    {
                                        "name": "Suivi des contrats pédagogiques et de leurs avenants et des OLA des étudiants LMD UPHF et INSA",
                                        "value": 40
                                    },
                                    {
                                        "name": "Récolter les relevés de notes des étudiants après la mobilité sortante",
                                        "value": 30
                                    },
                                    {
                                        "name": "Envoi attestation d'arrivée aux étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Récolte attestations d'arrivée",
                                        "value": 20
                                    },
                                    {
                                        "name": "Envoi attestation de présence aux étudiants",
                                        "value": 20
                                    },
                                    {
                                        "name": "Récolte attestations de présence d'arrivée",
                                        "value": 20
                                    },
                                    {
                                        "name": "Rapport de mobilité E+: envoi message aux étudiants et action plateforme",
                                        "value": 20
                                    },
                                    {
                                        "name": "Reporting Mobility Tool",
                                        "value": 10
                                    },
                                    {
                                        "name": "Financements: national AMI bilan financier + enquête annuelle",
                                        "value": 30
                                    },
                                    {
                                        "name": "Financements: région MERMOZ bilan financier + enquête annuelle",
                                        "value": 30
                                    },
                                    {
                                        "name": "Prise de contact avec les universités et participer à la formalisation des accords BRIDGE",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation des appels à candidatures pour les étudiants sortants et les stages entrants BRIDGE",
                                        "value": 30
                                    },
                                    {
                                        "name": "Organisation des réunions d'informations auprès des enseignants-chercheurs et/ou d'étudiants BRIDGE",
                                        "value": 20
                                    },
                                    {
                                        "name": "Accueil des stagiaires entrants BRIDGE",
                                        "value": 30
                                    },
                                    {
                                        "name": "Organisation et planification des formations MoveOn pour les utilisateurs en lien avec les référents MoveOn de l’établissement",
                                        "value": 20
                                    },
                                    {
                                        "name": "Suivi les actualités et les nouvelles fonctionnalités MoveOn",
                                        "value": 30
                                    },
                                    {
                                        "name": "Organisation des réunions avec les utilisateurs MoveOn",
                                        "value": 20
                                    },
                                    {
                                        "name": "Paramétrage de la base Moveon INSA HdF en fonction des besoins",
                                        "value": 30
                                    },
                                    {
                                        "name": "Encadrement de contrat région dont les missions sont reliées à MoveOn",
                                        "value": 20
                                    },
                                    {
                                        "name": "Faire le lien entre le support et la base MoveOn INSA",
                                        "value": 30
                                    },
                                    {
                                        "name": "Production de documentation pour aider les utilisateurs Moveon",
                                        "value": 30
                                    },
                                    {
                                        "name": "Contribution à la sous-équipe PRI en charge du développement et des problématiques liées à MoveOn",
                                        "value": 30
                                    },
                                    {
                                        "name": "Suivi la ligne budgétaire du soutien organisationnel KA131 INSA",
                                        "value": 30
                                    },
                                    {
                                        "name": "Déclaration des mobilités sur le Beneficiary Module KA131 INSA",
                                        "value": 20
                                    },
                                    {
                                        "name": "Rédaction des rapports intermédiaires et finaux KA131 INSA",
                                        "value": 20
                                    },
                                    {
                                        "name": "Représentation de l’université lors de rencontres avec des partenaires et des bailleurs",
                                        "value": 40
                                    },
                                    {
                                        "name": "Conseils aux porteurs de projets dans la définition et l’écriture de projets en lien avec le Royaume-Uni",
                                        "value": 20
                                    },
                                    {
                                        "name": "Faire la liaison avec la Cellule Mobilité sur les partenariats comprenant des volets de mobilité",
                                        "value": 30
                                    },
                                    {
                                        "name": "Développement et le suivi des partenariats, principalement hors Europe",
                                        "value": 20
                                    },
                                    {
                                        "name": "Pilotage des activités d’animation et de communication du PRI pour sensibiliser aux questions de coopération internationale",
                                        "value": 20
                                    },
                                    {
                                        "name": "Faire le montage et le suivi des accords de collaboration avec les universités partenaires hors Europe",
                                        "value": 20
                                    },
                                    {
                                        "name": "Contribution au développement de nouveaux modèles de partenariat pour des coopérations innovantes, en cohérence avec la politique de l'établissement",
                                        "value": 30
                                    },
                                    {
                                        "name": "Conseil aux porteurs de projets dans la définition et l’écriture de projets européens et internationaux",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation à l'exécution des projets en gestion au PRI : IUMEME",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation à l'exécution des projets en gestion au PRI : EFEU",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation à l'exécution des projets en gestion au PRI : SCALENEO",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation à l'exécution des projets en gestion au PRI : EUNICE4U",
                                        "value": 30
                                    },
                                    {
                                        "name": "Création de documents visant à améliorer la productivité du PRI",
                                        "value": 30
                                    },
                                    {
                                        "name": "Intervention ponctuellement sur tout type de projet en soutien",
                                        "value": 30
                                    },
                                    {
                                        "name": "Coordination du projet : IUMEME",
                                        "value": 20
                                    },
                                    {
                                        "name": "Accompagnement des doctorants et enseignants-chercheurs étrangers pour toutes questions d’ordre administratif et pratique relatives à la préparation de leur séjour et de leur installation à Valenciennes EURAXESS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Travail en étroite collaboration avec l’OFII et la Préfecture pour les demandes de titres de séjour EURAXESS",
                                        "value": 10
                                    },
                                    {
                                        "name": "Coordination des activités du projet EUNICE4U à l’UPHF et au niveau de la Project Management Team de l’alliance EUNICE",
                                        "value": 20
                                    },
                                    {
                                        "name": "Coordination des acteurs et des comités du projet en interne : cellule EUNICE, groupes opérationnels, comité de qualité, comités de conseil et de pilotage, etc.",
                                        "value": 20
                                    },
                                    {
                                        "name": "Mise en oeuvre et suivi des indicateurs en lien avec le pilote du projet EUNICE au sein de l’UPHF",
                                        "value": 30
                                    },
                                    {
                                        "name": "Participation à la rédaction des livrables et des rapports d’activité trimestriels, à leur vérification et dépôt",
                                        "value": 30
                                    },
                                    {
                                        "name": "Transmettre les sollicitations du personnel et des étudiants concernant les opportunités EUNICE",
                                        "value": 20
                                    },
                                    {
                                        "name": "Soutien autres groupes de travail du projet EUNICE4U",
                                        "value": 30
                                    },
                                    {
                                        "name": "Participation à l’organisation d’événements à l’UPHF",
                                        "value": 60
                                    },
                                    {
                                        "name": "Co-organisation de la semaine internationale de l'IAE",
                                        "value": 20
                                    },
                                    {
                                        "name": "Organisation d'activités et programmes visant à l’accompagnement des publics EURAXESS",
                                        "value": 20
                                    },
                                    {
                                        "name": "Participation aux événements et groupes de travail mis en place par EURAXESS France",
                                        "value": 20
                                    },
                                    {
                                        "name": "Mise en place d'une communication relative au Centre EURAXESS de l’UPHF",
                                        "value": 20
                                    },
                                    {
                                        "name": "Accompagnement des doctorants et enseignants-chercheurs étrangers",
                                        "value": 10
                                    }

                                ].
                                slice(0, limit)
                            };

                            if (doShuffle) {
                                json.children = _.shuffle(json.children);
                            }
                            const values = json.children.map(d => d.value);
                            const min = Math.min.apply(null, values);
                            const max = Math.max.apply(null, values);
                            const total = json.children.length;

                            document.body.style.backgroundColor = bgColor;

                            var diameter = 600,
                                color = d3.scaleOrdinal(d3.schemeCategory20c);

                            var bubble = d3.pack().
                            size([diameter, diameter]).
                            padding(0);

                            var tip = d3.tip().
                            attr('class', 'd3-tip-outer').
                            offset([-38, 0]).
                            html((d, i) => {
                                const item = json.children[i];
                                const color = getColor(i, values.length);
                                return `<div class="d3-tip" style="background-color: ${color}">${item.name} (${item.value})</div><div class="d3-stem" style="border-color: ${color} transparent transparent transparent"></div>`;
                            });


                            var margin = {
                                left: 25,
                                right: 25,
                                top: 25,
                                bottom: 25
                            };


                            var svg = d3.select('#chart').append('svg').
                            attr('viewBox', '0 0 ' + (diameter + margin.right) + ' ' + diameter).
                            attr('width', diameter + margin.right).
                            attr('height', diameter).
                            attr('class', 'chart-svg');

                            var root = d3.hierarchy(json).
                            sum(function(d) {
                                return d.value;
                            });
                            // .sort(function(a, b) { return b.value - a.value; });

                            bubble(root);

                            var node = svg.selectAll('.node').
                            data(root.children).
                            enter().
                            append('g').attr('class', 'node').
                            attr('transform', function(d) {
                                return 'translate(' + d.x + ' ' + d.y + ')';
                            }).
                            append('g').attr('class', 'graph');

                            node.append("circle").
                            attr("r", function(d) {
                                return d.r;
                            }).
                            style("fill", getItemColor).
                            on('mouseover', tip.show).
                            on('mouseout', tip.hide);

                            node.call(tip);

                            node.append("text").
                            attr("dy", "0.2em").
                            style("text-anchor", "middle").
                            style('font-family', 'Roboto').
                            style('font-size', getFontSizeForItem).
                            text(getLabel).
                            style("fill", "#ffffff").
                            style('pointer-events', 'none');

                            node.append("text").
                            attr("dy", "1.3em").
                            style("text-anchor", "middle").
                            style('font-family', 'Roboto').
                            style('font-weight', '100').
                            style('font-size', getFontSizeForItem).
                            text(getValueText).
                            style("fill", "#ffffff").
                            style('pointer-events', 'none');

                            function getItemColor(item) {
                                return getColor(idx++, json.children.length);
                            }

                            function getColor(idx, total) {
                                const colorList = ['F05A24', 'EF4E4A', 'EE3F65', 'EC297B', 'E3236C', 'D91C5C', 'BC1E60',
                                    '9E1F63',
                                    '992271',
                                    '952480', '90278E', '7A2A8F', '652D90', '502980', '3B2671', '262261', '27286D',
                                    '292D78',
                                    '2A3384',
                                    '2B388F', '2A4F9F', '2965AF', '277CC0', '2692D0', '25A9E0'
                                ];
                                const colorLookup = [
                                    [0, 4, 10, 18, 24],
                                    [0, 3, 6, 9, 11, 13, 15, 18, 20, 24],
                                    [0, 3, 4, 6, 7, 9, 11, 13, 14, 15, 17, 18, 20, 22, 24],
                                    [0, 2, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14, 15, 17, 18, 19, 20, 22, 23, 24],
                                    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
                                        23, 24
                                    ]
                                ];

                                for (const idxList of colorLookup) {
                                    if (idxList.length >= total) {
                                        return '#' + colorList[idxList[idx]];
                                    }
                                }
                            }



                            // function getColor(idx, total) {
                            //   const start = 14;
                            //   const end = 210;
                            //   const interval = Math.min(18, (end - start) / total);
                            //   let hue = start - Math.round(interval * idx);
                            //   if (hue > 360) {
                            //     hue -= 360;
                            //   }
                            //   if (hue < 0) {
                            //     hue += 360;
                            //   }
                            //   return `hsl(${hue},${sat}%,${lum}%)`;
                            // }
                            function getLabel(item) {
                                if (item.data.value < max / 3.3) {
                                    return '';
                                }
                                return truncate(item.data.name);
                            }

                            function getValueText(item) {
                                if (item.data.value < max / 3.3) {
                                    return '';
                                }
                                return item.data.value;
                            }

                            function truncate(label) {
                                const max = 11;
                                if (label.length > max) {
                                    label = label.slice(0, max) + '...';
                                }
                                return label;
                            }

                            function getFontSizeForItem(item) {
                                return getFontSize(item.data.value, min, max, total);
                            }

                            function getFontSize(value, min, max, total) {
                                const minPx = 6;
                                const maxPx = 25;
                                const pxRange = maxPx - minPx;
                                const dataRange = max - min;
                                const ratio = pxRange / dataRange;
                                const size = Math.min(maxPx, Math.round(value * ratio) + minPx);
                                return `${size}px`;
                            }
                        }
                        //# sourceURL=pen.js
                    </script>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
