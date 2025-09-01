<?php
// lib/csrf.php

// Start a session only if one is not already active
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function csrf_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field() {
    $t = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    echo '<input type="hidden" name="csrf" value="'.$t.'">';
}

function verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            !isset($_POST['csrf']) ||
            !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])
        ) {
            http_response_code(419);
            exit('CSRF verification failed.');
        }
    }
}
