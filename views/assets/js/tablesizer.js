$(document).ready(function(){ 
	
	/****************************************************************************************
	************************************* Table Sizer ***************************************
	****************************************************************************************/
	
	$('table').each(function(index, element) {
		
		let content = '<div class="table flex-ss">';
		let titles = [];
		
		$(element).find('tbody').find('tr').each(function(index, element) {
			
			content += '<div class="table__tr flex-ss">';
				
				if(index == 0){
					$(element).find('td').each(function(index, element) {
						titles.push($(element).text());
					});
				}

				$(element).find('td').each(function(index, element) {
					
					content += '<div class="table__td" style="' + $(element).attr('style') + '" data-title="' + titles[index] + ': ">' + $(element).text() + '</div>';
					
				});
				
			
			content += '</div>';
		});
		
		content += '</div>';
		$(element).replaceWith(content);
		
	});
	
});