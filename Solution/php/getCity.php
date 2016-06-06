<?php
try{  
 require_once 'select-db.php';  

if ( isset($_POST['id']) && !empty($_POST['id']) ){
	$id = intval($_POST['id']);
	$query = $db->query("SELECT * FROM cities WHERE id_country='$id'");
	
	while($row = $query->fetch() ){
		echo "<option value=".$row->id_city.">".$row->city_name."</option>";
	}
	
}

}catch(PDOException  $e ){
	echo "Ошибка: ".$e;
}

?>
