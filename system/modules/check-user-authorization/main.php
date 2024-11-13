<?php
if(!isset($_SESSION)){
session_start();
$noauth = ":-1";
$gid_lvl_start = explode(";",$noauth);
}
//scompongo l'array group and level per ottenere informazioni circa le possibilità di accessedere a questo modello da parte dell'utente
if(isset($_SESSION["USER-AUTH"])){
  $gid_lvl_start = explode(";",$_SESSION["USER-AUTH"]);
 }
//creo due sotto_array
$_SESSION["USER_GIDS"] = array();
$_SESSION["USER_LEVELS"] = array();
foreach($gid_lvl_start AS $gls){
  $var = explode(":",$gls);
  if($var[0] == ""){$var[0] = "nogroup_id";}
  if(isset($var[1])){
  if($var[1] == ""){$var[1] = "nolevel";}
}
  $_SESSION["USER_GIDS"][] = $var[0];
  $_SESSION["USER_LEVELS"][] = $var[1];
}
$user_gids = $_SESSION["USER_GIDS"];
$user_levels = $_SESSION["USER_LEVELS"]; 
$_POST["isUserAllowedViewThisPage"] = "bv_No";
if(isset($_POST)){$model_group_ID = $_POST["bv_model_gid"];}
if(isset($_POST)){$node_group_ID = $_POST["bv_node_gid"];}
if(in_array($model_group_ID,$_SESSION["USER_GIDS"])){
if(in_array($node_group_ID,$_SESSION["USER_GIDS"])){ //prima controlla che il gruppo del modello corrisponda al gruppo dell'utente, poi lo stesso con il gruppo del nodo {che è più specifico e vincolante}
$_POST["isUserAllowedViewThisPage"] = "bv_Si";
}else{
$_POST["isUserAllowedViewThisPage"] = "bv_No"; //echo("nogroup_id del nodo");
}//fine controllo gruppo del nodo
}else{
$_POST["isUserAllowedViewThisPage"] = "bv_No"; //echo("nogroup_id del modello e del nodo");
}
//$file = 'people.txt'; $current = file_get_contents($file); $current .= $_SESSION["USER-AUTH"]; file_put_contents($file, $current, FILE_APPEND);
?>
