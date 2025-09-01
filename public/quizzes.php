<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Quizzes</h1>
  <p>Short assessments to reinforce learning.</p>
  <ul>
    <li><a href="quiz_take.php?id=1">Raga Bhairav Basics</a></li>
    <li><a href="quiz_take.php?id=2">Raga Kafi Basics</a></li>
  </ul>
</div>
<?php include __DIR__.'/_footer.php'; ?>
