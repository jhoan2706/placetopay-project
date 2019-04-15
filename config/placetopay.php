<?php

/* $seed = date('c');
if (function_exists('random_bytes')) {
    $nonce = bin2hex(random_bytes(16));
} elseif (function_exists('openssl_random_pseudo_bytes')) {
    $nonce = bin2hex(openssl_random_pseudo_bytes(16));
} else {
    $nonce = mt_rand();
}
$login=env('PLACETOPAY_IDENTIFIER');
$nonceBase64 = base64_encode($nonce);
$key=env('PLACETOPAY_TRANSKEY');
$transKey=base64_encode(sha1($nonce . $seed . $key, true)); */

return [
    'auth'=>[
        'login' => env('PLACETOPAY_IDENTIFIER'),
        'tranKey' => env('PLACETOPAY_TRANSKEY'),
        'url'=>'https://test.placetopay.com/redirection'
    ]
];
