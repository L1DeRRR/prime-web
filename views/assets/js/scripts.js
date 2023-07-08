$(document).ready(function(){ 

	/****************************************************************************************
	********************************** Support Messages *************************************
	****************************************************************************************/

	$('*').hover(function(){
		// Событие при навидении курсора
		if($(this).attr('data-desc'))
		{	
			var showableSize = -1;
			
			if($(this).attr('data-desc-size'))
			{
				var showableSize = parseInt($(this).attr('data-desc-size'));
			}

			if(showableSize == -1 || $(window).outerWidth() <= showableSize){
				var elem_position = $(this).offset();

				var elem_width = $(this).outerWidth();
				var elem_height = $(this).outerHeight();
				var elem_x = elem_position['left'];
				var elem_y = elem_position['top'];

				$('body').append('<div class="hint_msg">' + $(this).attr('data-desc') + '</div>');

				var msg_position = $('.hint_msg').offset();
				var msg_width = $('.hint_msg').outerWidth();
				var msg_height = $('.hint_msg').outerHeight();

				// Позиционируем подсказку по Y (учитываем камки окна браузера)
				if(elem_y < (msg_height + 10)){
					$('.hint_msg').css('top', (elem_y + elem_height + 8) + 'px');
				}
				else{
					$('.hint_msg').css('top', (elem_y - msg_height - 8) + 'px');
				}

				// Позиционируем подсказку по X (учитываем камки окна браузера)
				if(5 > ((elem_x + elem_width / 2) - msg_width / 2)){
					$('.hint_msg').css('left', elem_x + 'px');
				}
				else if( ($(window).width() - 5) < ((elem_x + elem_width / 2) + msg_width / 2)){
					$('.hint_msg').css('left', ((elem_x + elem_width) - msg_width) + 'px');
				}
				else{
					$('.hint_msg').css('left', ((elem_x + (elem_width / 2)) - msg_width / 2) + 'px');
				}
			}
			
			
		}
	},function(){
		// Событие при покидании курсора
		if($(this).attr('data-desc')){
			$('.hint_msg').remove();
		}
		
	});
	
	/****************************************************************************************
	************************************* Scripts *******************************************
	****************************************************************************************/

	function updateAllDateTimes() {
		const currentDate = new Date();
		const options = {hour: 'numeric', minute: 'numeric'};
		const currentDateTime = currentDate.toLocaleString('ru-RU', options);

		// Обновление всех элементов с классом "dateTime"
		$(".dateTime").each(function () {
			$(this).text(currentDateTime);
		});
	}

// Вызов функции обновления
	updateAllDateTimes();










	const dates = document.querySelectorAll('.dates');
	dates.forEach(dataMay => {
		datas = dataMay.innerHTML;
		var date = new Date(datas);
		var daysOfWeek = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
		var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var dayOfWeekText = daysOfWeek[date.getDay()];
		var monthText = months[date.getMonth()];
		var dayOfMonth = date.getDate();
		var year = date.getFullYear();
		var dateString = dayOfWeekText + ', ' + dayOfMonth + ' ' + monthText;
		dataMay.innerHTML = dateString;

	});
});

