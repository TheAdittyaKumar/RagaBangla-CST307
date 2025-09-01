<?php
require_once __DIR__.'/../lib/auth.php';
require_once __DIR__.'/../config/db.php';
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contest_id = (int)($_POST['contest_id'] ?? 0);
    $media_url = trim($_POST['media_url'] ?? '');
    $stmt = $pdo->prepare('INSERT INTO contest_entries (contest_id, user_id, media_url) VALUES (?,?,?)');
    $stmt->execute([$contest_id, current_user()['id'], $media_url]);
    header('Location: contests.php');
    exit;
}
?>
