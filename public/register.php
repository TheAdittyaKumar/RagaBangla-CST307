<?php
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../lib/utils.php';
require_once __DIR__.'/../lib/csrf.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$name || !$email || strlen($password) < 6) {
        $error = 'Please fill all fields (password at least 6 chars).';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users(name, email, password_hash) VALUES(?,?,?)');
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $uid = $pdo->lastInsertId();
            if (!empty($_GET['ref'])) { $ref = (int)$_GET['ref']; $pdo->prepare('INSERT INTO referrals(referrer_id, new_user_id) VALUES(?,?)')->execute([$ref, $uid]); }
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Email already registered or invalid.';
        }
    }
}
include '_header.php';
?>
<div class="card">
  <h1 class="header">Create account</h1>
  <?php if($error): ?><div class="flash"><?= h($error) ?></div><?php endif; ?>
  <form method="post">
    <?php csrf_field(); ?>
    <label>Name</label><br>
    <input class="input" type="text" name="name" required><br><br>
    <label>Email</label><br>
    <input class="input" type="email" name="email" required><br><br>
    <label>Password</label><br>
    <input class="input" type="password" name="password" required><br><br>
    <button class="btn">Register</button>
  </form>
</div>
<?php include '_footer.php'; ?>
