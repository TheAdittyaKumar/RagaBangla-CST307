<?php
// lib/utils.php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function flash($key, $msg=null) {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if ($msg !== null) {
        $_SESSION['flash'][$key] = $msg;
        return;
    }
    if (!empty($_SESSION['flash'][$key])) {
        $m = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return '<div class="flash">'.$m.'</div>';
    }
    return '';
}
?>