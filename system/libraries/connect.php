<?php
// ---------------- MAIN URL SETTINGS -------------- //
$_POST["PUBLIC_URL"] = "https://samuloop.site";
$_POST["PUBLIC_NAME"] = "SamuLoop site";
$_POST["PUBLIC_ERROR_PAGE"] = "/error";
$_POST["FULL_PUBLIC_ERROR_PAGE"] = "$_POST[PUBLIC_URL]". "/error";
$_POST["PUBLIC_HOST"] = "samuloop.site";
$_POST["LOCALE_PATH"] = "/home/u162968061/domains/samuloop.site/public_html";
$_POST["LANG"] = "it";
$LOCALE_PATH = $_POST["LOCALE_PATH"];
$PUBLIC_URL = $_POST["PUBLIC_URL"];
$PUBLIC_HOST = $_POST["PUBLIC_HOST"];
$LANG = $_POST["LANG"];
// ---------------- MAIN DATABASE SETTINGS -------------- //
$DB1 = "u162968061_samuloop";
$HOST1 = "localhost";
$USER1 = "u162968061_samuloop";
$PASS1 = "Samuloop1*";
//------- PHP DATA OBJECT VERSION ------ //
if(!isset($db1)){try{
    $db1 = new PDO("mysql:host=$HOST1;dbname=$DB1;charset=utf8", "$USER1", "$PASS1", array(PDO::ATTR_PERSISTENT => true));
$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }}
$_POST["DB1"] = $db1;
//------- PHP DATA OBJECT VERSION ------ //
?>
<?php
function BV_ERROR_PAGE(){header("HTTP/1.0 410 Gone"); echo file_get_contents("$_POST[FULL_PUBLIC_ERROR_PAGE]"); }
?>
