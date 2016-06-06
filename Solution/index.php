<?php  
 require_once 'php/select-db.php';  //Подключение к БД
?>
	
<!DOCTYPE html>
<html>
	

<meta charset="UTF-8">
   <head>
        <title>AndiGroup</title>
		
		<link rel="stylesheet" href="css/style.css"></link>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="js/validate/jquery.validate.min.js"></script>
		<script src="js/script.js"></script>
	
   </head>

   <body>
		
		<div class="all">
		<div class="reg-frame" >
			<div class="frame__header" >
			  	<div class="icon"></div>
				<span >Form1</span>
			  	<div class="wrapper-buttons">
					<ul class="head-buttons">
						<li class="turn-li">  
							<button><img src="images/1.png" > </button>
						</li>
						<li class="expand-li">
							<button><img src="images/2.png" > </button>
						</li>
						<li class="close-li">
							<button><img src="images/3.png" > </button>
						</li>
					</ul>
				</div>
			</div>
			<div class="frame__content">
				<form id="log_form" name="log_form" action="php/register.php" method="POST">
					<h1 class="h">Регистрация</h1>
					<fieldset class="my_field" >
						<ul class="ul-form-content">
							<li >
								<label for="username">Логин</label>
								<input type="text" name="username" class="username" id="username" placeholder="Логин" >
								<span class="red-star">*</span>
							</li>
							<li >
								<label for="userpassword">Пароль</label>
								<input type="password" name="userpassword" class="userpassword" id="userpassword" placeholder="Пароль" >
								<span class="red-star">*</span>
								<span class="info-pass"></span>
							</li >
							<li>
								<label for="userpassword2">Ещё раз пароль</label>
								<input type="password" name="userpassword2" id="userpassword2" placeholder="Пароль" >
							</li>
							<li>
								<label for="phone">Телефон</label>
								<input type="text" name="phone" id="phone" class="phone" placeholder="Телефон" >
								<span class="red-star">*</span>
								
							</li>
							<li>
								<label for="country">Страна</label>
								<select size='1'  name="country" class="mycountry" onMousedown="deleteSpace(this);"> 
									<option value="toogle"></option>
									<?php
										$query = $db->query("SELECT * FROM cоuntries"); /*Подгружаю из БД данные стран в select*/
										while($row = $query->fetch()){
										echo "<option value=".$row->id_country.">".$row->country_name."</option>";
										}
									?>
								</select>
							</li>
							<li>
								<label for="city">Город</label>
								<select size='1'  name="city" class="mycity">
									
								</select>
							</li>
							<li>
								<label for="invite">Инвайт</label>
								<input type="text" name="invite" id="invite" class="invite"  placeholder="Инвайт" >
								<span class="red-star">*</span>
								
							</li>
						</ul>	
					</fieldset>
					<fieldset class="my_field-buttons">
						<input type="submit" id="confirm-form" value="Регистрация" />
						<input type="button" value="Очистить" onClick="dataReset(); return false;" />
					</fieldset>
					<input type="button" value="Инфо"  onClick="location.href='php/infoPage.php'" />
				</form>
			</div>
		</div>
		</div>
	<?php
		// вывод сообщения об успешной регистрации
		session_start();
		if(!empty($_SESSION['reg'])){
			echo "<script type='text/javascript'> alert('Ругистрация прошла успешно!')</script>";
			unset($_SESSION['reg']);
		}
	?>
  </body>
</html>
