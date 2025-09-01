<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=$pdo->prepare('INSERT INTO teacher_applications(user_id, nid, bkash, bank_acc, agree_share, status) VALUES(?,?,?,?,?, "pending")');
  $stmt->execute([current_user()['id'], $_POST['nid'], $_POST['bkash'], $_POST['bank_acc'], $_POST['agree_share']]);
  flash('msg','Application submitted. We'll review soon (demo).');
  header('Location: teacher_onboarding.php'); exit;
}
?>
<div class="card">
  <h1 class="header">Teacher Onboarding</h1>
  <form method="post">
    <label>NID/Passport</label><input class="input" name="nid" required>
    <label>bKash Number</label><input class="input" name="bkash" required>
    <label>Bank Account (optional)</label><input class="input" name="bank_acc">
    <label>Agree to revenue share (e.g., 70%)</label><input class="input" name="agree_share" value="70%" required>
    <br><button class="btn">Submit</button>
  </form>
</div>
<?php include __DIR__.'/_footer.php'; ?>
