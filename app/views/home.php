<!-- E:\centralized-log-management\app\views\home.php -->

<!-- <div class="home-container">

    <h1>Centralized Log Management</h1>

    <p>
        Monitor logs, generate reports and manage database data.
    </p>

    <div class="cards">

        <a href="/dashboard" class="card">
            📊 Dashboard
        </a>

        <a href="/logs" class="card">
            📜 Logs
        </a>

        <a href="/reports" class="card">
            📈 Reports
        </a>

        <a href="/seed.php" class="card">
            🗄️ Seeder
        </a>

    </div>

    <div class="stats">

        <h3>Quick Stats</h3>

        <p>Total Logs:
            <?= $stats['total'] ?? 0 ?>
        </p>

    </div>

</div> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centralized Log Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
        }

        .landing-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 60px 30px;
        }

        .hero {
            text-align: center;
            margin-bottom: 60px;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #f8fafc;
        }

        .hero p {
            max-width: 750px;
            margin: 0 auto;
            color: #94a3b8;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .module-card {
            background: #111827;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 28px;
            text-decoration: none;
            color: inherit;
            transition: all .25s ease;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: #3b82f6;
            box-shadow: 0 15px 30px rgba(0, 0, 0, .25);
        }

        .module-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .module-card h2 {
            color: #f8fafc;
            margin-bottom: 12px;
            font-size: 1.5rem;
        }

        .module-card p {
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .module-link {
            color: #60a5fa;
            font-weight: 600;
            font-size: .95rem;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            color: #64748b;
            font-size: .9rem;
        }

        @media (max-width: 768px) {
            .modules-grid {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .landing-container {
                padding: 40px 20px;
            }
        }

        .console-card {
            border: 1px solid #2563eb;
            background: linear-gradient(135deg,
                    #111827,
                    #172554);
        }

        .console-card:hover {
            border-color: #60a5fa;
            box-shadow: 0 0 25px rgba(37, 99, 235, .25);
        }

        .console-wrapper {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .console-wrapper .console-card {
            max-width: 550px;
            width: 100%;
        }

    </style>
</head>

<body>

    <div class="landing-container">

        <div class="hero">
            <h1>Centralized Log Management</h1>

            <p>
                Monitor logs, analyze system activity, generate reports,
                investigate issues, and manage operational data from a
                centralized platform.
            </p>
        </div>

        <div class="modules-grid">

            <a href="/dashboard" class="module-card">
                <div class="module-icon">📊</div>

                <h2>Dashboard</h2>

                <p>
                    Access system statistics, monitoring widgets,
                    recent activity, and operational health indicators.
                </p>

                <div class="module-link">
                    Open Dashboard →
                </div>
            </a>

            <a href="/logs" class="module-card">
                <div class="module-icon">📜</div>

                <h2>Logs</h2>

                <p>
                    Search, filter, inspect and investigate application
                    logs across all registered sources.
                </p>

                <div class="module-link">
                    Open Logs →
                </div>
            </a>

            <a href="/reports" class="module-card">
                <div class="module-icon">📈</div>

                <h2>Reports</h2>

                <p>
                    Generate exports, summaries and analytical reports
                    for operational review and auditing.
                </p>

                <div class="module-link">
                    Open Reports →
                </div>
            </a>

            <a href="/seed.php" class="module-card">
                <div class="module-icon">🗄️</div>

                <h2>Seeder</h2>

                <p>
                    Populate the database with sample records to test
                    dashboards, reports and monitoring workflows.
                </p>

                <div class="module-link">
                    Run Seeder →
                </div>
            </a>
    </div>

    
            <div class="console-wrapper">
            <a href="/dashboard" class="module-card console-card">

                <div class="module-icon">🚀</div>

                <h2>Monitoring Console</h2>

                <p>
                    Enter the full application workspace with
                    navigation sidebar, monitoring dashboard,
                    log explorer and reporting tools.
                </p>

                <div class="module-link">
                    Enter Console →
                </div>

            </a>
            </div>
        </div>

        <div class="footer">
            Centralized Log Management System
        </div>

</body>

</html>