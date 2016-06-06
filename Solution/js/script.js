function validateFormElements(){										//Валидация формы
	
		$.validator.addMethod("username", function(value, element) {
			return /^[а-яА-ЯёЁa-zA-Z0-9]+$/i.test(value);
		},
			'<div style="visability: true;"  class="info">Только буквы и цифры.</div>')
	
		$.validator.addMethod("userpassword", function(value, element) {
			return /^[а-яА-ЯёЁa-zA-Z0-9]+$/i.test(value);
		},
			'<div style="visability: true;"  class="info1">Только буквы и цифры.</div>')
			
		$.validator.addMethod("phone", function(value, element) {
			
			return /^(?:\+[0-9]{2}\s)?(?:\([0-9]{3}\)|[0-9]{3})\s[0-9]{3}(-|\s)[0-9]{2}\1[0-9]{2}/i.test(value);
		},
			'<div style="visability: true;"  class="info2">Не верный формат ввода.Допускается: +**(***)***-**-**, *** *** ** **, (***) *** ** ** </div>')
			
		$.validator.addMethod("invite", function(value, element) {
			
			return /^[0-9]/i.test(value);
		},
			'<div style="visability: true;"  class="info3">Только цифры</div>')	

	
    $("#log_form").validate({											//Валидация формы 
			validClass: "success",
       rules:{
		
            username :{
                required: true,
                minlength: 5,
                maxlength: 20,
            },
			userpassword :{
                required: true,
                minlength: 5,
                maxlength: 20,
            },
			phone :{
				required: true,
                minlength: 13,
                maxlength: 19,
            },
			invite :{
				required: true,
                minlength: 6,
                maxlength: 6,
            },
            
       },

       messages:{														

            username :{
                required: '<div style="visability: true;" class="info">Это поле обязательно.</div>',
                minlength: '<div style="visability: true;" class="info">Минимум 5 символов.</div>',
                maxlength: '<div style="visability: true;" class="info">Максимум 20символов.</div>',
				
			},
			userpassword :{
                required: '<div style="visability: true;" class="info1">Это поле обязательно.</div>',
                minlength: '<div style="visability: true;" class="info1">Минимум 5 символов.</div>',
                maxlength: '<div style="visability: true;" class="info1">Максимум 20символов.</div>',
				
			},
			phone :{
				required: '<div style="visability: true;" class="info2">Это поле обязательно.</div>',
                minlength: '<div style="visability: true;" class="info2">Минимум 10 цифр.</div>',
                maxlength: '<div style="visability: true;" class="info2">Максимум 15 цифр.</div>',
				
			},
			invite :{
				required: '<div style="visability: true;" class="info3">Это поле обязательно.</div>',
                minlength: '<div style="visability: true;" class="info3">Только 6 цифр.</div>',
                maxlength: '<div style="visability: true;" class="info3">Только 6 цифр.</div>',
				
			},
       }
		   

    });
	
}


function passwordsMatch(){													// Проверяю совпадают ли пароли
	$('#userpassword, #userpassword2').on('keyup', function () {
			if ($('#userpassword').val() == $('#userpassword2').val()) {
				$('.info-pass').css('display', 'none'); 
				
			} 
			else {$('.info-pass').html('Пароли не совпадают').css('color', 'red').css('display', ''); 
			}
		});
}


function confirmAlert(){													// Вывод сообщения об успешной отправки данных
$('#confirm-form1').click(function () {
	if( ($("#log_form").valid()) ){
        alert('спасибо что зарегался ');
        } else {
			alert('а ты не зарегался ')
        }      
    });	
}


function dataReset(){														// функция обнуления данных во всех полях

var inputs = $('.my_field').find('input');
var inputsNumber = inputs.length;

	for (var i=0; i < inputsNumber; i++){
		inputs.val('');
	}

$('body').find('.info').css('visibility','hidden');	
$('body').find('.info1').css('visibility','hidden');	
$('body').find('.info-pass').css('display','none');	
$('body').find('.info2').css('visibility','hidden');
$('body').find('.info3').css('visibility','hidden');	


$('.mycountry :first-child').before("<option value='toogle'> </option>")	// обнуляю список стран
$('.mycountry :first-child').attr("selected", "selected");



$('.mycity').html("<option value='0' selected></option>");	 // обнуляю список городов
$(".mycity").empty();
}

$(function(){	// подгружаю города на основе стран
											
	$('.mycountry').click(function(){
		var id = $('.mycountry').val();
		$.ajax({															
			type: "POST",
			url: "php/getCity.php",  // скрипт который возвращает из БД города
			data: {id: id},
			success: function(data){
				$('.mycity').html(data);
			},
			error:  function(xhr, str){
			alert('Возникла ошибка: ' + xhr.responseCode);
			  }
			
		});
	
	}); 
	
});	

function deleteSpace(e){ // удаляю пробел  при первом нажатии на Select. Используется при требовании "По умолчанию поле страны пустое".

	//$('.mycountry :first-child').remove(); // удаление пробела
	//e.onmousedown = null; // обнуляем событие что б не поудаляло все города в списке
	if($('.mycountry :first-child').val() == 'toogle'){
		$('.mycountry :first-child').remove(); 
	}
}



$(document).ready(function(){
	
	validateFormElements();	
	passwordsMatch();
	confirmAlert();
 	
		
});

