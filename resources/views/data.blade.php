<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}">
    <link rel="icon" type="image/png" href="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}">
    <title>
        Tabel Data - Sumur Ajaib
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('temp/file/assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <!-- Load Vite assets -->
    @vite('resources/js/app.js')

    <!-- Custom Styles for UI/UX Revamp -->
    <style>
        :root {
            --bg-color: #2c3e50;
            --card-bg: rgba(44, 62, 80, 0.6);
            --border-color: rgba(0, 255, 255, 0.2);
            --text-color: #ecf0f1;
            --text-muted-color: #bdc3c7;
            --status-aman: #00f2fe;
            --status-waspada: #f1c40f;
            --status-siaga: #e67e22;
            --status-bahaya: #e74c3c;
        }

        body.g-sidenav-show {
            background-color: var(--bg-color);
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('temp/file/assets/img/uksum.jpg') }}') no-repeat center center;
            background-size: cover;
            filter: brightness(0.6);
            z-index: -1;
        }

        .main-content {
            position: relative;
        }

        /* Frosted Glass Card Effect */
        .card-glass {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            color: var(--text-color);
        }

        .card-glass .card-header, .card-glass .card-body {
            background-color: transparent;
        }
        
        .card-glass h6 {
            color: var(--text-color);
        }

        /* Themed Table */
        .table {
            color: var(--text-color);
        }

        .table thead th {
            color: var(--text-color);
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }
        
        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 255, 255, 0.05);
        }
        
        .table td {
            color: var(--text-muted-color);
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }
        
        .table .font-weight-bold {
            color: var(--text-color);
        }

        /* Custom Badges */
        .badge-custom {
            padding: 0.4em 0.8em;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
            color: #2c3e50; /* Dark text for contrast */
        }

        .badge-aman { background-color: var(--status-aman); }
        .badge-waspada { background-color: var(--status-waspada); }
        .badge-siaga { background-color: var(--status-siaga); }
        .badge-bahaya { background-color: var(--status-bahaya); color: white; }

        /* Animation for new row */
        @keyframes fadeIn {
            from { background-color: rgba(0, 255, 255, 0.2); opacity: 0; transform: translateY(-10px); }
            to { background-color: transparent; opacity: 1; transform: translateY(0); }
        }

        .new-row-animation {
            animation: fadeIn 1.5s ease-out;
        }

    </style>
</head>

<body class="g-sidenav-show">
    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- Sidenav -->
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 card-glass" id="sidenav-main">
            <div class="sidenav-header">
                <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
                    <img src="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold text-white">SUMUR AJAIB</span>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
            <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-white text-sm"></i>
                            </div>
                            <span class="nav-link-text ms-1 text-white">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('table') }}" style="background: rgba(0, 255, 255, 0.1); border-radius: 0.5rem;">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-white text-sm"></i>
                            </div>
                            <span class="nav-link-text ms-1 text-white">Tabel Data</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-glass">
                            <div class="card-header pb-0">
                                <h6>Riwayat Monitoring Sumur Ajaib</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Level Air</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-table-body">
                                            @forelse ($allData as $data)
                                                @php
                                                    $activeSensors = $data->sensor1 + $data->sensor2 + $data->sensor3 + $data->sensor4 + $data->sensor5;
                                                    $percent = $activeSensors * 20;
                                                    $statusClass = strtolower($data->status);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm font-weight-bold">{{ $data->waktu->format('d M Y') }}</h6>
                                                                <p class="text-xs text-muted mb-0">{{ $data->waktu->format('H:i:s') }} WIB</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">{{ $percent }}%</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="badge-custom badge-{{ $statusClass }}">{{ $data->status }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-normal mb-0">{{ $data->catatan ?? '-' }}</p>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-5">
                                                        <p class="text-muted">Belum ada riwayat data yang tercatat.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer px-3 border-0">
                                {{ $allData->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('temp/file/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('temp/file/assets/js/argon-dashboard.min.js') }}"></script>

    <!-- Real-time Table Update Script -->
    <script type="module">
        const tableBody = document.getElementById('data-table-body');

        // Function to create and prepend a new row
        function addDataToTable(data) {
            const percent = Math.round(data.waterLevelPercent || 0);
            const statusClass = (data.status || '').toLowerCase();
            const time = new Date(data.waktu);

            const newRow = document.createElement('tr');
            newRow.classList.add('new-row-animation');
            
            newRow.innerHTML = `
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm font-weight-bold">${time.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</h6>
                            <p class="text-xs text-muted mb-0">${time.toLocaleTimeString('id-ID')} WIB</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">${percent}%</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge-custom badge-${statusClass}">${data.status}</span>
                </td>
                <td>
                    <p class="text-sm font-weight-normal mb-0">${data.catatan || '-'}</p>
                </td>
            `;

            tableBody.prepend(newRow);

            // Optional: remove the placeholder if it exists
            const placeholder = tableBody.querySelector('td[colspan="4"]');
            if (placeholder) {
                placeholder.parentElement.remove();
            }
        }

        // --- WebSocket Listener ---
        window.Echo.channel('water-level-channel')
            .listen('.new-data', (event) => {
                console.log("Data baru diterima untuk tabel:", event.data);
                addDataToTable(event.data);
            });
    </script>
</body>
</html>
