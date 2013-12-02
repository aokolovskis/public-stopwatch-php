<?php 
   list($usec, $sec) = explode(" ", microtime());
   $serverTime = time()*1000;
   $serverTime += (int)($usec*1000);
?>