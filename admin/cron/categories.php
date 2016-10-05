<?php
$Url      = "http://techdefeat.com/admin/category.php?action=undo"; 
$Handle   = curl_init($Url);
$Response = curl_exec($Handle);
curl_close($Handle);
?>