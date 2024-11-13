<?php
function cifra($testo){
$chiavi = array();
$key = sodium_crypto_aead_xchacha20poly1305_ietf_keygen(); //bvk1
$nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES); //bvk2
$testocifrato = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($testo, '', $nonce, $key);
// Store hexadecimal versions of binary output
$nonce_hex = bin2hex($nonce);
$key_hex = bin2hex($key);
$testocifrato_hex = bin2hex($testocifrato);
$chiavi[0] = $testocifrato_hex;
$chiavi[1] = $key_hex;
$chiavi[2] = $nonce_hex;
return $chiavi;
}
function decifra($testocifrato_hex, $bvk1_hex, $bvk2_hex){
$testocifrato = hex2bin($testocifrato_hex); 
$bvk1 = hex2bin($bvk1_hex);
$bvk2 = hex2bin($bvk2_hex);
$testocifrato = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($testocifrato, '', $bvk2, $bvk1);
return $testocifrato;
}
?>
