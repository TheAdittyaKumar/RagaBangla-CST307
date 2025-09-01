<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';

$levels = [
  'Beginner' => ['What is Raga?', 'Basic Swaras & Sargam', 'Taal: Teentaal'],
  'Intermediate' => ['Raga Yaman Essentials', 'Alaap & Vistar Basics', 'Layakari Intro'],
  'Advanced' => ['Improvisation & Taans', 'Bandish Composition', 'Performance Craft']
];
$userId = current_user()['id'];
if (isset($_POST['complete'])) {
  $stmt = $pdo->prepare('REPLACE INTO user_progress(user_id, module_key, is_done) VALUES(?,?,1)');
  $stmt->execute([$userId, $_POST['complete']]);
}

$done = $pdo->prepare('SELECT module_key FROM user_progress WHERE user_id=?');
$done->execute([$userId]);
$doneSet = array_column($done->fetchAll(), 'module_key');
?>
<div class="card">
  <h1 class="header">Curriculum</h1>
  <?php foreach($levels as $level=>$mods): ?>
    <div class="card">
      <h3><?= htmlspecialchars($level) ?></h3>
      <ul>
      <?php foreach($mods as $i=>$m): $key = strtolower($level.'-'.$i); ?>
        <li>
          <?= htmlspecialchars($m) ?>
          <?php if (in_array($key, $doneSet)): ?>
            <span class="badge">Done</span>
          <?php else: ?>
            <form method="post" style="display:inline">
              <input type="hidden" name="complete" value="<?= htmlspecialchars($key) ?>">
              <button class="btn">Mark Complete</button>
            </form>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endforeach; ?>
  <div class="card">
    <h3>Certificate (Demo)</h3>
    <p>When you finish Beginner, print your certificate:</p>
    <a class="btn" href="certificate.php?track=Beginner">Generate</a>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
