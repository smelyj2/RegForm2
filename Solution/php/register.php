<?php 
try{
	require_once 'select-db.php';  
	

	if (isset($_POST['username'])) {
		$login = $_POST['username'];
	}else{
		exit ("Извините, произошла ошибка, попробуйте снова.");
	} 

	if (isset($_POST['userpassword']) && $_POST['userpassword'] == $_POST['userpassword2'] ){
		 $password=$_POST['userpassword'];
		 
	}else{
		exit ("Извините, произошла ошибка, попробуйте снова.");
	} 

	if (isset($_POST['phone'])){
		 $phone=$_POST['phone'];
	}else{
		exit ("Извините, произошла ошибка, попробуйте снова.");
	}

	if (isset($_POST['invite'])){
		 $invite=$_POST['invite'];
	}else{
		exit ("Извините, произошла ошибка, попробуйте снова.");
	} 

	// обрабатываю полученные данные
	$login = stripslashes($login);     // удаляю экранирование символов
    $login = htmlspecialchars($login); //Преобразую специальные символы в HTML-сущности
	$login = trim($login);				//удаляю лишние пробелы	
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$password = trim($password);
	$phone = preg_replace("/[^0-9]/", '', $phone);
	$phone = trim($phone);
	$phone = (string)$phone;
	$invite;
	
	$error = array(); 
	
	// проверяю зарегистрирован ли данный логин уже в базе
	$query = $db->query("SELECT id_user FROM users WHERE login='$login'");
	while($row = $query->fetch() ){
		if (!empty($row->id_user) ){
			$error[] = "Извините, введённый вами логин уже зарегистрирован. Введите другой логин.";
		}
	}
	
	// Проверяю наличие введённого инывайта с инвайтом в БД и если нету такого, сообщаю об этом пользователю
	$dbInvite = $db->query("SELECT invite FROM invites WHERE invite='$invite'"); 
	while($rowInviteBd = $dbInvite->fetch() ){
		if ($invite != $rowInviteBd->invite) { 
			$error[] = "Извините, но данный инвайт отсутствует в базе данных.";
		}
	}
	
		
	// Проверяю статус инвайта в БД
	$queryInvite = $db->query("SELECT status FROM invites WHERE invite='$invite'");
	while($rowInviteStatus = $queryInvite->fetch() ){
		if ($rowInviteStatus->status != 0 ){ // если равен статус 0 ,то зменяю статус в базе и добавляю дату записи 
			$error[] = "Извините, но данный инвайт уже использован и больше не актуален.";
		}
	}
	
	if(count($error) == 0) {	 // если ошибок нет то сохраняем даныне и выводим сообщение об успешной активации
		
		$query2 = $db->query("INSERT INTO users (login,password,phone) VALUES ('$login','$password','$phone')");
		
		$curDate = date("Y-m-d H:i:s");
		$curDate = (string) $curDate;	
		$queryInviteStatus = $db->query("UPDATE invites SET status='1' WHERE invite='$invite'");
		$queryInviteDate = $db->query("UPDATE invites SET date_status_='$curDate' WHERE invite='$invite'");

			
		session_start(); 
		$_SESSION['reg'] = 'success'; //передаю переменную на главную страницу для вывода сообщения об успешной рег-ции
		header("Location: ../index.php"); 
		exit();
	}else{
		
		print "<b>При регистрации произошли следующие ошибки:</b><br><br>";
        foreach($error AS $er){
            echo $er."<br>";
        }
	}
}catch(PDOException  $e ){
	echo "Ошибка: ".$e;
	exit();
}
		
?>	
	
	
	
	
	
	

