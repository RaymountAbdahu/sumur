<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Riwayat Data – ReservoirGambut.id</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('temp/file/assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    @vite('resources/js/app.js')

    <style>
        :root {
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-glass: rgba(30, 41, 59, .75);
            --border: #334155;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --accent: #4fd1c5;
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

        .card-glass {
            background: var(--surface-glass);
            backdrop-filter: blur(14px);
            border: 1px solid var(--border);
            border-radius: 1rem;
            color: var(--text);
            overflow: hidden;
        }

        .card-header {
            border-bottom: 1px solid var(--border);
            background: var(--surface);
            padding: 1rem 1.25rem;
        }

        h2,
        h5,
        h6 {
            margin: 0;
        }

        .filter-btn .btn {
            font-size: .78rem;
            padding: .35rem 1rem;
            border: 1px solid var(--border);
            color: var(--muted);
            background: transparent;
            transition: .25s;
        }

        .filter-btn .btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .filter-btn .active {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--bg);
            font-weight: 600;
        }

        .table thead th {
            color: var(--accent);
            text-transform: uppercase;
            font-size: .7rem;
            border-bottom: 2px solid var(--border);
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .2s ease-in-out;
        }

        .table tbody tr:hover {
            background: rgba(79, 209, 197, .06);
        }

        .table td {
            color: var(--muted);
            font-size: 0.875rem;
        }

        .table .dt {
            color: var(--text);
        }

        .badge {
            display: inline-block;
            padding: .35em .7em;
            border-radius: .375rem;
            font-size: .75rem;
            font-weight: 700;
            color: var(--bg);
        }

        .badge-aman {
            background: var(--success);
        }

        .badge-waspada {
            background: var(--warn);
        }

        .badge-siaga {
            background: var(--alert);
        }

        .badge-bahaya {
            background: var(--danger);
            color: #fff;
        }

        .pagination .page-link {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            border-radius: .375rem;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--bg);
        }

        .pagination .page-item:not(.active) .page-link:hover {
            background: rgba(79, 209, 197, .1);
            border-color: rgba(79, 209, 197, .4);
        }

        .pagination .page-item.disabled .page-link {
            color: #475569;
            border-color: #273549;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .new-row {
            animation: fadeIn .6s ease-out;
        }

        @media(max-width: 767px) {
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
                <h2 class="text-white fw-bold mb-0">Riwayat Data</h2>
                <p class="text-muted mb-0 small">Log ketinggian air & status sensor secara historis.</p>
            </div>
            <div class="filter-btn btn-group" role="group">
                <a href="{{ route('table') }}" class="btn {{ !$currentFilter ? 'active' : '' }}">Semua</a>
                <a href="{{ route('table', ['filter' => 'Sumur Reservoir 1']) }}"
                    class="btn {{ $currentFilter == 'Sumur Reservoir 1' ? 'active' : '' }}">Sumur 1</a>
                <a href="{{ route('table', ['filter' => 'Sumur Reservoir 2']) }}"
                    class="btn {{ $currentFilter == 'Sumur Reservoir 2' ? 'active' : '' }}">Sumur 2</a>
            </div>
        </header>

        <section class="container-fluid pb-4">
            <div class="row g-4">
                <div class="col-12">
                    <article class="card card-glass shadow-lg h-100">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="ps-4">Waktu</th>
                                            <th class="text-center">Level Air</th>
                                            <th class="text-center">Status</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-body" class="text-center">
                                        @forelse($allData as $d)
                                            @php $pct = ($d->sensor1+$d->sensor2+$d->sensor3+$d->sensor4+$d->sensor5)*20; @endphp
                                            <tr>
                                                <td class="ps-4 dt">
                                                    <div class="fw-semibold">{{ $d->waktu->format('d M Y') }}</div>
                                                    <small class="text-muted">{{ $d->waktu->format('H:i:s') }}
                                                        WIB</small>
                                                </td>
                                                <td class="text-center fw-semibold">{{ $pct }}%</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-{{ strtolower($d->status) }}">{{ $d->status }}</span>
                                                </td>
                                                <td>{{ $d->catatan ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-muted">Tidak ada data.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-3">
                            {{ $allData->links() }}
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('temp/file/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/core/bootstrap.min.js') }}"></script>

    <script type="module">
        const tbody = document.getElementById('data-body');
        const currentFilter = @json($currentFilter);

        function prependRow(d) {
            const pct = Math.round(d.waterLevelPercent || 0);
            const statusCls = (d.status || '').toLowerCase();
            const time = new Date(d.waktu);
            const row = document.createElement('tr');
            row.classList.add('new-row');
            row.innerHTML = `
        <td class="ps-4 dt">
          <div class="fw-semibold">${time.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</div>
          <small class="text-muted">${time.toLocaleTimeString('id-ID')} WIB</small>
        </td>
        <td class="text-center fw-semibold">${pct}%</td>
        <td class="text-center">
          <span class="badge badge-${statusCls}">${d.status}</span>
        </td>
        <td>${d.catatan || '-'}</td>`;

            const placeholder = tbody.querySelector('td[colspan]');
            if (placeholder) placeholder.parentElement.remove();
            tbody.prepend(row);
        }

        window.Echo.channel('water-level-channel').listen('.new-data', e => {
            const d = e.data;
            if (!currentFilter || d.catatan === currentFilter) prependRow(d);
        });
    </script>
</body>

</html>
