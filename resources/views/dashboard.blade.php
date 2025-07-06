<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}">
    <link rel="icon" type="image/png" href="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}">
    <title>
        Dashboard Sumur Ajaib
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
            --main-card-bg: rgba(23, 32, 42, 0.7);
            --card-bg: rgba(44, 62, 80, 0.6);
            --border-color: rgba(0, 255, 255, 0.2);
            --text-color: #ecf0f1;
            --text-muted-color: #bdc3c7;
            --glow-color: #00cyan;
            --water-color-top: #00f2fe;
            --water-color-bottom: #4facfe;
            --status-aman: #00f2fe;
            --status-waspada: #f1c40f;
            --status-siaga: #e67e22;
            --status-bahaya: #e74c3c;
        }

        body.g-sidenav-show {
            background-color: var(--bg-color);
        }

        /* Override the default dark background to show the image */
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
        
        .min-height-300 {
            background: none !important;
        }

        /* Frosted Glass Card Effect */
        .card-glass {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .card-glass:hover {
            border-color: rgba(0, 255, 255, 0.5);
            transform: translateY(-5px);
        }

        .card-glass .card-header, .card-glass .card-body, .card-glass .card-footer {
            background-color: transparent;
        }

        .card-glass h1, .card-glass h2, .card-glass h3, .card-glass h4, .card-glass h5, .card-glass h6 {
            color: var(--text-color);
        }

        .card-glass p, .card-glass .text-sm, .card-glass .text-xs {
            color: var(--text-muted-color);
        }

        /* Main Status Card Styling */
        #main-status-card {
            background: var(--main-card-bg);
            text-align: center;
            padding: 2rem 1rem;
            border-width: 2px;
        }

        #status-text {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 0 15px currentColor;
        }

        /* Magic Well Visualization */
        .magic-well-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            height: 100%;
        }

        .magic-well {
            width: 180px;
            height: 420px;
            border: 4px solid;
            border-image-slice: 1;
            border-image-source: linear-gradient(to bottom, var(--status-aman), #9b59b6);
            border-radius: 20px 20px 100px 100px;
            position: relative;
            background: rgba(10, 10, 20, 0.5);
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3), inset 0 0 15px rgba(0,0,0,0.5);
        }

        #water-level {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: linear-gradient(to top, var(--water-color-bottom), var(--water-color-top));
            transition: height 1s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        /* Wave Animation */
        .wave {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/85486/wave.svg) repeat-x;
            position: absolute;
            top: -198px;
            width: 6400px;
            height: 198px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }
        .wave:nth-of-type(2) {
            top: -175px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) -0.125s infinite, swell 7s ease -1.25s infinite;
            opacity: 1;
        }
        @keyframes wave {
            0% { margin-left: 0; }
            100% { margin-left: -1600px; }
        }
        @keyframes swell {
            0%, 100% { transform: translate3d(0, -25px, 0); }
            50% { transform: translate3d(0, 5px, 0); }
        }

        /* Bubbles Animation */
        .bubble {
            position: absolute;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: bubble-rise 10s infinite ease-in;
        }
        @keyframes bubble-rise {
            0% { bottom: -10px; transform: translateX(0); }
            100% { bottom: 105%; transform: translateX(15px); }
        }

        /* Sensor Detail Item */
        .sensor-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            border-radius: 0.75rem;
            background: rgba(0,0,0,0.2);
            transition: background 0.3s ease;
        }
        .sensor-item:hover {
            background: rgba(0,0,0,0.4);
        }
        .sensor-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: var(--text-muted-color);
            transition: all 0.3s ease;
        }
        .sensor-icon.active {
            color: var(--status-aman);
            text-shadow: 0 0 10px var(--status-aman);
        }

        /* Dynamic Status Colors */
        .status-aman { border-color: var(--status-aman); color: var(--status-aman); }
        .status-waspada { border-color: var(--status-waspada); color: var(--status-waspada); }
        .status-siaga { border-color: var(--status-siaga); color: var(--status-siaga); }
        .status-bahaya { border-color: var(--status-bahaya); color: var(--status-bahaya); }
        .status-unknown { border-color: var(--text-muted-color); color: var(--text-muted-color); }

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
                        <a class="nav-link active" href="{{ route('dashboard') }}" style="background: rgba(0, 255, 255, 0.1); border-radius: 0.5rem;">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-white text-sm"></i>
                            </div>
                            <span class="nav-link-text ms-1 text-white">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table') }}">
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
                    <!-- Left Column: Visualization -->
                    <div class="col-lg-7 mb-lg-0 mb-4">
                        <div class="card card-glass magic-well-container">
                            <div class="magic-well">
                                <div id="water-level">
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <!-- Bubbles will be added by JS -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Information -->
                    <div class="col-lg-5">
                        <!-- Main Status -->
                        <div id="main-status-card" class="card card-glass status-unknown mb-4">
                            <p class="text-uppercase font-weight-bold text-sm opacity-7 mb-0">Status Sistem</p>
                            <h2 id="status-text" class="font-weight-bolder mb-0">Menunggu Data...</h2>
                        </div>

                        <!-- Info Cards -->
                        <div class="row">
                            <div class="col-sm-6">
                                 <div class="card card-glass mb-4">
                                     <div class="card-body p-3">
                                         <p class="text-sm mb-0 text-uppercase font-weight-bold">Level Air</p>
                                         <h5 id="water-level-percent-text" class="font-weight-bolder mb-0">0%</h5>
                                     </div>
                                 </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="card card-glass mb-4">
                                     <div class="card-body p-3">
                                         <p class="text-sm mb-0 text-uppercase font-weight-bold">Update</p>
                                         <h5 id="waktu-text" class="font-weight-bolder mb-0">--:--:--</h5>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <!-- Sensor Details -->
                        <div class="card card-glass">
                            <div class="card-header pb-0">
                                <h6>Detail Sensor</h6>
                            </div>
                            <div class="card-body p-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="sensor-item">
                                        <i id="sensor-icon-{{$i}}" class="sensor-icon fas fa-tint-slash"></i>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0 text-sm">Sensor {{ $i }} <span class="text-muted">({{ ($i-1) * 25 }} cm)</span></h6>
                                            <span id="sensor-status-{{$i}}" class="text-xs">Tidak Aktif</span>
                                        </div>
                                    </div>
                                @endfor
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

    <!-- Real-time Script with Laravel Echo -->
    <script type="module">
        // --- Element Selectors ---
        const mainStatusCard = document.getElementById('main-status-card');
        const statusTextEl = document.getElementById('status-text');
        const waktuTextEl = document.getElementById('waktu-text');
        const waterLevelPercentTextEl = document.getElementById('water-level-percent-text');
        const waterLevelEl = document.getElementById('water-level');

        // --- Status Configuration ---
        const statusConfig = {
            'Bahaya': { className: 'status-bahaya' },
            'Siaga': { className: 'status-siaga' },
            'Waspada': { className: 'status-waspada' },
            'Aman': { className: 'status-aman' },
            'default': { className: 'status-unknown' }
        };

        // --- Bubble Generator ---
        function createBubbles() {
            const waterContainer = document.querySelector('.magic-well');
            const bubbleCount = 20;
            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                const size = Math.random() * 10 + 5 + 'px';
                bubble.style.width = size;
                bubble.style.height = size;
                bubble.style.left = Math.random() * 90 + '%';
                bubble.style.animationDuration = Math.random() * 5 + 5 + 's';
                bubble.style.animationDelay = Math.random() * 5 + 's';
                waterContainer.appendChild(bubble);
            }
        }
        createBubbles();

        // --- Main UI Update Function ---
        function updateDashboard(data) {
            console.log("Menerima data baru:", data);
            
            const status = data.status || 'default';
            const percent = Math.round(data.waterLevelPercent || 0);
            const statusClass = statusConfig[status]?.className || statusConfig.default.className;

            // 1. Update Main Status Card
            mainStatusCard.className = `card card-glass mb-4 ${statusClass}`;
            statusTextEl.textContent = data.status || 'Tidak Diketahui';
            statusTextEl.className = `font-weight-bolder mb-0 ${statusClass}`;

            // 2. Update Last Update Time
            waktuTextEl.textContent = new Date(data.waktu).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            // 3. Update Water Level Percentage Text
            waterLevelPercentTextEl.textContent = `${percent}%`;

            // 4. Update Water Well Visualization
            waterLevelEl.style.height = `${percent}%`;
            
            // 5. Update Individual Sensor Status
            for (let i = 1; i <= 5; i++) {
                const icon = document.getElementById(`sensor-icon-${i}`);
                const statusText = document.getElementById(`sensor-status-${i}`);
                if (data[`sensor${i}`]) {
                    icon.className = 'sensor-icon fas fa-tint active';
                    statusText.textContent = 'Aktif';
                } else {
                    icon.className = 'sensor-icon fas fa-tint-slash';
                    statusText.textContent = 'Tidak Aktif';
                }
            }
        }

        // --- Initial Data Load ---
        const initialData = @json($latestData);
        if (initialData) {
            initialData.waterLevelPercent = @json($waterLevelPercent);
            updateDashboard(initialData);
        }

        // --- WebSocket Listener ---
        window.Echo.channel('water-level-channel')
            .listen('.new-data', (event) => {
                updateDashboard(event.data);
            });
    </script>
</body>
</html>
