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
    </div>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script>
        /* ---------- Sumber data dari Laravel ---------- */
        const activityData = {!!$datavisual!!};

        /* ---------- Helper: ubah flat ➜ hierarchical ---------- */
        function toHierarchy(data) {
            const root = {
                name: "sector",
                children: []
            };
            const bySector = d3.group(data, d => d.sector);
            for (const [sector, rows] of bySector) {
                const sectorNode = {
                    name: sector,
                    children: []
                };
                rows.forEach(r => {
                    const subs = r.subsector.split(', ');
                    const descs = r.deskripsi.split(', ');
                    subs.forEach((s, i) => {
                        sectorNode.children.push({
                            name: s,
                            children: [{
                                name: descs[i] ?? '(no description)',
                                value: 1
                            }]
                        });
                    });
                });
                root.children.push(sectorNode);
            }
            return root;
        }

        /* ---------- Chart parameters ---------- */
        const margin = {
            top: 20,
            right: 0,
            bottom: 20,
            left: 0
        };
        let width = document.getElementById('chart').clientWidth;
        let height = 600; // tinggi awal; akan dihitung ulang
        const duration = 750;

        /* ---------- Dropdown & render ---------- */
        const select = document.querySelector('#limit');
        select.addEventListener('change', render);
        window.addEventListener('resize', () => {
            width = document.getElementById('chart').clientWidth;
            render(); // responsif
        });
        render();

        /* ---------- Fungsi render utama ---------- */
        function render() {
            const filter = select.value;
            let filtered = (filter === 'All') ? activityData :
                activityData.filter(d => d.sector === filter);

            // Hapus SVG lama
            d3.select('#chart').selectAll('svg').remove();

            // Buat hierarki & layout
            const data = toHierarchy(filtered);
            const root = d3.hierarchy(data).sum(d => d.value || 0.0001)
                .sort((a, b) => b.height - a.height || b.value - a.value);
            const partition = d3.partition()
                .size([height, (root.height + 1) * width / 3]);
            partition(root);

            // Warna (hue rain-bow per sektor)
            const color = d3.scaleOrdinal(d3.quantize(d3.interpolateRainbow,
                root.children.length + 1));

            // Container SVG
            const svg = d3.select('#chart')
                .append('svg')
                .attr('viewBox', [0, 0, width, height + margin.top + margin.bottom])
                .attr('width', width)
                .attr('height', height + margin.top + margin.bottom)
                .style('font', '11px sans-serif');

            const g = svg.append('g').attr('transform', `translate(${margin.left},${margin.top})`);

            /* ---------- Cell ---------- */
            const cell = g.selectAll('g')
                .data(root.descendants())
                .join('g')
                .attr('transform', d => `translate(${d.y0},${d.x0})`);

            const rect = cell.append('rect')
                .attr('width', d => d.y1 - d.y0 - 1)
                .attr('height', d => rectHeight(d))
                .attr('fill-opacity', 0.6)
                .attr('fill', d => {
                    if (!d.depth) return '#ccc';
                    let p = d;
                    while (p.depth > 1) p = p.parent;
                    return color(p.data.name);
                })
                .style('cursor', 'pointer')
                .on('click', clicked);

            /* ---------- Label ---------- */
            const text = cell.append('text')
                .attr('x', 4)
                .attr('y', 13)
                .attr('pointer-events', 'none')
                .attr('fill-opacity', d => +labelVisible(d));

            text.append('tspan').text(d => d.data.name);
            const format = d3.format(',d');
            text.append('tspan')
                .attr('fill-opacity', d => labelVisible(d) * 0.7)
                .text(d => d.value ? ` ${format(d.value)}` : '');

            /* ---------- Tooltip via title ---------- */
            cell.append('title')
                .text(d => `${d.ancestors().map(d => d.data.name).reverse().join('/')}\n${format(d.value || 0)}`);

            /* ---------- Interaksi zoom (klik) ---------- */
            let focus = root;

            function clicked(event, p) {
                focus = focus === p ? p = p.parent ?? root : p;

                root.each(d => d.target = {
                    x0: (d.x0 - p.x0) / (p.x1 - p.x0) * height,
                    x1: (d.x1 - p.x0) / (p.x1 - p.x0) * height,
                    y0: d.y0 - p.y0,
                    y1: d.y1 - p.y0
                });

                const t = cell.transition().duration(duration)
                    .attr('transform', d => `translate(${d.target.y0},${d.target.x0})`);

                rect.transition(t).attr('height', d => rectHeight(d.target));
                text.transition(t).attr('fill-opacity', d => +labelVisible(d.target));
            }

            /* ---------- Helper ---------- */
            function rectHeight(d) {
                return d.x1 - d.x0 - Math.min(1, (d.x1 - d.x0) / 2);
            }

            function labelVisible(d) {
                return d.y1 - d.y0 > 60 && d.x1 - d.x0 > 16;
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