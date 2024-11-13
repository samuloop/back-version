ciao<?php
$PAGE = explode("/",$urlParsed["path"]);
$conta = count($PAGE)-1;
$PAGE = $PAGE[$conta];
if($PAGE == "error"){
?>
<!DOCTYPE HTML>
<html>
<head><style>body{background:#F3F3F3;}</style></head><body>errore 410</body>
</html>
<?php
}else{
?>
<!DOCTYPE HTML>
<html>
<head><style>body{background:red;}</style></head><body>errore 410</body>
</html>
<?php    
}
?>
