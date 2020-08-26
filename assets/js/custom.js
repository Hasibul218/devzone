(function($){
	$(document).ready(function(){
		//Account Delete confirm
		$('a#deactive').click(function(){
			let con = confirm("Are you sure ?");
			if(con == true){
				return true;
			}else{
				return false;
			}
		});



	});
})(jQuery)