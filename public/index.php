<?php
// public/index.php — gate everything behind auth
require_once __DIR__.'/../lib/auth.php';
if (current_user()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit;
