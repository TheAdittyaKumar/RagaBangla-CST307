<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
$uid = current_user()['id'];
if ($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=$pdo->prepare('INSERT INTO payouts(user_id, amount, method, status) VALUES(?, ?, "bkash", "requested")');
  $stmt->execute([$uid, (int)$_POST['amount']]);
  flash('msg','Withdrawal requested (demo).');
  header('Location: wallet.php'); exit;
}
$bal = $pdo->prepare('SELECT COALESCE(SUM(CASE WHEN type="credit" THEN amount WHEN type="debit" THEN -amount END),0) AS bal FROM wallet_transactions WHERE user_id=?');
$bal->execute([$uid]); $balance = (int)($bal->fetch()['bal'] ?? 0);
$tx = $pdo->prepare('SELECT * FROM wallet_transactions WHERE user_id=? ORDER BY id DESC');
$tx->execute([$uid]); $rows = $tx->fetchAll();
?>
<div class="card">
  <h1 class="header">Wallet</h1>
  <p class="badge">Balance: BDT <?= $balance ?></p>
  <form method="post" class="card">
    <label>Withdraw via bKash (demo)</label>
    <input class="input" type="number" name="amount" min="100" step="50" placeholder="Amount (BDT)" required>
    <button class="btn">Request Withdrawal</button>
  </form>
  <div class="card">
    <h3>Transactions</h3>
    <table class="table"><tr><th>Date</th><th>Type</th><th>Amount</th><th>Note</th></tr>
    <?php foreach($rows as $r): ?>
      <tr><td><?= htmlspecialchars($r['created_at']) ?></td><td><?= htmlspecialchars($r['type']) ?></td><td><?= (int)$r['amount'] ?></td><td><?= htmlspecialchars($r['note']) ?></td></tr>
    <?php endforeach; ?></table>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
