<?php

require_once __DIR__ . '\../../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
$mpdf = new \Mpdf\Mpdf();
date_default_timezone_set('America/New_York');

    $factory = (new Factory)->withServiceAccount(__DIR__ . '\../../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $user = $factory->createAuth()->getUserByEmail("hshah6841@live.hccc.edu")->uid;
    $user_name = $factory->createAuth()->getUserByEmail("hshah6841@live.hccc.edu")->displayName;
    $Data = $factory->createDatabase()->getReference('Users/' . $user . '/Questions')->getValue();
    $data = [];
    $X = [];

    $raw =[];
    foreach ($Data as $key => $value){
        $k = preg_replace("/[^0-9\.]/", '', $key);
        $raw += [ $k => $k ];

    }

    for($c = 1; $c < 27; $c++){
        if( isset($raw["$c"])){
            $X += ["$raw[$c]" => 'yes'];
        }
        else{
            $X += ["$c" => ' '];
        }
    }

