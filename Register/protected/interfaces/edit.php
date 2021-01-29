<?php
if(array_key_exists('updateMy', $_POST)){
    $query = "UPDATE irldatas SET name = \"".$_POST['name']."\" ,age= \"".$_POST['age']."\" ,address=\"".$_POST['address']."\" WHERE userID = ".$_SESSION['uid'];
    executeDML("CALL Log('UPDATE','irldatas',".$_SESSION['uid'].")");
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

if(array_key_exists('new_house_add', $_POST)){
    $query = "INSERT INTO houses(size,owner) VALUES('".$_POST['new_house_size']."','".$_SESSION['uid']."')";
    executeDML("CALL Log('INSERT','houses',".$_SESSION['uid'].")");
    $success= executeDML($query);
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
if(array_key_exists('updateHouse', $_POST)){
    $query = "UPDATE houses SET size = ".$_POST['size']." WHERE idHouse=".$_POST['id_house'];
    executeDML("CALL Log('UPDATE','houses',".$_SESSION['uid'].")");
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
if(array_key_exists('deleteHouse', $_POST)){
    $query = "DELETE FROM houses WHERE idHouse =".$_POST['id_house'];
    executeDML("CALL Log('DELETE','houses',".$_SESSION['uid'].")");
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

if(array_key_exists('new_car_add', $_POST)){
    $query = "INSERT INTO cars (idCars,color,brand,owner) "
            . "VALUES('".$_POST['idCar']."','".$_POST['color']."','".$_POST['brand']."','".$_SESSION['uid']."')";    
    executeDML("CALL Log('INSERT','cars',".$_SESSION['uid'].")");
    $success= executeDML($query);
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
if(array_key_exists('updateCar', $_POST)){
    $query = "UPDATE cars SET idCars = \"".$_POST['idCar']."\", color =\"".$_POST['color']."\", brand=\"".$_POST['brand']."\" WHERE idCars=\"".$_POST['id_Car']."\"";
    executeDML("CALL Log('UPDATE','cars',".$_SESSION['uid'].")");
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
if(array_key_exists('deleteCar', $_POST)){
    $query = "DELETE FROM cars WHERE idCars =\"".$_POST['id_Car']."\"";
    executeDML("CALL Log('DELETE','cars',".$_SESSION['uid'].")");
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

if(array_key_exists('new_bike_add', $_POST)){
    $query = "INSERT INTO motorcycles(idMotorC,color,type,brand,owner) "
            . "VALUES('".$_POST['idBike']."','".$_POST['color']."','".$_POST['type']."','".$_POST['brand']."','".$_SESSION['uid']."')";    
    executeDML("CALL Log('INSERT','motorcycles',".$_SESSION['uid'].")");
    $success= executeDML($query);
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
if(array_key_exists('updateBike', $_POST)){
    $query = "UPDATE motorcycles SET idMotorC = \"".$_POST['idBike']."\" ,color =\"".$_POST['color']."\" , type=\"".$_POST['type']."\" , brand=\"".$_POST['brand']."\" WHERE idMotorC=\"".$_POST['id_Bike']."\"";
    executeDML("CALL Log('UPDATE','motorcycles',".$_SESSION['uid'].")");
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
if(array_key_exists('deleteBike', $_POST)){
    $query = "DELETE FROM motorcycles WHERE idMotorC =\"".$_POST['id_Bike']."\"";
    executeDML("CALL Log('DELETE','motorcycles',".$_SESSION['uid'].")");
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

function getDatas($table){
    $query = "SELECT * FROM ".$table." WHERE owner = :uid";
    $params = [':uid'=>$_SESSION['uid']];
    return getList($query, $params);
}
function getMyDatas($table){
    $query = "SELECT * FROM ".$table." WHERE userID = :uid";
    $params = [':uid'=>$_SESSION['uid']];
    return getList($query, $params);
}
function My_data(){
    $data_1 = getMyDatas('irldatas');
    if(!empty($data_1)){
        $c = 'c_m_';
        $sz = 1;
        $a_sz = 1;
    foreach ($data_1 as $row){
        echo '<form name="my_on_edit" method="POST" ><tr>';
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="name" value="'.$row['name'].'"></td>'; $a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="age" value="'.$row['age'].'"></td>'; $a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="address" value="'.$row['address'].'"></td>';
        echo 
        '<td>
            <button type="submit" name="updateMy" >Módosít</button>
            <input   style =" visibility: hidden; width: 0px; height: 0px;" type="text" >
        </td>';
        echo '</tr></form>';$sz++;$a_sz = 1;
        }    
    }
    else{
       echo '<tr><td>Nincs megjeleníthető adat!</tr></tr>';
    }
}
function Car_data(){
    $data_2 = getDatas('cars');
    if(!empty($data_2)){
        $c = 'c_c_';
        $sz = 1;
        $a_sz = 1;
    foreach ($data_2 as $row){
        echo '<form name="cars_on_edit" method="POST" ><tr>';
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="idCar" value="'.$row['idCars'].'"></td>';$a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="brand" value="'.$row['brand'].'"></td>';$a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="color" value="'.$row['color'].'"></td>';
        echo 
        '<td>
            <button type="submit" name="updateCar" >Módosít</button>
            <button type="submit" name="deleteCar" >Törlés</button>
            <input name="id_Car"  style =" visibility: hidden; width: 1px; height: 1px;" type="text" value="'.$row['idCars'].'">
        </td>';
        echo '</tr></form>';$sz++;$a_sz = 1;
        }
    }
    else{
        echo '<tr><td>Nincs megjeleníthető adat!</tr></tr>';
    }
}
function Bike_data(){
    $data_3 = getDatas('motorcycles');
    if(!empty($data_3)){
        $c = 'c_b_';
        $sz = 1;
        $a_sz = 1;
    foreach ($data_3 as $row){
        echo '<form name="edit_on_bike" method="POST" ><tr>';
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="idBike" value="'.$row['idMotorC'].'"></td>';$a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="color" value="'.$row['color'].'"></td>';$a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="brand" value="'.$row['brand'].'"></td>';$a_sz++;
        echo '<td id = "'.$c.$sz."_".$a_sz.'"><input name="type" value="'.$row['type'].'"></td>';
        echo 
        '<td>
            <button type="submit" name="updateBike" >Módosít</button>
            <button type="submit" name="deleteBike" >Törlés</button>
            <input name="id_Bike"  style =" visibility: hidden; width: 1px; height: 1px;" type="text" value="'.$row['idMotorC'].'">
        </td>';
        echo '</tr></form>';$sz++;$a_sz = 1;
        }
    }
    else{
        echo '<tr><td>Nincs megjeleníthető adat!</tr></tr>';
    }
}
function House_data(){
    $data_4 = getDatas('houses');
    if(!empty($data_4)){
        $c = 'c_h_';
        $sz = 1;
        $a_sz = 1;
    foreach ($data_4 as $row){
        echo '<form name="edit_on_house"  method="POST"><tr>';
        echo '<td id = "'.$c.$sz."_".$a_sz.'" ><input name="size" value="'.$row['size'].'"></td>';
        echo 
        '<td>            
            <button type="submit" name="deleteHouse" >Törlés</button>
            <button type="submit" name="updateHouse" >Módosít</button>
            <input name="id_house"  style =" visibility: hidden; width: 1px; height: 1px;" type="text" value="'.$row['idHouse'].'">            
        </td>';
        echo '</tr></form>';$sz++;$a_sz = 1;
        }
    }
    else{
        echo '<tr><td>Nincs megjeleníthető adat!</tr></tr>';
    }
}
?>
<div style="overflow-y: scroll; width: 100%; height: 100%;">
    Személyes adataim:<br>
    <div id="my_div" ><table id="t_my" border="1">  
        <?php My_data(); ?>
        </table>        
    </div>
    Autóim módosítása:<br>
    <div id="car_div">
        <table id="t_car" border="1">
            <?php Car_data(); ?>
        </table>
        <p><font style="font-size: 22px;">Új autó hozzáadása:</font><p>
            <form name="new_f_c" method="POST" >
            Rendszám: <input name="idCar" id="id_new_car" onclick="empty_t('id_new_car')" name="new_car_id" type="text" value="Új autó rendszáma..">
            Szín: <input name="color" id="color_new_car" onclick="empty_t('color_new_car')" name="new_car_color" type="text" value="Új autó színe..">    
            Márka: <input name="brand" id="brand_new_car" onclick="empty_t('brand_new_car')" name="new_car_brand" type="text" value="Új autó márkája..">
            <button type="submit" name="new_car_add" >Hozzáad</button>
            </form>
    </div>
    Motorjaim:<br>
    <div id="bike_div"><table id="t_bike" border="1">
        <?php Bike_data(); ?>
        </table>
        <p><font style="font-size: 22px;">Új motor hozzáadása:</font><p>
            <form name="new_f_b" method="POST" >
            Rendszám: <input name="idBike" id="id_new_bike" onclick="empty_t('id_new_bike')" type="text" value="Új motor rendszáma..">
            Szín: <input name="color" id="color_new_bike" onclick="empty_t('color_new_bike')" type="text" value="Új motor színe..">
            Típus: <input name="type" id="type_new_bike" onclick="empty_t('type_new_bike')" type="text" value="Új motor típusa..">
            Márka: <input name="brand" id="brand_new_bike" onclick="empty_t('brand_new_bike')" type="text" value="Új motor márkája..">
            <button type="submit" name="new_bike_add" >Hozzáad</button>
            </form>
    </div>
    Házaim:<br>
    <div id="house_div">
        <table id="t_house" border="1">
            <?php House_data();?>
        </table>
        <p><font style="font-size: 22px;">Új ház hozzáadása:</font><p>
        <form name="new_f_h" method="POST" >
            Méret: <input id="size_new_house" name="new_house_size" type="text" onclick="empty_t('size_new_house')" value="Új ház mérete..">
        <button type="submit" name="new_house_add" >Hozzáad</button>
        </form>
    </div>
</div>

<script>
    function empty_t(id){
        document.getElementById(id).value="";
    }
    
    function suc(){
            alert("Sikerült!");
    }
</script>