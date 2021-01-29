<?php
    $query = "SELECT name,age FROM irldatas WHERE userID = :userID";
    $params = [':userID' => $_SESSION['uid']];
    
    $data = getRecord($query,$params); 
    
    $query_2 = "SELECT count(*) FROM CARS WHERE owner = :userID";
    $data_2 = getRecord($query_2, $params);
    $query_3 = "SELECT count(*) FROM MOTORCYCLES WHERE owner = :userID";
    $data_3 = getRecord($query_3, $params);
    $query_4 = "SELECT count(*) FROM HOUSES WHERE owner = :userID";
    $data_4 = getRecord($query_4, $params);
?>
 

<?php if(!empty($_SESSION['uid'])):?>
<h3>Személyes adatok:</h3>
<table border="1">
    <tr>
        <td>
           Név:
        </td>
        <td>
           <?php echo $data['name']?>
        </td>
    </tr>
    <tr>
        <td>
            Kor:            
        </td>
        <td>
             <?php echo $data['age']?>
        </td>
    </tr>
    <tr>
        <td>
            Autóval rendelkezik:            
        </td>
        <td>
             <?php 
             if($data_2['count(*)'] != 0){
             echo $data_2['count(*)'];                    
             }
             else{
                 echo 'Nem rendelkezik autóval.';
             }
              ?>
        </td>
    </tr>
    <tr>
        <td>
            Motorral rendelkezik:           
        </td>
        <td>
             <?php if($data_3['count(*)'] != 0){
             echo $data_3['count(*)'];
             }else{
                 echo 'Nem rendelkezik motorral.';
             }
             ?>
        </td>
    </tr>
    <tr>
        <td>
            Házzal rendelkezik:           
        </td>
        <td>
             <?php if($data_4['count(*)'] != 0){
             echo $data_4['count(*)'];
             }else{
                 echo 'Nem rendelkezik házzal.';
             }
             ?>
        </td>
    </tr>
</table>
<?php else:?>
    Nincs megjeleníthető adat!
<?php endif?>


