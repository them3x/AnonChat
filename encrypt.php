<?php


function Encrypt_Str($str){
    $plaintext = $str;
    $key="defaultpass123";
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = substr(md5(md5(date('Ymd'))),0,16);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
    $ciphertext=str_replace('+','-',$ciphertext);
    return $ciphertext;
}

function Decrypt_str($str){
    // so decripta o que encriptado no dia
    $key="defaultpass123";
    $str=str_replace('-','+',$str);
    $c = base64_decode($str);
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = substr(md5(md5(date('Ymd'))),0,16);
    $hmac = substr($c, $ivlen, $sha2len=32);
    $ciphertext_raw = substr($c, $ivlen+$sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    //PHP 5.6+ timing attack safe comparison
    if (hash_equals($hmac, $calcmac)){
        return $original_plaintext;
    }
}

?>
