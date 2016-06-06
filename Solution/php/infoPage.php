<?php 
require_once 'select-db.php';  


?>
	
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
   <head>
        <title>AndiGroup</title>
	</head>
   <body>
		<div class="all" style="margin: auto; width:410px; background: #DCDCDC; padding: 7px 7px;  margin-top:3%;">
		
		   <div class="user" style=" display: inline-block; ">
				<p><b>ЮЗЕРЫ:</b></p>	
				<!-- Отображаю логины юзеров на странице -->
				<?php 
				$users = $db->query("SELECT login FROM users");
				$number=1;
				while($rowUser = $users->fetch() ) {	
					foreach($rowUser  as $name => $value){
						echo "$number) $value<br> "; 
						$number++;
					}
				}
				
				?>	
			</div>
			
			<div class="invite" style="border-right: 1px solid black; border-left: 1px solid black; display: inline-block;padding-left:4px; vertical-align:top">
				<p><b>ВСЕ ИНВАЙТЫ:</b></p>	
				<!--Отображаю инвайты на странице-->
				<?php 
				$invite = $db->query("SELECT invite FROM invites");
				$number=1;
				while($rowInvite = $invite->fetch() ) {	
					foreach($rowInvite  as $name => $value){
						echo "$number) $value <br> "; 
						$number++;
					}
				}	
				?>	
			</div>
			<div class="invite" style="display: inline-block; vertical-align:top">
				<p><b>СВОБОДНЫЕ ИНВАЙТЫ:</b></p>	
				<!--Отображаю инвайты на странице-->
				<?php 
				$invite = $db->query("SELECT invite FROM invites WHERE status='0'");
				$number=1;
				while($rowInvite = $invite->fetch() ) {	
					foreach($rowInvite  as $name => $value){
						echo "$number) $value <br> "; 
						$number++;
					}
				}	
				?>	
			</div>
			<br><br><input type="button" value="назад"  onClick="location.href='../index.php'" />
		</div>	
		
  </body>
</html>
