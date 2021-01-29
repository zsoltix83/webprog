<?php

function getConnection(){
    $connection = new PDO(
            DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,
            DB_USER,
            DB_PASS
            );   
    $connection->exec("SET NAMES'".DB_CHAR."'");            
    return $connection;
     
}

function getRecord($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    
    $result = [];
    
    $success = $statement->execute($params);
    if($success){
        $result = $statement->fetch();
    }    
    $statement->closeCursor();   
    $connection = null;    
    return $result;    
}

function getList($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    
    $result = [];
    
    $success = $statement->execute($params);
    if($success){
        $result = $statement->fetchAll();
    }    
    $statement->closeCursor();   
    $connection = null;    
    return $result;    
}

function getField($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    
    $result = [];
    $success = $statement->execute($params);
    if($success){
        $result = $statement->fetch()[0];
    }
    
    $statement->closeCursor();
    $connection = null;
    
    return $result;
}

function executeDML($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);
    $statement->closeCursor();
    $connection = null;
    
    return $success;
}