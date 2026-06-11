<?php
/**
 * Log Detail View
 * @var array $log Log entry data
 * @var array $patterns Detected patterns
 * @var string $page_title Page title
 */
?>

<div class="log-detail-page">
    <div class="log-header">
        <div class="log-info">
            <h2><?php echo htmlspecialchars($log['message'] ?? 'N/A'); ?></h2>
            <p class="log-id">ID: <code><?php echo $log['id'] ?? 'N/A'; ?></code></p>
        </div>
        <div class="log-actions">
            <a href="/centralized-log-management/public/logs" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            <button onclick="deleteLog('<?php echo $log['id'] ?? ''; ?>')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
        </div>
    </div>

    <div class="log-content">
        <!-- Metadata Section -->
        <section class="log-section">
            <h3>Log Metadata</h3>
            <div class="metadata-grid">
                <div class="metadata-item">
                    <label>Timestamp:</label>
                    <span><?php echo $log['timestamp'] ?? 'N/A'; ?></span>
                </div>
                <div class="metadata-item">
                    <label>Severity:</label>
                    <span><span class="badge badge-<?php echo strtolower($log['severity'] ?? 'info'); ?>"><?php echo $log['severity'] ?? 'N/A'; ?></span></span>
                </div>
                <div class="metadata-item">
                    <label>Source:</label>
                    <span><?php echo $log['source'] ?? 'N/A'; ?></span>
                </div>
            </div>
        </section>

        <!-- Context Section -->
        <section class="log-section">
            <h3>Context Data</h3>
            <pre><code><?php echo json_encode(json_decode($log['context'] ?? '[]', true), JSON_PRETTY_PRINT); ?></code></pre>
        </section>

        <!-- Tags Section -->
        <?php if (!empty($log['tags'])): ?>
        <section class="log-section">
            <h3>Tags</h3>
            <div class="tags-list">
                <?php foreach (json_decode($log['tags'], true) as $tag): ?>
                <span class="badge badge-info"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Pattern Detection Section -->
        <?php if (!empty($patterns)): ?>
        <section class="log-section">
            <h3>Detected Patterns</h3>
            <div class="patterns-list">
                <?php foreach ($patterns as $pattern): ?>
                <div class="pattern-item">
                    <div class="pattern-header">
                        <strong><?php echo htmlspecialchars($pattern['pattern']); ?></strong>
                        <span class="badge badge-<?php echo strtolower($pattern['suggested_severity']); ?>"><?php echo $pattern['suggested_severity']; ?></span>
                    </div>
                    <p><?php echo htmlspecialchars($pattern['description']); ?></p>
                    <small>Matched: <code><?php echo htmlspecialchars($pattern['matched_text']); ?></code></small>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
</div>

<script>
function deleteLog(id) {
    if (confirm('Are you sure you want to delete this log?')) {
        fetch(`/centralized-log-management/public/api/logs/${id}`, {
            method: 'DELETE'
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                window.location.href = '/centralized-log-management/public/logs';
            }
        });
    }
}
</script>
