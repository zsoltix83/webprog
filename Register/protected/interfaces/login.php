<?php
if(array_key_exists('login', $_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(!empty($username) && !empty($password)){
        if(Login($username, $password)){
            header('Location:'.ADMIN_URL.'?F=welcome');
            Welcome($_SESSION['uid']);
        } 
        else{
            echo 'Hibás bejeltkezési adatok!';
        }
    }
    else {
        echo 'Hiányzó adatok!';
    }
}
?>

<form method="POST">
            <label>Felhasználónév:</label><br/>
            <input type="text" name="username"/><br/>
            <label>Jelszó:</label><br/>
            <input type="password" name="password"/><br/>
            <button type="submit" style="margin-top: 5px;" name="login">Bejelentkezés</button>
</form> 