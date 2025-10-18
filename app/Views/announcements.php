<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        h1 { margin-bottom: 1rem; }
        .announcement { border: 1px solid #ddd; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; }
        .title { font-weight: bold; font-size: 1.1rem; margin-bottom: .25rem; }
        .date { color: #666; font-size: .9rem; margin-bottom: .5rem; }
        .empty { color: #666; }
    </style>
</head>
<body>
    <h1>Announcements</h1>

    <?php $items = isset($announcements) && is_array($announcements) ? $announcements : []; ?>

    <?php if (empty($items)): ?>
        <p class="empty">No announcements yet.</p>
    <?php else: ?>
        <?php foreach ($items as $a): ?>
            <div class="announcement">
                <div class="title"><?php echo htmlspecialchars($a['title'] ?? 'Untitled', ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="date">
                    <?php 
                        $date = $a['date_posted'] ?? $a['created_at'] ?? $a['updated_at'] ?? null;
                        echo $date ? date('M d, Y g:i A', strtotime($date)) : '';
                    ?>
                </div>
                <div class="content"><?php echo nl2br(htmlspecialchars($a['content'] ?? ($a['body'] ?? ''), ENT_QUOTES, 'UTF-8')); ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
