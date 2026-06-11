<div class="logs-page">
    <!-- Filter Section -->
    <div class="filter-section">
        <h3>Search & Filter</h3>
        <form method="GET" class="filter-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Message</label>
                    <input type="text" name="message" placeholder="Search message..." value="<?php echo htmlspecialchars($filters['message'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Severity</label>
                    <select name="severity">
                        <option value="">All Levels</option>
                        <option value="DEBUG" <?php echo ($filters['severity'] ?? '') === 'DEBUG' ? 'selected' : ''; ?>>DEBUG</option>
                        <option value="INFO" <?php echo ($filters['severity'] ?? '') === 'INFO' ? 'selected' : ''; ?>>INFO</option>
                        <option value="WARNING" <?php echo ($filters['severity'] ?? '') === 'WARNING' ? 'selected' : ''; ?>>WARNING</option>
                        <option value="ERROR" <?php echo ($filters['severity'] ?? '') === 'ERROR' ? 'selected' : ''; ?>>ERROR</option>
                        <option value="CRITICAL" <?php echo ($filters['severity'] ?? '') === 'CRITICAL' ? 'selected' : ''; ?>>CRITICAL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Source</label>
                    <input type="text" name="source" placeholder="Filter by source..." value="<?php echo htmlspecialchars($filters['source'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>From Date</label>
                    <input type="datetime-local" name="date_from" value="<?php echo htmlspecialchars($filters['date_from'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input type="datetime-local" name="date_to" value="<?php echo htmlspecialchars($filters['date_to'] ?? ''); ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                <a href="/centralized-log-management/public/logs" class="btn btn-secondary">Clear Filters</a>
            </div>
        </form>
    </div>

    <!-- Logs Table -->
    <div class="logs-section">
        <div class="section-header">
            <h3>Logs</h3>
            <div class="export-buttons">
                <a href="/centralized-log-management/public/reports/export-json?<?php echo http_build_query($filters ?? []); ?>" class="btn btn-sm"><i class="fas fa-file-json"></i> JSON</a>
                <a href="/centralized-log-management/public/reports/export-csv?<?php echo http_build_query($filters ?? []); ?>" class="btn btn-sm"><i class="fas fa-file-csv"></i> CSV</a>
                <a href="/centralized-log-management/public/reports/export-html?<?php echo http_build_query($filters ?? []); ?>" class="btn btn-sm"><i class="fas fa-file-html5"></i> HTML</a>
            </div>
        </div>

        <?php if (empty($logs)): ?>
        <div class="no-data">
            <i class="fas fa-inbox"></i>
            <p>No logs found</p>
        </div>
        <?php else: ?>
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
            <tbody>
                <?php foreach ($logs ?? [] as $log): ?>
                <tr>
                    <td><?php echo htmlspecialchars($log['timestamp'] ?? 'N/A'); ?></td>
                    <td><span class="badge badge-<?php echo strtolower($log['severity'] ?? 'info'); ?>"><?php echo htmlspecialchars($log['severity'] ?? 'N/A'); ?></span></td>
                    <td><?php echo htmlspecialchars($log['source'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars(substr($log['message'] ?? '', 0, 60) . (strlen($log['message'] ?? '') > 60 ? '...' : '')); ?></td>
                    <td><a href="/centralized-log-management/public/logs/<?php echo $log['id'] ?? ''; ?>" class="btn btn-sm"><i class="fas fa-eye"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
