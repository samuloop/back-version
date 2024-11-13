<?php include_once("system/libraries/connect.php"); ?>
<?php 
//Prima cosa Parsing dell'URL
$thisPageUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(filter_var($thisPageUrl, FILTER_VALIDATE_URL)){
    $urlParsed = parse_url($thisPageUrl);
    //Imposto una variabile di stato che se è uguale a 1 (accesa), è tutto ok altrimenti blocca lo stream
    $FLAG = 0; //FLAG è la variabile di stato
    if((($urlParsed["scheme"] === "https")||($urlParsed["scheme"] === "http")) && 
       ($urlParsed["host"] === $_POST["PUBLIC_HOST"])){
	$baseUrl_model = explode("/", $urlParsed["path"]); 
	$baseUrl_model = str_replace("/","",$baseUrl_model[1]); 
	if($baseUrl_model == ""){$baseUrl_model = "/";}
	//PRIMO FOR IN CUI ESCLUDO I MODELLI DIVERSI
	$query_m0 = $db1 ->query("SELECT * FROM bv_models JOIN bv_nodes ON bv_models.BaseUrl_model = bv_nodes.NodeUrl WHERE bv_models.BaseUrl_model = '$baseUrl_model' OR bv_models.BaseUrl_model = '$baseUrl_model/' AND (bv_models.Disabled_model != 1 OR bv_models.Disabled_model IS NULL) AND (bv_nodes.Disabled_node != 1 OR bv_nodes.Disabled_node IS NULL)");
	$query_m0_result = $query_m0->fetchAll(PDO::FETCH_ASSOC);
	$query_m0_result_rows = $query_m0->rowCount();
	if($query_m0_result_rows != 1){ 
	  if(substr_count($urlParsed["path"],"/") == 1){ //Se c'è un solo slash cerca il modello che ha come URL la radice "/" -> inserito questo controllo per problemi di riferimenti con le URL.
	    $baseUrl_model = "/"; 
	  }
	}
	//VERO FOR IN CUI CERCO IL MODELLO CHE A QUESTO PUNTO DEVE CORRISPONDERE A / se URL PARSED ha un solo slash
	$query_m = $db1 ->query("SELECT * FROM bv_models JOIN bv_nodes ON bv_models.BaseUrl_model = bv_nodes.NodeUrl WHERE bv_models.BaseUrl_model = '$baseUrl_model' OR bv_models.BaseUrl_model = '$baseUrl_model/' AND (bv_models.Disabled_model != 1 OR bv_models.Disabled_model IS NULL) AND (bv_nodes.Disabled_node != 1 OR bv_nodes.Disabled_node IS NULL)");
	$query_m_result = $query_m->fetchAll(PDO::FETCH_ASSOC);
	$query_m_result_rows = $query_m->rowCount();
	if($query_m_result_rows == 1){
	    for($i=0; $i<$query_m_result_rows; $i++){
	      $_POST["bv_model"] = $query_m_result[$i]["ID_model"];
		$_POST["bv_model_dir"] = $query_m_result[$i]["Directory_model"];
		$_POST["BaseUrl_model"] = $query_m_result[$i]["BaseUrl_model"];
		$_POST["bv_model_gid"] = $query_m_result[$i]["GROUP_model"]; 
		if($_POST["bv_model_gid"] == ""){$_POST["bv_model_gid"] = "nogroup_id";} //Si ipotizzi un accesso ad un BV_MODEL disattivato non autorizzato
		$_POST["bv_node_gid"] = $query_m_result[$i]["GROUP_node"];
		$_POST["bv_node_level"] = $query_m_result[$i]["LEVEL_node"];
		if($_POST["bv_node_gid"] == ""){$_POST["bv_node_gid"] = "nogroup_id";} //Si ipotizzi un accesso ad un BV_MODEL disattivato non autorizzato
		if($_POST["bv_node_level"] == ""){$_POST["bv_node_level"] = "nolevel";} //Si ipotizzi un accesso ad un BV_MODEL disattivato non autorizzato
	    }
	    include_once "$_POST[LOCALE_PATH]/system/modules/check-user-authorization/main.php";
	    if((isset($_POST["isUserAllowedViewThisPage"]))&&($_POST["isUserAllowedViewThisPage"] == "bv_Si")){
	      if(isset($_POST["bv_model_dir"])){
		include_once "$_POST[LOCALE_PATH]/system/modules/check-url-integrity/main.php";
		if((isset($_POST["is_url_well_formed"]))&&($_POST["is_url_well_formed"] == "bv_Si")){
		  include_once "$_POST[LOCALE_PATH]/system/models/$_POST[bv_model_dir]/model.php";
		}else{// se l'url è ben formata si delega al modello la gestione delle "proprie" URL
		  BV_ERROR_PAGE();
		}
	      }else{
		BV_ERROR_PAGE(); //se IL MODELLO è sbagliato
	      }
	    }else{ //se l'utente NON fosse abilitato nel modello/nodo
	      header("Location: /auth/",true,301); exit;
	    }
	}else{
	  BV_ERROR_PAGE(); //se IL MODELLO è sbagliato
	}
    }
}
?>
