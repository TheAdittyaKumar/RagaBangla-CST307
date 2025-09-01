<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
?>
<div class="card">
  <h1 class="header">Contests</h1>
  <?php if (!has_active_membership()): ?>
    <p class="flash">Contests are for members. <a href="membership.php">Get membership</a>.</p>
  <?php endif; ?>
  <div class="card">
    <h3>September Performance Challenge</h3>
    <p>Upload a 2–3 minute performance. Top 10 share prize pool.</p>
    <a class="btn" href="contest.php?id=1">Open</a>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
