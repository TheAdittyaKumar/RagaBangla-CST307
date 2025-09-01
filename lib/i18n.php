<?php
// lib/i18n.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'] === 'bn' ? 'bn' : 'en';
    if (!headers_sent()) {
        $to = strtok($_SERVER['REQUEST_URI'], '?');
        header("Location: $to");
        exit;
    }
}
function t($key) {
    $lang = $_SESSION['lang'] ?? 'en';
    $map = [
        'en' => [
            'dashboard' => 'Dashboard',
            'learn' => 'Learn',
            'practice' => 'Practice',
            'leaderboard' => 'Leaderboard',
            'musicians' => 'Musicians',
            'quizzes' => 'Quizzes',
            'contests' => 'Contests',
            'donate' => 'Donate',
            'membership' => 'Membership',
            'wallet' => 'Wallet',
            'events' => 'Events',
            'community' => 'Community',
            'curriculum' => 'Curriculum',
            'referrals' => 'Referrals',
            'safety' => 'Safety',
            'login' => 'Login',
            'register' => 'Register',
            'logout' => 'Logout',
            'hello' => 'Hi',
            'lang_toggle' => 'বাংলা',
        ],
        'bn' => [
            'dashboard' => 'ড্যাশবোর্ড',
            'learn' => 'শিখুন',
            'practice' => 'প্র্যাকটিস',
            'leaderboard' => 'লিডারবোর্ড',
            'musicians' => 'শিল্পী',
            'quizzes' => 'কুইজ',
            'contests' => 'কনটেস্ট',
            'donate' => 'ডোনেট',
            'membership' => 'মেম্বারশিপ',
            'wallet' => 'ওয়ালেট',
            'events' => 'ইভেন্টস',
            'community' => 'কমিউনিটি',
            'curriculum' => 'কারিকুলাম',
            'referrals' => 'রেফারাল',
            'safety' => 'নিরাপত্তা',
            'login' => 'লগইন',
            'register' => 'রেজিস্টার',
            'logout' => 'লগআউট',
            'hello' => 'সালাম',
            'lang_toggle' => 'English',
        ],
    ];
    return $map[$lang][$key] ?? $key;
}
?>