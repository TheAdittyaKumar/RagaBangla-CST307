<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Demo: activate 30-day membership
    $expires = date('Y-m-d H:i:s', strtotime('+30 days'));
    $stmt = $pdo->prepare('UPDATE users SET membership_expires_at = ? WHERE id = ?');
    $stmt->execute([$expires, current_user()['id']]);
    $_SESSION['user']['membership_expires_at'] = $expires;
    flash('msg', 'Membership activated (demo) until '.$expires.'. Connect a payment gateway for real checkout.');
    header('Location: membership.php'); exit;
}
?>
<div class="card">
  <h1 class="header">Membership</h1>
  <p>Members can join contests and unlock advanced lessons.</p>
  <?php if (has_active_membership()): ?>
    <p class="badge">Active until <?= h(current_user()['membership_expires_at']) ?></p>
  <?php else: ?>
    <a class="btn" href="bkash_checkout.php">Pay with bKash (Demo)</a>
    <form method="post" style="margin-top:10px"><button class="btn">Activate (skip payment)</button></form>
    <p class="muted">No real charge happens here.</p>
  <?php endif; ?>
</div>
<?php include __DIR__.'/_footer.php'; ?>
