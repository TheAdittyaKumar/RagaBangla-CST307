<?php
require_once __DIR__.'/_header.php';
require_login();
$track = htmlspecialchars($_GET['track'] ?? 'Track');
$name = htmlspecialchars(current_user()['name']);
?>
<style>
.cwrap{background:#f4f4f4;padding:40px}
.cert{max-width:800px;margin:0 auto;border:10px solid #c0c0c0;padding:40px;background:white;text-align:center}
.cert h1{font-size:42px;margin:10px 0}
.cert h2{font-size:24px;color:#555;margin:10px 0}
.seal{margin-top:30px}
</style>
<div class="cwrap">
  <div class="cert">
    <h2>Certificate of Completion</h2>
    <h1><?= $name ?></h1>
    <p>has successfully completed the</p>
    <h2><?= $track ?> Curriculum</h2>
    <p>at RagaBangla · <?= date('F j, Y') ?></p>
    <div class="seal">────────── ✦ ──────────</div>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
