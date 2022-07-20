<?php

$allToken = file_get_contents('database.txt');

if($allToken == 'null' || $allToken == ''){
    $allToken = [];
}else{
    $allToken = json_decode($allToken);
}



function generateToken($allToken, $fullName){

    $userExist = false;
    foreach($allToken as $tok){
        if($tok->fullName== $fullName){
            $userExist = true;
            break;
        }
    }
    if($userExist && (count($allToken) >= 10)){
        array_splice($allToken,0,1);
    }
        $token = md5(rand(100,10000) . $fullName);
        array_push($allToken, array("fullName" => $fullName, "token" => $token));

        $saveFile = fopen("database.txt","w");
        fwrite($saveFile,json_encode($allToken));
        fclose($saveFile);
        
        return $token;
}

echo generateToken($allToken, $_GET['nama']);


