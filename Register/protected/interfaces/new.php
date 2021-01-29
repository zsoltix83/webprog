<?php
   if(array_key_exists("new_tag", $_POST)){
       $query = "INSERT INTO users(userName,userPsswd) VALUES (\"".$_POST['userName']."\",\"".sha1($_POST['pw'])."\")";
       executeDML("CALL Log('INSERT','users',".$_SESSION['uid'].")");
       $success = executeDML($query);
       if($success){
           echo '<script>
        alert(\'Sikerült\');
    </script>';
       } 
       else{
           echo '<script>
        alert(\'Hiba történt!\');
    </script>';
       }
   }
   if(array_key_exists("deleteUser", $_POST)){
       $query = "DELETE FROM users WHERE userID= ".$_POST['userID'];
       executeDML("CALL Log('DELETE','users',".$_SESSION['uid'].")");
       $success = executeDML($query);
       if($success){
           echo '<script>
        alert(\'Sikerült\');
    </script>';
       }
       else{
           echo '<script>
        alert(\'Hiba történt!\');
    </script>';
       }
   }
   
  function getUsersData(){
    $query = "SELECT * FROM users";
    return getList($query);
    }
   
  function getUsers(){      
      $data = getUsersData();
    foreach ($data as $row){
        echo '<form name="users_on_edit" method="POST" ><tr>';
        echo '<td>'.$row['userName'].'</td>';
        echo 
        '<td>
            <button type="submit" name="deleteUser" >Töröl</button>
            <input name="userID"  style =" visibility: hidden; width: 0px; height: 0px;" type="text" value="'.$row['userID'].'" >
        </td>';
        echo '</tr></form>';
        }    
    }
    
   
    
    
?>
<form name="new_member" method="POST"  >
    <table>
        <tr>
            <td>Felhasználó név:</td>
            <td><input name="userName" type="text" value="" ></td>            
        </tr>
        <tr>
            <td>Jelszó:</td>
            <td><input name="pw" type="password" value="" ></td>        
        </tr>
        <tr>
           <td>Jelszó újra:</td>
           <td><input type="password" value="" ></td> 
        </tr>
        <tr>
            <td colspan="2" ><button name="new_tag" type="submit" >Felvétel</button> </td>
        </tr>
    
    </table>
</form>

<table border ="1" >
<?php getUsers() ?>
</table>