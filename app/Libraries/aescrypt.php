<?php

namespace App\Libraries;

class aescrypt {

	private function ppkey($key){
        if (strlen($key) > 32) {
            $key = substr($key, 0, 32);
        } elseif (strlen($key) > 24) {
            $key = substr($key, 0, 24);
        } elseif (strlen($key) > 16) {
            $key = substr($key, 0, 16);
        }
        return $key;
    }
    public function Encrypt($data, $key){
        $key = $this->ppkey($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }
    
    public function Decrypt($data, $key){ 
        $key = $this->ppkey($key);
        $data = base64_decode($data);
        $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $decrypted = openssl_decrypt(substr($data, openssl_cipher_iv_length('aes-256-cbc')), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return rtrim($decrypted, "\0");
    }

}
