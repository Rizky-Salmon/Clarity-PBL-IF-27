@extends('layouts.admin')

@section('title', 'Interactive Visualization')

@push('head-script')
<script
    src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
</script>
<title>CodePen - D3 Packed Bubble Chart</title>
<link rel="canonical" href="https://codepen.io/kendsnyder/pen/vPmQbY">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="frappe-gantt.css">
<style>
    @import url("https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i");

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

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
        width: 30px;
        height: 1px;
        margin: 0 auto;
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
    }

    .label {
        fill: #000;
    }

    .chart {
        margin: 0 auto;
        max-width: 300px;
    }

    .chart-svg {
        width: 100%;
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
            <i class="fa-solid fa-clipboard-list fa-lg me-2"></i>
            Overall Activity
        </h4>
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-fw fa-chart-area"></i>
            Data Visualization
        </h1>
    </div>
    <!-- Chart Canvas -->
    <div id="container"></div>

    <!-- Chart.js Library -->
    <!-- TAMPUNG CHART -->
    <div id="chart"></div>

    <!-- D3 -->
    <script src="https://d3js.org/d3.v7.min.js"></script>
<script>
    var activityData = {!! $datavisual !!};

    // 1. Convert ke hirarki untuk Sunburst
    const data = {
        name: "Activities",
        children: activityData.map(act => {
            const employees = (act.employee_names || "")
                .split(",")
                .map(e => e.trim())
                .filter(e => e.length);

            return {
                name: act.activity_name,
                children: employees.length ?
                    employees.map(emp => ({
                        name: emp,
                        value: 1
                    })) :
                    [{
                        name: "No Employee",
                        value: 1
                    }]
            };
        })
    };

    // 2. Setup SVG & Partition
    const width = 600;
    const radius = width / 12;

    const root = d3.hierarchy(data).sum(d => d.value).sort((a, b) => b.value - a.value);
    const partition = d3.partition().size([2 * Math.PI, root.height + 1]);
    partition(root);
    root.each(d => d.current = d);

    const color = d3.scaleOrdinal(d3.quantize(d3.interpolateRainbow, root.children.length + 1));
    const arc = d3.arc()
        .startAngle(d => d.x0)
        .endAngle(d => d.x1)
        .padAngle(d => Math.min((d.x1 - d.x0) / 2, 0.005))
        .padRadius(radius * 1.5)
        .innerRadius(d => d.y0 * radius)
        .outerRadius(d => Math.max(d.y0 * radius, d.y1 * radius - 1));

    const svg = d3.select("#chart").append("svg")
        .attr("viewBox", [-300, -150, 600, 320])
        .style("font", "12px sans-serif");

    const g = svg.append("g");

    const path = g.append("g")
        .selectAll("path")
        .data(root.descendants().slice(1))
        .join("path")
        .attr("fill", d => {
            while (d.depth > 1) d = d.parent;
            return color(d.data.name);
        })
        .attr("d", d => arc(d.current));

    path.append("title")
        .text(d => `${d.ancestors().map(d => d.data.name).reverse().join("/")}
${d.value}`);

    path.filter(d => d.children)
        .style("cursor", "pointer")
        .on("click", clicked);

    const label = g.append("g")
        .attr("pointer-events", "none")
        .attr("text-anchor", "middle")
        .selectAll("text")
        .data(root.descendants().slice(1))
        .join("text")
        .attr("dy", "0.35em")
        .attr("fill-opacity", d => +labelVisible(d.current))
        .attr("transform", d => labelTransform(d.current))
        .style("font-size", "6px")
        .text(d => d.data.name.length > 11 ? d.data.name.slice(0, 11) + "…" : d.data.name);

    const parent = g.append("circle")
        .datum(root)
        .attr("r", radius)
        .attr("fill", "none")
        .attr("pointer-events", "all")
        .on("click", clicked);

    // 3. Klik untuk zoom
    function clicked(event, p) {
        parent.datum(p.parent || root);

        root.each(d => d.target = {
            x0: Math.max(0, Math.min(1, (d.x0 - p.x0) / (p.x1 - p.x0))) * 2 * Math.PI,
            x1: Math.max(0, Math.min(1, (d.x1 - p.x0) / (p.x1 - p.x0))) * 2 * Math.PI,
            y0: Math.max(0, d.y0 - p.depth),
            y1: Math.max(0, d.y1 - p.depth)
        });

        const t = g.transition().duration(750);

        path.transition(t)
            .tween("data", d => {
                const i = d3.interpolate(d.current, d.target);
                return t => d.current = i(t);
            })
            .attrTween("d", d => () => arc(d.current));

        label.transition(t)
            .attr("fill-opacity", d => +labelVisible(d.target))
            .attrTween("transform", d => () => labelTransform(d.current));
    }

    function labelVisible(d) {
        return d.y1 <= 3 && d.y0 >= 1 && (d.y1 - d.y0) * (d.x1 - d.x0) > 0.03;
    }

    function labelTransform(d) {
        const x = (d.x0 + d.x1) / 2 * 180 / Math.PI;
        const y = (d.y0 + d.y1) / 2 * radius;
        return `rotate(${x - 90}) translate(${y},0) rotate(${x < 180 ? 0 : 180})`;
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