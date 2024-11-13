<?php require_once("$_POST[LOCALE_PATH]/system/libraries/sodium-encryption.php"); ?>
<?php 
function secure_session_start($PUBLIC_HOST) {
$rand = rand(1111111111111111,999999999999999999); 
$name = "bacKVersion-SID";
$value = "$rand";
$secure = true; // Set to true if using https.
$httponly = true; // This stops javascript being able to access the session id.
//ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
//ini_set('session.use_strict_mode', 1); // Forces sessions to only use cookies. 
$opzioni = array (
                'expires' => time() + 60*60*24*30, 
                'path' => '/', 
                'domain' => ".$PUBLIC_HOST", // leading dot for compatibility or use subdomain
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'Lax' // None || Lax  || Strict
                );
setcookie($name, $value, $opzioni); 
session_start();
}
?><?php
$email = trim($_POST["email"]);
$email = strip_tags($email);
$password = $_POST["password"];
$password = strip_tags($password);
$statement1 = $db1 -> query("SELECT * FROM `bv_users` WHERE Email_user = '$email' LIMIT 1");
  $risultato1 = $statement1->fetchAll(PDO::FETCH_ASSOC); 
  $numerorighe1 = $statement1->rowCount();
  if ($numerorighe1 == 0) {
    echo "1"; 
header("Location: " . "/auth"); exit();
}else{
  for ($i1=0;$i1<$numerorighe1;$i1++) {
    $ID_user = $risultato1[$i1]['ID_user']; 
    $Username = $risultato1[$i1]['Username_user'];
    $Email = $risultato1[$i1]['Email_user'];
    $UserAuth = $risultato1[$i1]['UserAuth'];
    $Username = html_entity_decode($Username, ENT_QUOTES,'UTF-8');
    $bvk1_hex = $risultato1[$i1]['BackVersionKey1'];
    $bvk2_hex = $risultato1[$i1]['BackVersionKey2'];
    $testocifrato_hex = $risultato1[$i1]['Password_user'];    
    $Password = decifra($testocifrato_hex,$bvk1_hex,$bvk2_hex);
    $Password = html_entity_decode($Password, ENT_QUOTES,'UTF-8');
    if($password == $Password){
      secure_session_start($PUBLIC_HOST);
      $_SESSION["USER-AUTH"] = $UserAuth;
//$file = 'people.txt'; $current = file_get_contents($file); $current .= $_SESSION["USER-AUTH"]; file_put_contents($file, $current, FILE_APPEND);
      $_SESSION["ACCOUNT"]= $ID_user;
      echo "0";
}
}
}
?>
