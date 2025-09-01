<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../lib/csrf.php';

$quiz_id = (int)($_GET['id'] ?? 0);

// minimal demo with static questions when DB is empty
$demo = [
  1 => [
    ['q' => 'Which thaat is Raga Bhairav associated with?', 'a' => ['Kalyan','Bhairav','Todi','Asavari'], 'c'=>1],
  ],
  2 => [
    ['q' => 'Kafi is traditionally performed in which time?', 'a' => ['Morning','Afternoon','Evening','Late Night'], 'c'=>2],
  ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $answers = $_POST['ans'] ?? [];
    $score = 0;
    foreach (($demo[$quiz_id] ?? []) as $idx=>$item) {
        $correct = $item['c'];
        if ((int)($answers[$idx] ?? -1) === $correct) $score += 10;
    }
    // store submission
    $stmt = $pdo->prepare('INSERT INTO quiz_submissions (quiz_id, user_id, score) VALUES (?,?,?)');
    $stmt->execute([$quiz_id, current_user()['id'], $score]);
    flash('msg', 'You scored '.$score.' points!');
    header('Location: leaderboard.php');
    exit;
}

include __DIR__.'/_header.php';
?>
<div class="card">
  <h1 class="header">Quiz</h1>
  <form method="post">
    <?php csrf_field(); ?>
    <?php foreach (($demo[$quiz_id] ?? []) as $i=>$item): ?>
      <div class="card">
        <strong>Q<?= $i+1 ?>. <?= h($item['q']) ?></strong><br>
        <?php foreach ($item['a'] as $k=>$opt): ?>
          <label><input type="radio" name="ans[<?= $i ?>]" value="<?= $k ?>"> <?= h($opt) ?></label><br>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    <button class="btn">Submit</button>
  </form>
</div>
<?php include __DIR__.'/_footer.php'; ?>
