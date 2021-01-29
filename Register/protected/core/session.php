<?php
function IsUserLoggedIn(){
    return  array_key_exists('uid', $_SESSION) &&
            is_numeric($_SESSION['uid']);
}
 

function Login($username, $password){
    $password = sha1($password);
          
    $query = "SELECT * FROM users WHERE userName = :username AND userPsswd = :password";
    $params = [':username' => $username, ':password' => $password];
   
    $userRecord = getRecord($query,$params);
    
    if(!empty($userRecord)){
        $_SESSION['uid'] = $userRecord['userID'];
        $_SESSION['uname'] = $userRecord['userName'];
        return true;
    }
    return false;
}

    

    


