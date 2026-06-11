<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? APP_NAME; ?> - <?php echo APP_NAME; ?></title>
<link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1><i class="fas fa-database"></i> <?php echo APP_NAME; ?></h1>
                <small>v<?php echo APP_VERSION; ?></small>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="/" class="nav-link">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>

                    <li>
                        <a href="/dashboard" class="nav-link">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="/logs" class="nav-link">
                            <i class="fas fa-list"></i> Logs
                        </a>
                    </li>

                    <li>
                        <a href="/reports" class="nav-link">
                            <i class="fas fa-file-export"></i> Reports
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h2><?php echo $page_title ?? APP_NAME; ?></h2>
                </div>
                <div class="header-right">
                    <button class="btn-icon" onclick="toggleTheme()"><i class="fas fa-moon"></i></button>
                    <div class="user-profile">
                        <img src="https://via.placeholder.com/40" alt="User">
                        <span>Admin</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content">
                <?php echo $content ?? ''; ?>
            </div>
        </main>
    </div>

    <script src="/centralized-log-management/public/js/main.js"></script>
</body>

</html>