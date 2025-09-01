<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Bangladeshi Classical Musicians</h1>
  <div class="grid">
    <div class="card">
      <h3>Ustad Alauddin Khan</h3>
      <p>Maihar gharana legend.</p>
      <a class="btn" href="musician.php?id=1">View</a>
    </div>

    <div class="card">
      <h3>Ustad Bade Ghulam Ali Khan</h3>
      <p>Patiala gharana maestro.</p>
      <a class="btn" href="musician.php?id=2">View</a>
    </div>

    <!-- NEW -->
    <div class="card">
      <h3>Sujit Mustafa</h3>
      <p>Renowned Bangladeshi classical vocalist.</p>
      <a class="btn" href="musician.php?id=3">View</a>
    </div>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
