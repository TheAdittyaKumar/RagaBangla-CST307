<?php
require_once __DIR__.'/_header.php';
require_login();

$id = (int)($_GET['id'] ?? 0);
$names = [
  1 => 'Ustad Alauddin Khan',
  2 => 'Ustad Bade Ghulam Ali Khan',
  3 => 'Sujit Mustafa',
];
$name = $names[$id] ?? 'Musician';
?>
<div class="card">
  <h1 class="header"><?= h($name) ?></h1>
  <p>Mr. Sujit Mustafa is the son of Late Abu Hena Mustafa Kamal, renowned poet, singer and composer. Born in Pabna, Mr. Sujit Mustafa has received training in classical music from well-known gurus such as Pandit Vinod Kumar at the Gandharva Mahavidiyaloya, New Delhi and Pandit Amarnath of Indore Gharana at the Shriram Bharatia Kala Kendra, New Delhi. He has also completed a five year certificate course in classical music from Chhayanaut, and has a diploma from Bangladesh Shilpakala Academy.
Mr. Mustafa has presented songs in the genres of classical, semi classical, Nazrulgeeti and modern Bangla songs in several performances at home and abroad. He performed at the concert organized at the Delhi Siriford Auditorium in 1990 on the occasion of Pandit Ravi Shankar’s 70th birthday celebrations. He was selected amongst several international students in India to perform classical music at the Videshi Kalakar Uthsab organized by the Sahitya Kala Parishad at New Delhi in 1990. Mr. Mustafa has also performed in countries such as USA, UK, France, Australia, Japan, China, Nepal, Srilanka, among others. He has also been interviewed by prominent Bangladeshi print and electronic media as well as BBC and Radio Spectrum (both UK based), Ekushey Betar, Australia and Brisbane Bangla Radio. He is a “Special” grade artist of Bangladesh TV and Bangladesh Betar as singer of modern and Nazrul’s songs.
Mr. Mustafa has released several albums such as “Amar Ganer Prothom Choronkhani” “Onek Brishty Jhore”, and “Dure Bohudure”. He is the editor of a monthly magazine on Bangladesh’s national poet, Kazi Nazrul Islam.</p>

  <div class="card">
    <h3>Performance Example</h3>
    <?php
      // Embed map for specific musicians
      $videoMap = [
        3 => 'https://www.youtube.com/embed/-PlqLHFXJr8', // Sujit Mustafa
      ];
    ?>
    <?php if (isset($videoMap[$id])): ?>
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:12px;">
        <iframe
          src="<?= h($videoMap[$id]) ?>"
          title="YouTube video player"
          style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen>
        </iframe>
      </div>
    <?php else: ?>
      <p>Embed YouTube or audio player here.</p>
    <?php endif; ?>
  </div>

  <div class="card">
    <h3>Donate directly</h3>
    <p class="muted">Demo form. Hook to SSLCommerz/bKash/Nagad API.</p>
    <form method="post" action="donate.php">
      <input type="hidden" name="musician_id" value="<?= $id ?>">
      <label>Amount (BDT)</label><br>
      <input class="input" type="number" name="amount" min="50" step="10" required><br><br>
      <button class="btn">Donate</button>
    </form>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
