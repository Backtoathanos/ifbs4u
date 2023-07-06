$(document).ready(function(){
	/////////////// Index Page /////////////////
	reload();
	function reload(){
		$.ajax({
			url : "actions/action.php",
			method : "post",
			data : {reload:1},
			dataType : 'json',
			success : function(data){
				console.log(data);
				$('#tusers').html(data[0]);
			}
		});
	}	
});
/////////////// Order Page /////////////////

$(document).ready(function(){
	confirm();
	function confirm(){
		var status="unconfirm";
		$.ajax({
			url : '../actions/order.php',
			method : 'post',
			data : {confirmorder:1,status:status},
			success : function(data) {
				$('#diplay-order').html(data);
			}
		});
	}
	function deliver(){
		var status="not deliver";
		$.ajax({
			url : '../actions/order.php',
			method : 'post',
			data : {deliverorder:1,status:status},
			success : function(data) {
				$('#diplay-order').html(data);
			}
		});
	}
	function paid(){
		var status="unpaid";
		$.ajax({
			url : '../actions/order.php',
			method : 'post',
			data : {paidorder:1,status:status},
			success : function(data) {
				$('#diplay-order').html(data);
			}
		});
	}

	$('body').delegate('#confirm','click',function(e){
		e.preventDefault();
		confirm();
	});
	
	$('body').delegate('#deliver','click',function(e){
		e.preventDefault();		
		deliver();		
	});

	$('body').delegate('.confirm','click',function(e){
		e.preventDefault();
		var	opstatus="not deliver";		
		var order_id = $(this).attr("id");
		$.ajax({  
        	url:"../actions/order.php",  
        	method:"POST",
        	data:{  
        	    confirm:1,
        	    order_id:order_id,
        	    status:opstatus
        	},  
        	success:function(data){
        		confirm();    		                  
        	}  
        });      
	});

	$('body').delegate('.cancel','click',function(e){
		e.preventDefault();
		var	opstatus="cancel";		
		var order_id = $(this).attr("id");
		$.ajax({  
        	url:"../actions/order.php",  
        	method:"POST",
        	data:{  
        	    cancel:1,
        	    order_id:order_id,
        	    status:opstatus
        	},  
        	success:function(data){
        		confirm(); 
        		deliver();   		                  
        	}  
        });      
	});

	// $('body').delegate('.deliver','click',function(e){
	// 	e.preventDefault();
	// 	var	opstatus="unpaid";		
	// 	var order_id = $(this).attr("id");
	// 	$.ajax({  
 //        	url:"../actions/order.php",  
 //        	method:"POST",
 //        	data:{  
 //        	    deliver:1,
 //        	    order_id:order_id,
 //        	    status:opstatus
 //        	},  
 //        	success:function(data){
 //        		deliver();   		                  
 //        	}  
 //        });      
	// });

	$('body').delegate('.paid','click',function(e){
		e.preventDefault();
		var	opstatus="unpaid";		
		var order_id = $(this).attr("id");
		$.ajax({  
        	url:"../actions/order.php",  
        	method:"POST",
        	data:{  
        	    paid:1,
        	    order_id:order_id,
        	    status:opstatus
        	},  
        	success:function(data){
        		paid();  
        		if(data=="yes"){
					alert("Thank You!!");        			
        			window.location.replace("Order.php"); 		                  
        		}
        	}  
        });      
	});
});
