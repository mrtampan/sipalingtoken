<?php




function verifyToken($token, $fullName){
    $allToken = file_get_contents('database.txt');

    if($allToken == 'null' || $allToken == ''){
        $allToken = [];
    }else{
        $allToken = json_decode($allToken);
    }
    
    $userExist = false;
    $indexToken = 0;
    foreach($allToken as $tok){
        if($tok->fullName== $fullName && $tok->token == $token){
            $userExist = true;
            break;
        }
        $indexToken++;
    }
    

    if($userExist){
        array_splice($allToken,$indexToken,1);
        $saveFile = fopen("database.txt","w");
        fwrite($saveFile,json_encode($allToken));
        fclose($saveFile);
        return "true";
    }
    return "false";
}

echo verifyToken($_GET['token'], $_GET['nama']);


