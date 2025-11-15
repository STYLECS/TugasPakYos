<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css?v2">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Admin</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="sidebar-menu">
                <ul>
                    <li class="active">
                        <a href="?page=home">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=guru">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Data Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=pegawai">
                            <i class="fas fa-users"></i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=jurusan">
                            <i class="fas fa-book"></i>
                            <span>Data Jurusan</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=siswa">
                            <i class="fas fa-user-graduate"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=kelas">
                            <i class="fas fa-door-open"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=mpk">
                            <i class="fas fa-book-open"></i>
                            <span>Data MPK</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=spp">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Data Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=jurnal">
                            <i class="fas fa-book"></i>
                            <span>Data Jurnal</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=absensi">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Data Absensi</span>
                        </a>
                    <!-- </li>
                    <li class="separator"></li>
                    <li>
                        <a href="?page=settings">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="../index.php" class="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">
                        <?php 
                            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                            switch($page) {
                                case 'home': echo 'Dashboard'; break;
                                case 'guru': echo 'Data Guru'; break;
                                case 'pegawai': echo 'Data Pegawai'; break;
                                case 'jurusan': echo 'Data Jurusan'; break;
                                case 'siswa': echo 'Data Siswa'; break;
                                case 'kelas': echo 'Data Kelas'; break;
                                case 'mpk': echo 'Data MPK'; break;
                                case 'pembayaran': echo 'Data Pembayaran'; break;
                                case 'absensi': echo 'Data Absensi'; break;
                                case 'jurnal': echo 'Data Jurnal'; break;
                                case 'settings': echo 'Pengaturan'; break;
                                default: echo 'Dashboard';
                            }
                        ?>
                    </h1>
                </div>
                <div class="header-right">
                    <div class="search-box">

                    </div>
                        <div class="user-menu">
                            <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name">Administrator</span>
                            <span class="user-role">Super Admin</span>
                        </div>
                        <div class="dropdown-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content">
                <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                    
                    switch($page) {
                        case 'guru':
                            if(file_exists('guru.php')) {
                                include 'guru.php';
                            } else {
                                echo '<div class="error-message">File guru.php tidak ditemukan</div>';
                            }
                            break;
                        case 'pegawai':
                            if(file_exists('pegawai.php')) {
                                include 'pegawai.php';
                            } else {
                                echo '<div class="error-message">File pegawai.php tidak ditemukan</div>';
                            }
                            break;
                        case 'jurusan':
                            if(file_exists('jurusan.php')) {
                                include 'jurusan.php';
                            } else {
                                echo '<div class="error-message">File jurusan.php tidak ditemukan</div>';
                            }
                            break;
                        case 'siswa':
                            if(file_exists('siswa.php')) {
                                include 'siswa.php';
                            } else {
                                echo '<div class="error-message">File siswa.php tidak ditemukan</div>';
                            }
                            break;
                        case 'kelas':
                            if(file_exists('kelas.php')) {
                                include 'kelas.php';
                            } else {
                                echo '<div class="error-message">File kelas.php tidak ditemukan</div>';
                            }   
                            break;
                        case 'mpk':
                            if(file_exists('mpk.php')) {
                                include 'mpk.php';
                            } else {
                                echo '<div class="error-message">File mpk.php tidak ditemukan</div>';
                            }
                            break;
                        case 'spp':
                            if(file_exists('spp.php')) {
                                include 'spp.php';
                            } else {
                                echo '<div class="error-message">File pembayaran.php tidak ditemukan</div>';
                            }
                            break;
                        case 'absensi':
                            if(file_exists('absensi.php')) {
                                include 'absensi.php';
                            } else {
                                echo '<div class="error-message">File absensi.php tidak ditemukan</div>';
                            }
                            break;
                        case 'jurnal':
                            if(file_exists('jurnal.php')) {
                                include 'jurnal.php';
                            } else {
                                echo '<div class="error-message">File jurnal.php tidak ditemukan</div>';
                            }
                            break;
                        case 'settings':
                            if(file_exists('settings.php')) {
                                include 'settings.php';
                            } else {
                                echo '<div class="error-message">File settings.php tidak ditemukan</div>';
                            }
                            break;
                        default:
                            if(file_exists('home.php')) {
                                include 'home.php';
                            } else {
                                echo '<div class="error-message">File home.php tidak ditemukan</div>';
                            }
                            break;
                    }
                ?>
            </div>
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const sidebarToggle = document.getElementById('sidebarToggle');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.add('active');
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Active menu item
        const currentPage = new URLSearchParams(window.location.search).get('page') || 'home';
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        
        menuItems.forEach(item => {
            item.parentElement.classList.remove('active');
            const href = item.getAttribute('href');
            if (href.includes(`page=${currentPage}`)) {
                item.parentElement.classList.add('active');
            }
        });

        // Search functionality
        const searchInput = document.querySelector('.search-box input');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('focused');
        });
        
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('focused');
        });
    </script>

    <script src="script.js"></script>
</body>
</html>