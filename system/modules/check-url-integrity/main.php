<?php
$_POST["is_url_well_formed"] = "bv_Si";
$posted_baseurl = $_POST["BaseUrl_model"];
if(strpos($urlParsed["path"],$_POST["BaseUrl_model"]) !== -1){
$IDCHECK = array();
$query_m1 = $db1 ->query("SELECT * FROM bv_nodes WHERE NodeUrl = '$posted_baseurl' AND (Disabled_node != 1 OR Disabled_node IS NULL)");
$query_m1_result = $query_m1->fetchAll(PDO::FETCH_ASSOC);
$query_m1_result_rows = $query_m1->rowCount();
if($query_m1_result_rows == 1){
 //se esiste il nodo con url uguale al modello chiamato
for($i=0; $i<$query_m1_result_rows; $i++){
$IDCHECK[0] = $query_m1_result[$i]["RIF_model"];
}
//esplodo l'urlparsed-path per "/" e conto quanti elemeni ha l'array: ogni due elementi c'è uno slash nel mezzo
$url_to_check = $urlParsed["path"]; //echo $url_to_check . "<br>";
$url_to_check = str_replace("/" . $_POST["BaseUrl_model"],"",$url_to_check); 
//echo $url_to_check . "<br>";
$url_elements = explode("/",$url_to_check);
$url_elements_n = count($url_elements); 
$numero_fisso = array();
$numero_fisso[0] = 1;
if($posted_baseurl == ""){$start = 1;}else{$start = 0;}
for($i=$start;$i<$url_elements_n; $i++){
$elemento = $url_elements[$i];
//echo $elemento . " = elemento <br>";
$idmodello = $IDCHECK[0];
$query_m2 = $db1 ->query("SELECT * FROM bv_nodes WHERE (NodeUrl = '$elemento' OR NodeUrl = '$elemento/') AND (Disabled_node != 1 OR Disabled_node IS NULL) AND (RIF_leftNode = '$idmodello' OR RIF_leftNode IS NULL)");
$query_m2_result = $query_m2->fetchAll(PDO::FETCH_ASSOC);
$query_m2_result_rows = $query_m2->rowCount();
//echo $query_m2_result_rows . " righe <br>";
if($query_m2_result_rows == 1){ //se esiste CORRISPONDENZA di padre e figlio
$parita = $numero_fisso[0] * 1;
//echo $parita . "SE 1 <br>";
}else{
$parita = $numero_fisso[0] * 0;
//echo $parita;
}
}
if($parita == 1){
$_POST["is_url_well_formed"] = "bv_Si"; 
}else{
$_POST["is_url_well_formed"] = "bv_No"; 
}
}else{$_POST["is_url_well_formed"] = "bv_No";}
}
//echo $_POST["is_url_well_formed"];
?>
