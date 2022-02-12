<?php

$tanggal = filter_input(INPUT_GET, 'tanggal', FILTER_SANITIZE_STRING);
$show_jam = filter_input(INPUT_GET, 'show_jam', FILTER_SANITIZE_STRING);
$bk = filter_input(INPUT_GET, 'bk', FILTER_SANITIZE_STRING);

echo $tanggal . '<br>';
echo $show_jam . '<br>';
echo $bk . '<br>';
?>