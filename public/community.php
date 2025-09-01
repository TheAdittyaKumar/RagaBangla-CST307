<?php
require_once __DIR__.'/_header.php';
require_login();
require_once __DIR__.'/../config/db.php';
$uid=current_user()['id'];
if ($_SERVER['REQUEST_METHOD']==='POST'){
  if (isset($_POST['new_post'])){
    $stmt=$pdo->prepare('INSERT INTO community_posts (user_id, title, content) VALUES (?,?,?)');
    $stmt->execute([$uid, $_POST['title'], $_POST['content']]);
  } elseif (isset($_POST['new_comment'])) {
    $stmt=$pdo->prepare('INSERT INTO community_comments (post_id, user_id, content) VALUES (?,?,?)');
    $stmt->execute([$_POST['post_id'], $uid, $_POST['content']]);
  }
  header('Location: community.php'); exit;
}
$posts = $pdo->query('SELECT p.*, u.name FROM community_posts p JOIN users u ON u.id=p.user_id ORDER BY p.id DESC')->fetchAll();
?>
<div class="card">
  <h1 class="header">Community Q&A</h1>
  <div class="card">
    <h3>Start a discussion</h3>
    <form method="post">
      <input type="hidden" name="new_post" value="1">
      <label>Title</label><input class="input" name="title" required>
      <label>Question/Topic</label><textarea class="input" name="content" required></textarea><br>
      <button class="btn">Post</button>
    </form>
  </div>
  <?php foreach($posts as $p): ?>
    <div class="card">
      <h3><?= htmlspecialchars($p['title']) ?></h3>
      <p class="muted">By <?= htmlspecialchars($p['name']) ?> · <?= htmlspecialchars($p['created_at']) ?></p>
      <p><?= nl2br(htmlspecialchars($p['content'])) ?></p>
      <?php
        $c = $pdo->prepare('SELECT c.*, u.name FROM community_comments c JOIN users u ON u.id=c.user_id WHERE c.post_id=? ORDER BY c.id ASC');
        $c->execute([$p['id']]); $comments=$c->fetchAll();
      ?>
      <div class="card">
        <h4>Replies</h4>
        <?php foreach($comments as $cm): ?>
          <p><strong><?= htmlspecialchars($cm['name']) ?>:</strong> <?= nl2br(htmlspecialchars($cm['content'])) ?></p>
        <?php endforeach; ?>
        <form method="post">
          <input type="hidden" name="new_comment" value="1">
          <input type="hidden" name="post_id" value="<?= $p['id'] ?>">
          <textarea class="input" name="content" placeholder="Write a reply..." required></textarea><br>
          <button class="btn">Reply</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php include __DIR__.'/_footer.php'; ?>
