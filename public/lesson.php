<?php
require_once __DIR__.'/_header.php';
require_login();
$id = (int)($_GET['id'] ?? 0);
$titles = [1=>'Raga Bhairav', 2=>'Raga Kafi', 3=>'Raga Desh'];
$title = $titles[$id] ?? 'Lesson';
?>
<div class="card">
  <h1 class="header"><?= h($title) ?></h1>
  <p>Here you can embed a YouTube performance, talas loop, aroh/avroh, pakad, and notation.</p>
  <div class="card">
    <h3>Quick Quiz</h3>
    <p>After watching, try a <a href="quiz_take.php?id=<?= $id ?>">2-min quiz</a>.</p>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
