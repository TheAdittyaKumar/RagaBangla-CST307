<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Welcome to <?= h(constant('APP_NAME')) ?> 🎶</h1>
  <p>CST307 sir kindly give some bonus mark please</p>
  <p class="muted">Your hub for Bangladeshi classical music: Raga lessons, quizzes, musicians, contests & more.</p>
  <div class="grid">
    <div class="card"><h3>Start learning</h3><p>Explore ragas, taals, gharanas with guided lessons & videos.</p><a class="btn" href="learn.php">Go to Learn</a></div>
    <div class="card"><h3>Test yourself</h3><p>Short quizzes after each module. Earn points and climb the leaderboard.</p><a class="btn" href="quizzes.php">Take a Quiz</a></div>
    <div class="card"><h3>Meet musicians</h3><p>Profiles of legendary & contemporary artists with performance samples.</p><a class="btn" href="musicians.php">Browse Musicians</a></div>
    <div class="card"><h3>Win prizes</h3><p>Join monthly performance contests (members). Cash rewards & badges.</p><a class="btn" href="contests.php">View Contests</a></div>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
