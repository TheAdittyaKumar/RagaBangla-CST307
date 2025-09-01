<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
$uid=current_user()['id'];
$code = $uid; // simplest code
$base = rtrim(constant('APP_URL'),'/');
$link = $base.'/register.php?ref='.$code;
$cnt = $pdo->prepare('SELECT COUNT(*) AS c FROM referrals WHERE referrer_id=?');
$cnt->execute([$uid]); $count=$cnt->fetch()['c'];
?>
<div class="card">
  <h1 class="header">Referrals</h1>
  <p>Share your link. When someone registers, they get tagged to you (demo).</p>
  <div class="card"><strong>Your link:</strong><br><input class="input" value="<?= htmlspecialchars($link) ?>" readonly></div>
  <p class="badge">Total referred: <?= (int)$count ?></p>
</div>
<?php include __DIR__.'/_footer.php'; ?>
