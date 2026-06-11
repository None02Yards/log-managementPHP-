
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



</head>
<body>


<div class="dashboard-grid">
    
    <div class="stats-container">
        <div class="stat-card total">
            <div class="stat-icon"><i class="fas fa-database"></i></div>
            <div class="stat-content">
                <h3>Total Logs</h3>
                <p class="stat-number"><?php echo number_format($stats['total'] ?? 0); ?></p>
            </div>
        </div>

        <?php foreach ($stats['by_severity'] ?? [] as $severity): ?>
            <div class="stat-card severity-<?php echo strtolower($severity['severity']); ?>">
                <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="stat-content">
                    <h3><?php echo ucfirst($severity['severity']); ?></h3>
                    <p class="stat-number"><?php echo number_format($severity['count']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    

<div class="recent-logs-section">

    <div class="section-header">
        <h3>Recent Logs</h3>

        <a href="/logs" class="btn btn-sm">View All</a>
    </div>

    <div style="display:flex; gap:10px; margin:10px 0;">
        
        <select id="severityFilter" onchange="applyFilters()">
            <option value="">All Severities</option>
            <option value="INFO">INFO</option>
            <option value="WARNING">WARNING</option>
            <option value="ERROR">ERROR</option>
            <option value="CRITICAL">CRITICAL</option>
        </select>

        <input 
            id="sourceFilter"
            placeholder="Filter by source..."
            oninput="applyFilters()"
        />
    </div>

    <table class="logs-table">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Severity</th>
                <th>Source</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="logsTable">
        </tbody>
    </table>

</div>

    <div class="top-sources-section">
        <div class="section-header">
            <h3>Top Log Sources</h3>
        </div>
        <ul class="sources-list">
            <?php foreach ($stats['by_source'] ?? [] as $source): ?>
                <li>
                    <span class="source-name"><?php echo $source['source']; ?></span>
                    <span class="source-count"><?php echo $source['count']; ?> logs</span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

</body>
</html>