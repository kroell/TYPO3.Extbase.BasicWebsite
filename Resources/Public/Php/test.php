<?php
echo date('d.m.Y H:i:s') . '<br />';
$start = microtime(TRUE);

$a = 'Hallo<br />';

echo $a;

$stop = microtime(TRUE);

echo number_format($stop-$start, 20) . '<br />';

echo date('d.m.Y H:i:s') . '<br />';
