<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=$pdo->prepare('INSERT INTO payments(user_id, amount, method, status, ref) VALUES(?, ?, "bkash", "simulated-paid", ?)');
  $stmt->execute([current_user()['id'], (int)$_POST['amount'], $_POST['bkash_number']]);
  flash('msg','bKash payment recorded (demo).');
  header('Location: membership.php'); exit;
}
?>
<div class="card">
  <h1 class="header">bKash Payment (Demo)</h1>
  <p>Enter your bKash number and amount. This does not charge your account—it's a placeholder UI only.</p>
  <form method="post">
    <label>bKash Number</label><input class="input" name="bkash_number" required>
    <label>Amount (BDT)</label><input class="input" type="number" name="amount" min="50" step="10" required><br>
    <button class="btn">Confirm</button>
  </form>
</div>
<?php include __DIR__.'/_footer.php'; ?>
