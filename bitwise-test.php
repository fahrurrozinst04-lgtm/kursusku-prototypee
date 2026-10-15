<?php
$READ = 1;
$WRITE = 2;
$DELETE = 4;
$permission = $READ | $WRITE;
$canRead = ($permission & $READ) === $READ;
$canWrite = ($permission & $WRITE) === $WRITE;
$canDelete = ($permission & $DELETE) === $DELETE;
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Bitwise Test</title><link rel="stylesheet" href="assets/css/style.css"></head><body class="utility-page"><main class="utility-card"><h1>Bitwise Permission Test</h1><pre><?php var_dump($canRead, $canWrite, $canDelete); ?></pre><a href="index.php">Kembali</a></main></body></html>
