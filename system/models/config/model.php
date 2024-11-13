<?php 
switch($urlParsed["path"]){
case "/config" : { header("location: /config/"); }break;
case "/config/" : {  
?>
<!Doctype HTML>
<html lang="it">
    <head>
	<title>Back Version Login</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/tema/config/stile.css" />
	<meta name="robots" content="noindex,nofollow" />
	<script src="/tema/config/scripts/client.js"></script>
<link rel="icon" href="/tema/config/icons/favicon.ico" />
</head>
<body>
    <header class="custom-wrapper pure-g" id="menu">
	<div id="sottomenu-pieno"></div>
	<div class="pure-u-1 pure-u-md-3-24">
	    <div class="pure-menu">
		<a href="/config/" class="pure-menu-heading custom-brand"><img src="/img/back-version-logo.svg" alt="back version logo Light" height="42" /></a>
		<div id="hamburger" class="custom-toggle">&#9776;</div>
	    </div>
	</div>
        <div class="pure-u-1 pure-u-md-11-24" id="mainmenu">
	    <div class="pure-menu pure-menu-horizontal custom-can-transform">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
			<a href="#" class="pure-menu-link">Articoli</a>
			<ul class="pure-menu-children">
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Aggiungi nuovo</a></li>  
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Tutti gli articoli</a></li>  
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Categorie</a></li>  
			</ul>
		    </li>
	            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover ">
			<a href="#" id="menuLink1" class="pure-menu-link">Pagine istituzionali</a>
			<ul class="pure-menu-children">
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Aggiungi nuova</a></li>  
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Tutte le pagine</a></li>  
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Tassonomia</a></li>  
			</ul>
		    </li>
	            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover ">
			<a href="#" id="menuLink1" class="pure-menu-link">Media</a>
			<ul class="pure-menu-children">
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Aggiungi nuovo</a></li>  
			    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Galleria media</a></li>  
			</ul>
		    </li>
	            <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover ">
			<a href="#" id="menuLink1" class="pure-menu-link">Utenti</a>
			<ul class="pure-menu-children">
			    <li class="pure-menu-item">	<a href="#" class="pure-menu-link">Utenti</a></li>  
			    <li class="pure-menu-item">	<a href="#" class="pure-menu-link">Ruoli</a></li>  
			</ul>
		    </li>
                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Logs</a></li>
                </ul>
            </div>
          </div>
        <div class="pure-u-1 pure-u-md-10-24 adestra rent" >
	    <div class="pure-menu pure-menu-horizontal custom-can-transform">
		<ul class="pure-menu-list adestra" style="vertical-align:middle;">
                    <li class="pure-menu-item adestra versione">Back Version v.2.0.0</li>
		    <li class="pure-menu-item">
			<div class="cambia-tema">
			    <label class="cambia-tema-label" for="checkbox">
				<input type="checkbox" id="checkbox" />
				<div class="sole-e-luna sole"></div>
			    </label>
			</div>

		    </li>
		    <li class="pure-menu-item">
			<form class="pure-form pure-g" id="cercaform">	
			    <input type="search" name="cercaoperazioni" id="cercaoperazioni" placeholder="Azioni rapide" class="pure-input-1-2" />
			    <button type="submit" id="cercabtn" class="pure-button">Esegui</button>
			</form>
		    </li>
		    <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
			<a href="#" id="menuLink1" class="pure-menu-link">Profilo</a>
			<ul class="pure-menu-children">
			    <li class="pure-menu-item logout">
				<?php if(isset($_SESSION["ACCOUNT"])){ ?> 
				    <a href="/auth/sign-out" class="pure-button" title="Disconnettiti">Disconnettiti</a>
				<?php } ?>
			    </li>  
			</ul>
 </li>
 
                </ul>
            </div>
        </div>
    </header>
</body>
</html>
<?php 
} break; //end auth model /config/
default : { 
 BV_ERROR_PAGE(); 
} //end default; 
} //end switch
?>
