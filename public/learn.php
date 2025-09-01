<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Learn · Raga Library</h1>
  <p class="muted">Sample modules (seed data). Replace with your CMS content.</p>
  <div class="grid">
    <div class="card"><h3>Raga Bhairav</h3><p>Time: Morning · Thaat: Bhairav</p><a class="btn" href="lesson.php?id=1">Open</a></div>
    <div class="card"><h3>Raga Kafi</h3><p>Time: Evening · Thaat: Kafi</p><a class="btn" href="lesson.php?id=2">Open</a></div>
    <div class="card"><h3>Raga Desh</h3><p>Time: Night · Thaat: Khamaj</p><a class="btn" href="lesson.php?id=3">Open</a></div>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
