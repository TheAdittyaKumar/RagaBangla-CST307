<?php
require_once __DIR__.'/../lib/auth.php';
require_once __DIR__.'/../lib/utils.php';
require_once __DIR__.'/../lib/csrf.php';
require_once __DIR__.'/../config/config.php';

if (current_user()) { header('Location: dashboard.php'); exit; }
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (login($email, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials.';
    }
}
include '_header.php';
?>
<div class="card">
  <h1 class="header">Log in</h1>
  <?php if($error): ?><div class="flash"><?= h($error) ?></div><?php endif; ?>
  <form method="post">
    <?php csrf_field(); ?>
    <label>Email</label><br>
    <input class="input" type="email" name="email" required><br><br>
    <label>Password</label><br>
    <input class="input" type="password" name="password" required><br><br>
    <button class="btn">Log in</button>
  </form>
  <p class="muted">No account? <a href="register.php">Register</a></p>
</div>
<?php include '_footer.php'; ?>
