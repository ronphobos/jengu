$(document).ready(function(){
	cat();
	brand();
	product();
	
	//product() is a funtion fetching product record from database whenever page is load
		function product(){
		$.ajax({
			url	:	"freelance-action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_equipe").html(data);
			}
		})
	}
	/*	when page is load successfully then there is a list of categories when user click on category we will get category id and 
		according to id we will show products
	*/
	// $("body").delegate(".category","click",function(event){
	// 	$("#get_equipe").html("<h3>Loading...</h3>");
	// 	event.preventDefault();
	// 	var cid = $(this).attr('cid');
		
	// 		$.ajax({
	// 		url		:	"freelance-action.php",
	// 		method	:	"POST",
	// 		data	:	{get_seleted_Category:1,cat_id:cid},
	// 		success	:	function(data){
	// 			$("#get_equipe").html(data);
	// 			if($("body").width() < 480){
	// 				$("body").scrollTop(683);
	// 			}
	// 		}
	// 	})
	
	// })

	/*	when page is load successfully then there is a list of brands when user click on brand we will get brand id and 
		according to brand id we will show products
	*/
	// $("body").delegate(".selectBrand","click",function(event){
	// 	event.preventDefault();
	// 	$("#get_equipe").html("<h3>Loading...</h3>");
	// 	var bid = $(this).attr('bid');
		
	// 		$.ajax({
	// 		url		:	"freelance-action.php",
	// 		method	:	"POST",
	// 		data	:	{selectBrand:1,brand_id:bid},
	// 		success	:	function(data){
	// 			$("#get_equipe").html(data);
	// 			if($("body").width() < 480){
	// 				$("body").scrollTop(683);
	// 			}
	// 		}
	// 	})
	
	// })
	/*
		At the top of page there is a search box with search button when user put name of product then we will take the user 
		given string and with the help of sql query we will match user given string to our database keywords column then matched product 
		we will show 
	*/
	$("#search_btn").click(function(){
		$("#get_equipe").html("<h3>Loading...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"freelance-action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_equipe").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	



	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$.ajax({
			url	:	"freelance-action.php",
			method	:	"POST",
			data	:	{getProduct:1,setPage:1,pageNumber:pn},
			success	:	function(data){
				$("#get_equipe").html(data);
			}
		})
	})
})




















