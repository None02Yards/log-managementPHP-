<div class="reports-page">
    <div class="reports-grid">
        <!-- Summary Statistics -->
        <section class="report-section">
            <h3>Summary Statistics</h3>
            <div class="stats-summary">
                <div class="stat-item">
                    <label>Total Logs:</label>
                    <strong><?php echo number_format($stats['total'] ?? 0); ?></strong>
                </div>
            </div>
        </section>

        <!-- Severity Distribution -->
        <section class="report-section">
            <h3>Severity Distribution</h3>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Severity Level</th>
                        <th>Count</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stats['by_severity'] ?? [] as $severity): ?>
                    <tr>
                        <td><span class="badge badge-<?php echo strtolower($severity['severity']); ?>"><?php echo $severity['severity']; ?></span></td>
                        <td><?php echo number_format($severity['count']); ?></td>
                        <td><?php echo round(($severity['count'] / ($stats['total'] ?? 1)) * 100, 2); ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Source Distribution -->
        <section class="report-section">
            <h3>Top 10 Log Sources</h3>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stats['by_source'] ?? [] as $source): ?>
                    <tr>
                        <td><?php echo $source['source']; ?></td>
                        <td><?php echo number_format($source['count']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Export Options -->
        <section class="report-section export-section">
            <h3>Export Reports</h3>
            <div class="export-form">
                <form id="export-form" method="GET">
                    <div class="form-group">
                        <label>Severity Filter (Optional)</label>
                        <select name="severity">
                            <option value="">All</option>
                            <option value="DEBUG">DEBUG</option>
                            <option value="INFO">INFO</option>
                            <option value="WARNING">WARNING</option>
                            <option value="ERROR">ERROR</option>
                            <option value="CRITICAL">CRITICAL</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" formaction="/centralized-log-management/public/reports/export-json" class="btn btn-primary"><i class="fas fa-file-json"></i> Export as JSON</button>
                        <button type="submit" formaction="/centralized-log-management/public/reports/export-csv" class="btn btn-primary"><i class="fas fa-file-csv"></i> Export as CSV</button>
                        <button type="submit" formaction="/centralized-log-management/public/reports/export-html" class="btn btn-primary"><i class="fas fa-file-html5"></i> Export as HTML</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>