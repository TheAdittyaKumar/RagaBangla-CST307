<?php
// public/_header.php
require_once __DIR__.'/../lib/auth.php';
require_once __DIR__.'/../lib/utils.php';
require_once __DIR__.'/../lib/i18n.php';
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h(constant('APP_NAME') ?? 'App') ?></title>
<link rel="stylesheet" href="assets/styles.css">
</head><body>
<nav class="nav">
  <div class="brand"><?= h(constant('APP_NAME') ?? 'App') ?></div>

  <?php if (current_user()): ?>
    <a href="dashboard.php"><?= t("dashboard") ?></a>
    <a href="learn.php"><?= t("learn") ?></a>
    <a href="practice.php"><?= t("practice") ?></a>
    <a href="curriculum.php"><?= t("curriculum") ?></a>
    <a href="leaderboard.php"><?= t("leaderboard") ?></a>
    <a href="musicians.php"><?= t("musicians") ?></a>
    <a href="quizzes.php"><?= t("quizzes") ?></a>
    <a href="contests.php"><?= t("contests") ?></a>
    <a href="donate.php"><?= t("donate") ?></a>
    <a href="membership.php"><?= t("membership") ?></a>
    <a href="wallet.php"><?= t("wallet") ?></a>
    <a href="events.php"><?= t("events") ?></a>
    <a href="community.php"><?= t("community") ?></a>
    <a href="referrals.php"><?= t("referrals") ?></a>
    <a href="safety.php"><?= t("safety") ?></a>
  <?php endif; ?>

  <div class="spacer"></div>

  <?php if (current_user()): ?>
    <span class="badge"><?= t("hello") ?>, <?= h(current_user()['name']) ?></span>
    <a href="?lang=<?= ($_SESSION['lang'] ?? 'en') === 'bn' ? 'en' : 'bn' ?>"><?= t("lang_toggle") ?></a>
    <a href="logout.php"><?= t("logout") ?></a>
  <?php else: ?>
    <a href="?lang=<?= ($_SESSION['lang'] ?? 'en') === 'bn' ? 'en' : 'bn' ?>"><?= t("lang_toggle") ?></a>
    <?php $page = basename($_SERVER['PHP_SELF']); ?>
    <?php if ($page !== 'login.php'): ?><a href="login.php"><?= t("login") ?></a><?php endif; ?>
    <?php if ($page !== 'register.php'): ?><a href="register.php"><?= t("register") ?></a><?php endif; ?>
  <?php endif; ?>
</nav>

<div class="container">
<?php if ($f = flash('msg')) echo $f; ?>
