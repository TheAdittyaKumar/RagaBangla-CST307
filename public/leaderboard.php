<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';

$rows = $pdo->query("
    SELECT u.name, COALESCE(SUM(s.score),0) AS total_score
    FROM users u
    LEFT JOIN quiz_submissions s ON s.user_id = u.id
    GROUP BY u.id
    ORDER BY total_score DESC
    LIMIT 50
")->fetchAll();
?>
<div class="card">
  <h1 class="header">Leaderboard</h1>
  <table class="table">
    <tr><th>#</th><th>Name</th><th>Total Points</th></tr>
    <?php foreach($rows as $i=>$r): ?>
        <tr><td><?= $i+1 ?></td><td><?= h($r['name']) ?></td><td><?= (int)$r['total_score'] ?></td></tr>
    <?php endforeach; ?>
  </table>
</div>
<?php include __DIR__.'/_footer.php'; ?>
