<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/bootstrap/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database Seeder</title>
    <link rel="stylesheet" href="/css/seeder.css">
    
</head>

<body>

    <h2>🗄 Operations Lab</h2>

<div class="container">

    <!-- HEADER -->

<div class="page-header">

    <h2>🗄 Operations Lab</h2>

    <p>
        Database seeding, incident simulation, and system observability toolkit
    </p>

</div>

    <!-- TOP GRID -->

    <div class="grid">

        <section class="panel">
            <h3>System Health</h3>
            <div id="healthContent">
                Loading...
            </div>
        </section>

        <section class="panel">
            <h3>Database Snapshot</h3>
            <div id="snapshotContent">
                Loading...
            </div>
        </section>

    </div>

    <!-- ACTIONS -->

    <section class="panel">

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

    <!-- SIMULATOR -->

    <section class="panel">

        <h3>Live Log Simulator</h3>

        <div class="actions">

            <input
                type="number"
                id="logRate"
                value="5"
                min="1"
                max="100">

            <button id="startSimulator">
                ▶ Start
            </button>

            <button id="stopSimulator">
                ⏹ Stop
            </button>

        </div>

    </section>

    <!-- HISTORY -->

    <section class="panel">

        <h3>Seeder History</h3>

        <div id="historyContent">
            No history available
        </div>

    </section>

    <!-- STATS -->

    <section class="panel">

        <h3>Seeder Statistics</h3>

        <div id="stats">
            Waiting for seeding...
        </div>

    </section>

    <!-- CONSOLE -->

    <section class="panel">

        <h3>Live Console</h3>

        <div class="log" id="log"></div>

    </section>

</div>

<script>

const API = "/api";

const logBox = document.getElementById("log");

function log(message)
{
    const div = document.createElement("div");

    div.textContent = message;

    logBox.appendChild(div);

    logBox.scrollTop = logBox.scrollHeight;
}

function clearConsole()
{
    logBox.innerHTML = "";
}

document
    .getElementById("clearConsoleBtn")
    .addEventListener("click", clearConsole);

document
    .getElementById("seedBtn")
    .addEventListener("click", async () =>
{
    const btn = document.getElementById("seedBtn");

    btn.disabled = true;

    log("🚀 Seeding started...");

    try
    {
        const res = await fetch(API + "/seed", {
            method: "POST"
        });

        const data = await res.json();

        log("✅ Seeder completed");

        log("Inserted: " + data.result.inserted);

        log("Failed: " + data.result.failed);

        document.getElementById("stats").innerHTML =
            `<pre>${JSON.stringify(
                data.result.stats || {},
                null,
                2
            )}</pre>`;
    }
    catch(e)
    {
        log("❌ Error: " + e.message);
    }

    btn.disabled = false;
});

</script>


</body>

</html>