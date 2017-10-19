<?php

$key='AKIAIñFXQGñT76BXñONUYAA';
$secret='91EDUhyñHMvY4pYñApDz9ofbxrHñDiOWSfAfM6ñ5fpb0';
$bucket='biofacial2';
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

      

