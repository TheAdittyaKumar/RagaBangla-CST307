<?php
require_once __DIR__.'/../lib/auth.php';
require_once __DIR__.'/../config/db.php';
require_login();
$stmt=$pdo->prepare('INSERT INTO workshop_rsvps (user_id, event_id) VALUES(?,?)');
$stmt->execute([current_user()['id'], (int)($_GET['id'] ?? 0)]);
header('Location: events.php'); exit;
