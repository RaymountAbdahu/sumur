<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard – ReservoirGambut.id</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('temp/file/assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    @vite('resources/js/app.js')

    <!-- THEME -->
    <style>
        :root {
            --bg: #0f172a;
            --surface: #1e293b;
            --glass: rgba(30, 41, 59, .72);
            --border: #334155;
            --text: #f1f5f9;
            --muted: #94a3b8;
            --accent: #22d3ee;
            --water-a: #0ea5e9;
            --water-b: #38bdf8;
            --success: #4ade80;
            --warn: #facc15;
            --alert: #fb923c;
            --danger: #f87171;
        }

        body.g-sidenav-show {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
        }

        .main-content {
            background-image: linear-gradient(rgba(51, 65, 85, .15) 1px, transparent 1px),
                linear-gradient(90deg, rgba(51, 65, 85, .15) 1px, transparent 1px);
            background-size: 32px 32px;
            padding: 1.5rem;
        }

        h2 {
            font-size: 2rem;
        }

        .card-glass {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            color: var(--text);
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .card-glass:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .2);
        }

        .card-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h6 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: white;
        }

        .card-header time {
            font-size: 0.8rem;
            color: var(--muted);
        }

        .reservoir {
            display: flex;
            align-items: flex-end;
            gap: .75rem;
            height: 280px;
        }

        .scale {
            position: relative;
            width: 3rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
        }

        .scale span {
            position: relative;
            display: inline-block;
            padding-left: 0.25rem;
        }

        .scale span::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -8px;
            width: 8px;
            height: 1px;
            background: var(--border);
        }

        .well {
            position: relative;
            width: 110px;
            height: 100%;
            border: 2px solid var(--border);
            border-top: none;
            background: repeating-linear-gradient(0deg, rgba(100, 116, 139, .15) 0 1px, transparent 1px 30px);
            border-radius: 0 0 1rem 1rem;
            overflow: hidden;
        }

        .water {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, var(--water-a), var(--water-b));
            height: 0;
            transition: height .8s cubic-bezier(.4, .8, .4, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #0f172a;
            font-size: 0.95rem;
        }

        .water::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 6px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, .6), transparent);
        }

        .led {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #475569;
            box-shadow: 0 0 0 transparent;
            transition: .25s;
        }

        .led.active {
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent);
        }

        .st-success {
            color: var(--success);
        }

        .st-warn {
            color: var(--warn);
        }

        .st-alert {
            color: var(--alert);
        }

        .st-danger {
            color: var(--danger);
        }

        .st-unknown {
            color: var(--muted);
        }

        @media(max-width:991px) {
            .reservoir {
                height: 220px;
            }
        }

        @media(max-width:767px) {
            body.g-sidenav-show .sidenav {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body class="g-sidenav-show">
    @include('sidebar')
    <main class="main-content border-radius-lg ps-3 pe-3">
        <header class="d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
            <div>
                <h2 class="text-white fw-bold mb-0">Dashboard</h2>
            </div>
        </header>
        <section class="container-fluid pb-4">
            <div class="row g-4">
                @foreach ([1, 2] as $id)
                    <div class="col-12 col-lg-6">
                        <article class="card card-glass h-100">
                            <div class="card-header">
                                <h6>Sumur Reservoir {{ $id }}</h6>
                                <div class="mb-3">
                                    <p class="text-muted text-xs fw-semibold text-uppercase mb-1">Waktu</p>
                                    <time id="waktu-{{ $id }}" class="text-sm text-white">--</time>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reservoir">
                                            <div class="scale">
                                                @foreach ([100, 80, 60, 40, 20, 0] as $m)
                                                    <span>{{ $m }}%</span>
                                                @endforeach
                                            </div>
                                            <div class="well">
                                                <div id="water-{{ $id }}" class="water">--%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column">
                                        <div class="mb-3">
                                            <p class="text-muted text-xs fw-semibold text-uppercase mb-1">Status</p>
                                            <h4 id="status-{{ $id }}" class="fw-bold st-unknown mb-0">--</h4>
                                        </div>
                                        <div class="mb-3">
                                            <p class="text-muted text-xs fw-semibold text-uppercase mb-1">Level Air</p>
                                            <h4 id="pct-{{ $id }}" class="fw-bold mb-0">--</h4>
                                        </div>
                                        <div class="mt-auto pt-3 border-top">
                                            @for ($s = 1; $s <= 5; $s++)
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="text-xs">Sensor {{ $s }}</span>
                                                    <span id="led-{{ $id }}-{{ $s }}"
                                                        class="led"></span>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <script src="{{ asset('temp/file/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/core/bootstrap.min.js') }}"></script>
    <script type="module">
        const mapStatus = st => ({
            Bahaya: 'st-danger',
            Siaga: 'st-alert',
            Waspada: 'st-warn',
            Aman: 'st-success'
        })[st] || 'st-unknown';

        function paint(id, d = {}) {
            const pct = Math.round(d.waterLevelPercent || 0);
            const elWater = document.getElementById(`water-${id}`);
            elWater.style.height = `${pct}%`;
            elWater.textContent = `${pct}%`;

            const stEl = document.getElementById(`status-${id}`);
            stEl.textContent = d.status || '--';
            stEl.className = `fw-bold ${mapStatus(d.status)}`;

            document.getElementById(`pct-${id}`).textContent = `${pct}%`;

            // 💡 Format waktu dari database ke format lokal (Contoh: 06 Jul 2025, 17:39 WIB)
            const waktuEl = document.getElementById(`waktu-${id}`);
            if (d.waktu) {
                const date = new Date(d.waktu);
                waktuEl.textContent = date.toLocaleString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }) + ' WIB';
            } else {
                waktuEl.textContent = '--';
            }

            for (let s = 1; s <= 5; s++) {
                document.getElementById(`led-${id}-${s}`).classList.toggle('active', !!d[`sensor${s}`]);
            }
        }

        paint(1, {
            ...@json($latestData1),
            waterLevelPercent: @json($waterLevelPercent1)
        });
        paint(2, {
            ...@json($latestData2),
            waterLevelPercent: @json($waterLevelPercent2)
        });

        window.Echo?.channel('water-level-channel').listen('.new-data', e => {
            if (e.data.catatan === 'Sumur Reservoir 1') paint(1, e.data);
            if (e.data.catatan === 'Sumur Reservoir 2') paint(2, e.data);
        });
    </script>
</body>

</html>
