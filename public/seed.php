<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/bootstrap/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Operations Lab</title>

    <link rel="stylesheet" href="/css/seeder.css">
</head>

<body>

    <!-- HEADER -->

    <header class="page-header">

        <h1>🗄 Operations Lab</h1>

        <p>
            Database seeding, incident simulation, and observability toolkit
        </p>

    </header>

    <!-- STATUS BAR -->

    <section class="status-bar">

        <div class="status-card">
            <span>ENV</span>
            <strong>Development</strong>
        </div>

        <div class="status-card">
            <span>DB</span>
            <strong id="dbStatus">Connected</strong>
        </div>

        <div class="status-card">
            <span>MODE</span>
            <strong>Manual</strong>
        </div>

        <div class="status-card">
            <span>API</span>
            <strong id="apiStatus">Ready</strong>
        </div>

    </section>

    <main class="container">

        <!-- HEALTH + SNAPSHOT -->

        <section class="grid-two">

            <div class="panel">

                <h3>System Health</h3>

                <div id="healthContent">
                    Loading...
                </div>

            </div>

            <div class="panel">

                <h3>Database Snapshot</h3>

                <div id="snapshotContent">
                    Loading...
                </div>

            </div>

        </section>

        <!-- ACTIONS -->

        <section class="panel">

            <div class="panel-header-row">

                <h3>Seeder Actions</h3>

                <div class="actions">

                    <button id="seedBtn">
                        🚀 Seed Database
                    </button>

                    <button id="clearConsoleBtn">
                        🧹 Clear Console
                    </button>

                    <button onclick="location.href='/'">
                        🏠 Home
                    </button>

                </div>

            </div>

        </section>

        <!-- INCIDENTS -->

        <section class="panel">

            <h3>Incident Generator</h3>

            <div class="actions">

                <select id="incidentType">

                    <option value="api_outage">
                        API Outage
                    </option>

                    <option value="db_failure">
                        Database Failure
                    </option>

                    <option value="auth_attack">
                        Authentication Attack
                    </option>

                    <option value="memory_leak">
                        Memory Leak
                    </option>

                    <option value="network_timeout">
                        Network Timeout
                    </option>

                </select>

                <button id="simulateBtn">
                    Simulate Incident
                </button>

            </div>

        </section>

        <!-- CONSOLE -->

        <section class="panel console-panel">

            <h3>Live Console</h3>

            <div class="log" id="log">

                <div class="console-line">
                    Operations Lab ready...
                </div>

            </div>

        </section>

        <!-- HISTORY -->

        <section class="panel">

            <h3>Seeder History</h3>

            <div id="historyContent">

                No history available.

            </div>

        </section>

        <!-- STATS -->

        <section class="panel">

            <h3>Seeder Statistics</h3>

            <div id="stats">

                Waiting for seeding...

            </div>

        </section>

    </main>

<script type="module"
        src="/js/operations-lab.js">
</script>

</body>

</html>