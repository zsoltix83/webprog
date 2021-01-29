<?php
if(array_key_exists('F', $_GET) && !empty($_GET['F'])){
    $function = $_GET['F'];    
}
switch($function){
    case 'welcome': require_once __DIR__.'/welcome.php'; break;
    case 'edit': require_once __DIR__.'/edit.php'; break;
    case 'new': require_once __DIR__.'/new.php'; break;
    case 'logout': 
        session_destroy();
        header('Location: http://localhost/LibraryC/');
        break; 
    default : echo 'A keresett funkció nem található!'; break;
}
