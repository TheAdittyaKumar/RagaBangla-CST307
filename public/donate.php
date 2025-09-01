<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../lib/csrf.php';

// This is a placeholder donation page.
// In production, integrate a gateway like SSLCommerz (supports bKash/Nagad/CC).

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // For demo, we'll just record an intent
    $amount = (int)($_POST['amount'] ?? 0);
    $musician_id = (int)($_POST['musician_id'] ?? 0);
    $stmt = $pdo->prepare('INSERT INTO donations (user_id, musician_id, amount, status, gateway) VALUES (?,?,?,?,?)');
    $stmt->execute([current_user()['id'], $musician_id, $amount, 'initiated', 'manual']);
    flash('msg', 'Donation recorded (demo). Wire up the payment gateway next.');
    header('Location: musicians.php');
    exit;
}
?>
<div class="card">
  <h1 class="header">Donate</h1>
  <p>Use artist pages to start a donation. Payment gateway integration pending.</p>
</div>
<?php include __DIR__.'/_footer.php'; ?>
