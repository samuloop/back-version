<?php
/* Installatore di back version */
require_once("system/libraries/connect.php");
require_once("system/libraries/sodium-encryption.php");
$sqlDelete = "DROP TABLE IF EXISTS `bv_models`"; 
$db1->exec($sqlDelete);
$sqlCreate = "CREATE TABLE `bv_models`(
`ID_model` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`GROUP_model` INT(5) NULL,
`RIF_module` INT(11) NULL,
`Name_model` TEXT NULL,
`BaseUrl_model` TEXT NULL,
`Directory_model` TEXT NULL,
`Disabled_model` INT(1) NULL
);";
$db1->exec($sqlCreate);
?><?php
$sqlDelete = "DROP TABLE IF EXISTS `bv_nodes`"; 
$db1->exec($sqlDelete);
$sqlCreate = "CREATE TABLE `bv_nodes`(
`ID_node` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`RIF_module` INT(11) NULL,
`RIF_model` INT(11) NULL,
`NodeUrl` TEXT NULL,
`RIF_leftNode` INT(11) NULL,
`GROUP_node` INT(5) NULL,
`LEVEL_node` TEXT NULL,
`Disabled_node` INT(1) NULL
);";
$db1->exec($sqlCreate);
$sqlDelete = "DROP TABLE IF EXISTS `bv_users`"; 
$db1->exec($sqlDelete);
$sqlCreate = "CREATE TABLE `bv_users`(
`ID_user` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`BackVersionKey1` TEXT NOT NULL,
`BackVersionKey2` TEXT NOT NULL,
`Username_user` TEXT NOT NULL,
`Password_user` TEXT NULL,
`Email_user` TEXT NULL,
`UserAuth` TEXT NULL
);";
$db1->exec($sqlCreate);
?><?php
//backend model = config
$insert_it = $db1->prepare("INSERT INTO `bv_models` (GROUP_model,Name_model,BaseUrl_model,Directory_model) VALUES (?,?,?,?)");
$insert_it->execute(array("1","Config","config/","config"));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (NodeUrl) VALUES (?)");
$insert_it->execute(array("config/"));
//istituzionale
$insert_it = $db1->prepare("INSERT INTO `bv_models` (GROUP_model,Name_model,BaseUrl_model,Directory_model) VALUES (?,?,?,?)");
$insert_it->execute(array(NULL,"Istituzionale","/","istituzionale"));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl) VALUES (?,?)");
$insert_it->execute(array(2,"/"));
$insert_it->execute(array(2,"error"));
//auth model
$insert_it = $db1->prepare("INSERT INTO `bv_models` (GROUP_model,Name_model,BaseUrl_model,Directory_model) VALUES (?,?,?,?)");
$insert_it->execute(array(NULL,"Auth","auth/","auth"));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl) VALUES (?,?)");
$insert_it->execute(array(3,"auth/"));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl,RIF_leftNode) VALUES (?,?,?)");
$insert_it->execute(array(3,"verify",3));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl,RIF_leftNode) VALUES (?,?,?)");
$insert_it->execute(array(3,"sign-up",3));
$insert_it->execute(array(3,"sign-in",3));
$insert_it->execute(array(3,"sign-out",3));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl,RIF_leftNode) VALUES (?,?,?)");
$insert_it->execute(array(3,"password-recovery",3));
//pelo
$insert_it = $db1->prepare("INSERT INTO `bv_models` (GROUP_model,Name_model,BaseUrl_model,Directory_model) VALUES (?,?,?,?)");
$insert_it->execute(array("4000","Pelo - Gestionale per veterinari","pelo/","pelo"));
$insert_it = $db1->prepare("INSERT INTO `bv_nodes` (RIF_model,NodeUrl) VALUES (?,?)");
$insert_it->execute(array(4,"pelo/"));

//bv_user
function uniqidReal($lenght = 64) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}
$insert_it = $db1->prepare("INSERT INTO `bv_users` (BackVersionKey1,BackVersionKey2,Username_user,Password_user,Email_user,UserAuth) VALUES (?,?,?,?,?,?)");
//$bvKey = uniqidReal();
$pwd = "Password1*";
$mail = "admin@tld.com";
$chiavi = cifra($pwd); //cifrata 
$testocifrato_hex = $chiavi[0];
$bvk1_hex = $chiavi[1]; //key
$bvk2_hex = $chiavi[2]; //nonce
$insert_it->execute(array("$bvk1_hex","$bvk2_hex","admin","$testocifrato_hex","$mail","1:10;4000;"));
$statement2 = $db1 -> query("SELECT * FROM `bv_users`");
$risultato2 = $statement2->fetchAll(PDO::FETCH_ASSOC); 
$numerorighe2 = $statement2->rowCount(); 
if ($numerorighe2 == 0) {
  echo "1"; exit;
 }else{
  for ($i2=0;$i2<$numerorighe2;$i2++) {
    $ID_user = $risultato2[$i2]['ID_user']; 
    $bvk1_hex = $risultato2[$i2]['BackVersionKey1'];
    $bvk2_hex = $risultato2[$i2]['BackVersionKey2'];
    $testocifrato_hex = $risultato2[$i2]['Password_user'];    
    $pwd = decifra($testocifrato_hex,$bvk1_hex,$bvk2_hex);
}
}
echo "ok";
?>
