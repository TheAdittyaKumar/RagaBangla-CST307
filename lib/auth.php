<?php
// lib/auth.php
require_once __DIR__.'/../config/db.php';

if (session_status() === PHP_SESSION_NONE) { session_start(); }

function current_user() {
    return $_SESSION['user'] ?? null;
}
function require_login() {
    if (!current_user()) {
        header('Location: login.php');
        exit;
    }
}
function login($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT id, name, email, password_hash, role, membership_expires_at FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'membership_expires_at' => $user['membership_expires_at']
        ];
        return true;
    }
    return false;
}
function logout() {
    $_SESSION = [];
    session_destroy();
}
function has_active_membership() {
    $u = current_user();
    if (!$u) return false;
    if (empty($u['membership_expires_at'])) return false;
    return (strtotime($u['membership_expires_at']) > time());
}
?>