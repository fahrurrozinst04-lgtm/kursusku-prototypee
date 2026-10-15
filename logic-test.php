<?php
$quota = 30;
$registered = 18;
$isFull = $registered >= $quota;
$hasSeat = $registered < $quota;
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Logic Test</title><link rel="stylesheet" href="assets/css/style.css"></head><body class="utility-page"><main class="utility-card"><h1>Logic Test</h1><pre><?php var_dump($isFull); var_dump($hasSeat); ?></pre><a href="index.php">Kembali</a></main></body></html>
