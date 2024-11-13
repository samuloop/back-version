<?php 
switch($urlParsed["path"]){
case "/auth/verify" : { include_once('verify.php'); }break;
case "/auth/sign-up" : { include_once('sign-up.php'); }break;
case "/auth/password-recovery" : { include_once('password-recovery.php'); }break;
case "/auth/sign-in" : { include_once('sign-in.php'); }break; //end auth model /auth/sign-in
case "/auth/sign-out" :{ include_once('sign-out.php');}break;
case "/auth" : { header("location: /auth/"); }break;
case "/auth/" : {  
?>
<!Doctype HTML>
<html lang="it">
<head>
<title>Back Version Login</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/tema/auth/stile.css" />
<meta name="robots" content="noindex,nofollow" />
<link rel="icon" href="/tema/auth/icons/favicon.ico" />
</head>
<body>
<header>
<div class="pure-g">
<div class="pure-u-1-3">
<a href="/">Torna indietro</a>
</div>
<div class="pure-u-1-3">
<img class="pure-img" src="/img/bv-logo-light.svg" alt="back version logo Light" width="100" height="45" />
</div>
<div class="pure-u-1-3">
<?php if(isset($_SESSION["ACCOUNT"])){ ?> 
    <a href="/auth/sign-out" title="Disconnettiti">Disconnettiti</a>
<?php } ?>
</div>
</div>
</header>
<div class="content pure-g">
<div class="pure-u-1"><h1>Ciao, ci conosciamo?</div>
<div class="pure-u-1 pure-u-lg-1-5"></div>
<div class="pure-u-1 pure-u-lg-3-5">
<div class="pure-g">
<div class="pure-u-1 pure-u-lg-1-2" style="">
<div class="login">
<div class="loginform">
<h2>Hai già un profilo?</h2>
<?php if(!isset($_SESSION["ACCOUNT"])){ ?>
<form name="auth" id="auth_form" method="post" action="" class="pure-form pure-form-stacked ">
<div class="field">
<input type="text" name="email" id="email" placeholder="" required="" />
<label for="email">Indirizzo email</label>
</div>
<div class="field">
<input type="password" name="password" id="password" required="" placeholder="" />
<label for="password">Password</label>
<div id="eyes" class="show-password-on"></div>
<script>let finger_on_eye = document.getElementById("eyes"); finger_on_eye.addEventListener('mousedown',function(a){ 
 let tipo = document.getElementById('password'); 
 if((tipo.getAttribute('type') == 'password')&&(finger_on_eye.getAttribute('class') == 'show-password-on')){
 tipo.setAttribute('type','text');
 finger_on_eye.setAttribute('class','show-password-off');
 }else{
  tipo.setAttribute('type','password');
 finger_on_eye.setAttribute('class','show-password-on'); 
 }
 });</script>
</div>
<div class="field align-r" style="font-weight:500;">Password dimenticata?
<input type="checkbox" />
</div>
<input type="submit" id="bv_submit" name="bv_submit" value="accedi" class="pure-button-primary pure-button" />
</form>
<script>
 var input = document.getElementsByClassName("input");
 var eml = document.getElementById("email");
 var pwd = document.getElementById("password");
 var snd = document.getElementById("bv_submit");
 snd.addEventListener("click", function(event){
 event.preventDefault();
 let form = document.getElementById('auth_form');
 var dati = new FormData(form);
 for(var i=0; i<input.length; i++){
  dati.append(input[i].name, input[i].value);
  }
  //dati.append(nome, nome.innerHTML);
var xmlHttp = new XMLHttpRequest(); 
xmlHttp.onreadystatechange = function(){
if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
var DivForm = document.getElementById("auth_form");
var response = xmlHttp.responseText;
     var rsp = response.split(''); //tranforma la string in array
     //console.log(rsp[1]);
     /*
	if(rsp[0] == "1"){document.getElementById('email').setAttribute("style","border: 1px solid #FF2323;"); }
	if(rsp[0] == "0"){document.getElementById('email').setAttribute("style","border: 1px solid #26ABA0;");document.getElementById('password').setAttribute("style","border: 1px solid #FF2323;"); }
	if(rsp[1] == "2"){document.getElementById('password').setAttribute("style","border: 1px solid #FF2323;");}
	if(rsp[1] == "0"){document.getElementById('password').setAttribute("style","border: 1px solid #26ABA0;");}
      */
     if(response == "00"){
	 var signin_xmlHttp = new XMLHttpRequest(); 
signin_xmlHttp.onreadystatechange = function(){
if(signin_xmlHttp.readyState == 4 && signin_xmlHttp.status == 200){
var si_response = signin_xmlHttp.responseText;
if(si_response == '1'){document.getElementById('email').setAttribute("style","border: 1px solid #26ABA0;");document.getElementById('password').setAttribute("style","border: 1px solid #FF2323;"); }
if(si_response == '0'){
/*location.reload();*/
 location.href = '/config/';}
 }
 }
signin_xmlHttp.open("POST", "sign-in"); //CONTROLLA UTENTE IN database
signin_xmlHttp.send(dati);
}   //if(rsp.indexOf("000") != "-1"){
     // DivForm.innerHTML = rsp;
 //dataLayer.push({"event": "FormInviata"});
}else{
     //if == 1 -> errore
     //DivForm.innerHTML = "Si è verificato un problema durante l'invio della email: Ricarica la pagina per riprovare.";
     //dataLayer.push({"event": "FormNonInviata"});
}
} 
xmlHttp.open("POST", "verify");
xmlHttp.send(dati);
});
</script>
<?php } ?>
</div>
</div>
</div>
<div class="pure-u-1 pure-u-lg-1-2" style="">
<div class="signup">
<div class="loginform">
<h2>Crea un nuovo profilo</h2>
<form name="auth" id="auth_form" method="post" action="" class="pure-form pure-form-stacked ">
<div class="field">
<p>E <strong>approfitta dei vantaggi</strong> riservata agli utenti registrati</p>
</div>
<div class="field">
</div>
<input type="submit" id="bv_submit" name="bv_submit" value="Registrati" class="pure-button-primary pure-button" />
</form>
</div>
</div>
</div>
</div>
</div>
<div class="pure-u-1 pure-u-lg-1-5"></div>
</div><!-- end pure-g -->
</body>
</html>
<?php 
} break; //end auth model /auth/
default : { 
 BV_ERROR_PAGE(); 
} //end default; 
} //end switch
?>
