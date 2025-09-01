<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Events & Workshops</h1>
  <div class="grid">
    <div class="card"><h3>Masterclass: Raga Yaman</h3><p>Sat 7pm · Zoom</p><a class="btn" href="workshop_rsvp.php?id=1">RSVP (Free)</a></div>
    <div class="card"><h3>Meetup: Dhaka Classical Circle</h3><p>Sun 4pm · TSC</p><a class="btn" href="workshop_rsvp.php?id=2">RSVP (Free)</a></div>
  </div>
</div>
<?php include __DIR__.'/_footer.php'; ?>
