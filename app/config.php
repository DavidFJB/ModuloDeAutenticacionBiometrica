<?php

$key='GJAFHDSAIDJAJDJFADHFADJF';
$secret='RKROFLAKSJSIDdFKDKFIDJFDJFDIDKAMD';
$bucket='biofacial';
$region='us-west-2';
return[
    "s3"=>[
        'key' => $key,
        'secret' => $secret,
        'region' => $region,
        'bucket'=>  $bucket,
        'version' => 'latest',
        'http'    => ['decode_content' => false],
        'scheme' => 'http'
        ]
    ];

      

