<?php
    session_start();
    require_once '../LibraryC/protected/configs/admin_config.php';
    require_once '../LibraryC/protected/core/session.php';
    require_once '../LibraryC/protected/core/database.php';
   
    ?>  
 
<html>
    <head>
        <title>Nyilvántartás</title>
        <meta charset="<?=CHARSET?>"/>
        <link href="../LibraryC/styles.css" type="text/css" rel="stylesheet">
    </head>
    <div id="header" class="l_header">
        <?php require_once MODULES.'header.php';?>
    </div>
    <div id="l_content" class="l_content">
        <?php require_once INTERFACES.'login.php'; ?>
    </div>
    <div id="footer" class="l_footer">
        <?php require_once MODULES.'footer.php';?>
    </div>
</html>