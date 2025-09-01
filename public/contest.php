<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';

$id = (int)($_GET['id'] ?? 0);
?>
<div class="card">
  <h1 class="header">Contest #<?= $id ?></h1>
  <?php if (!has_active_membership()): ?>
    <p class="flash">You need membership to join. <a href="membership.php">Activate</a>.</p>
  <?php else: ?>
    <form class="card" method="post" enctype="multipart/form-data" action="upload_entry.php">
      <input type="hidden" name="contest_id" value="<?= $id ?>">
      <label>Performance video URL (YouTube/unlisted)</label><br>
      <input class="input" type="url" name="media_url" required><br><br>
      <button class="btn">Submit Entry</button>
    </form>
  <?php endif; ?>
</div>
<?php include __DIR__.'/_footer.php'; ?>
