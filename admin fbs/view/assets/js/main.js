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
				// console.log(data);
				$('#tusers').html(data[0]);
				$('#rcustomers').html(data[1]);
				$('#aproducts').html(data[2]);
				$('#vendors').html(data[3]);
				$('#employees').html(data[4]);
				$('#branch').html(data[5]);
				$('#notificationcheckorder').html(data[6]);
				$('#categories').html(data[7]);
				$('#psolded').html(data[8]);
			}
		});
	}

	/////////////// Product Page /////////////////
	// select filter function
	$(document).on('click', '#filterSelect', function(e){
		e.preventDefault(); 
		var filter=$('#filterSelect').val();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : {loadproducts:1,filter:filter},
			dataType : 'json',
			success : function(data){
				$('#search-field').html(data);
				
			}
		});
	});

	// add products
	$('#add-products').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : new FormData(this),
			contentType : false,
			processData : false,
			success : function(data){
				alert(data);
				if(data=="Product's added!!"){
					$('#add-products')[0].reset();
				}
			}
		});
	});

	// update btn triggers
	var product_price;
	var status;
	$('body').delegate('.updatebtn','click',function(e){
		e.preventDefault();
		var product_id = $(this).attr("id");
		product_price=$('#updateprice'+product_id).val();
		status=$('#status'+product_id).val();
		$.ajax({  
        	url:"../actions/action.php",  
        	method:"POST",
        	data:{  
        	    update:1,
        	    product_id:product_id,
        	    product_price:product_price,
        	    status:status
        	},  
        	success:function(data){
        		if(data=="yes"){
        			alert("This Poduct is updated. Keep going on or select category to see the Price of Products!!");
        		}
        		if(data=="error"){
        			alert("Something went wrong!!");
        		}
        		                  
        	}  
        });  
	});


	// delete btn triggers
	$('body').delegate('.delbtn','click',function(e){
		e.preventDefault();
		var product_id = $(this).attr("id");
		var pdimage=$('#productimage'+product_id).val();
		$.ajax({  
        	url:"../actions/action.php",  
        	method:"POST",
        	data:{  
        	    delete:1,
        	    product_id:product_id,
        	    pdimage:pdimage
        	},  
        	success:function(data){
        		console.log(data);
        		if(data=="deleted"){
        			alert("Products is Deleted!!!");
        		}
        		if(data=="Image Can't Deleted"){
        			alert("Product's can't deleted because maybe you deleted image of products.");
        		}
        		if(data=="Products can't Deleted."){
        			alert("Products error you need to check database!!!");
        		}
        		                  
        	}  
        });  
	});

	// search product
	$('body').delegate('#search-data','keyup',function(e){
		var s=$('#search-data').val();
		e.preventDefault();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : {searchproducts:1,search:s},
			success : function(data){
				$('#search-field').html(data);
			}
		});
	});
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
	function allorder(){
		var status="paid";
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

	$('body').delegate('#paidbtn','click',function(e){
		e.preventDefault();		
		allorder();		
	});


	// $('body').delegate('.confirm','click',function(e){
	// 	e.preventDefault();
	// 	var	opstatus="not deliver";		
	// 	var order_id = $(this).attr("id");
	// 	$.ajax({  
 //        	url:"../actions/order.php",  
 //        	method:"POST",
 //        	data:{  
 //        	    confirm:1,
 //        	    order_id:order_id,
 //        	    status:opstatus
 //        	},  
 //        	success:function(data){
 //        		confirm();    		                  
 //        	}  
 //        });      
	// });

	// $('body').delegate('.cancel','click',function(e){
	// 	e.preventDefault();
	// 	var	opstatus="cancel";		
	// 	var order_id = $(this).attr("id");
	// 	$.ajax({  
 //        	url:"../actions/order.php",  
 //        	method:"POST",
 //        	data:{  
 //        	    cancel:1,
 //        	    order_id:order_id,
 //        	    status:opstatus
 //        	},  
 //        	success:function(data){
 //        		confirm(); 
 //        		deliver();   		                  
 //        	}  
 //        });      
	// });

	$('body').delegate('.paid','click',function(e){
		e.preventDefault();
		var	opstatus="paid";		
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
        		alert("Thankyou!!");
        		// deliver();   		                  
        	}  
        });      
	});

	// $('body').delegate('.paid','click',function(e){
	// 	e.preventDefault();
	// 	var	opstatus="paid";		
	// 	var order_id = $(this).attr("id");
	// 	$.ajax({  
 //        	url:"../actions/order.php",  
 //        	method:"POST",
 //        	data:{  
 //        	    paid:1,
 //        	    order_id:order_id,
 //        	    status:opstatus
 //        	},  
 //        	success:function(data){
 //        		paid();  
 //        		if(data=="yes"){
	// 				alert("Thank You!!");        			
 //        			window.location.replace("Order.php"); 		                  
 //        		}
 //        	}  
 //        });      
	// });
});

/////////////// Vendor Page /////////////////

$(document).ready(function(){
	// show vendor
	show_vendor();
	function show_vendor(){
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : {show_vendor:1},
			success : function(data){
				$('#show_vendor').html(data);
			}
		});
	}

	// add vendor
	$('#add-vendor').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : new FormData(this),
			contentType : false,
			processData : false,
			success : function(data){
				// console.log(data);
				// alert(data);
				$('#out_vendor').html(data);
				if(data=="Vendor added!!"){
					$('#add-vendor')[0].reset();
					
				}
			}
		});
	});
	$('body').delegate('.vendordelbtn','click',function(e){
		e.preventDefault();
		var product_id = $(this).attr("id");
		var pdimage=$('#productimage'+product_id).val();
		$.ajax({  
        	url:"../actions/action.php",  
        	method:"POST",
        	data:{  
        	    deletevendor:1,
        	    product_id:product_id,
        	    pdimage:pdimage
        	},  
        	success:function(data){
        		alert(data);
        		// console.log(data);
        		show_vendor();    
        	}  
        });  
	});
});



/////////////// Category Page /////////////////

$(document).ready(function(){
	// add Category
	$('#add-Category').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : new FormData(this),
			contentType : false,
			processData : false,
			success : function(data){
			 //   console.log(data);
				alert(data);
				if(data=="Category added!!"){
				// 	$('#add-Category')[0].reset();
				}
			}
		});
	});
});


/////////////// Employee Page /////////////////
$(document).ready(function(){
	// show employee
	show_employee();
	function show_employee(){
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : {show_employee:1},
			success : function(data){
				$('#show_Employee').html(data);
			}
		});
	}

	// add employee
	$('#add-Employee').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			url : "../actions/action.php",
			method : "post",
			data : new FormData(this),
			contentType : false,
			processData : false,
			success : function(data){
				// console.log(data);
				// alert(data);
				$('#out_Employee').html(data);
				show_employee();
				if(data=="Vendor added!!"){
					$('#add-vendor')[0].reset();
					
				}
			}
		});
	});

	// delete employee
	$('body').delegate('.empdelbtn','click',function(e){
		e.preventDefault();
		var product_id = $(this).attr("id");
		var pdimage=$('#productimage'+product_id).val();
		$.ajax({  
        	url:"../actions/action.php",  
        	method:"POST",
        	data:{  
        	    deleteemployee:1,
        	    product_id:product_id,
        	    pdimage:pdimage
        	},  
        	success:function(data){
        		alert(data);
        		// console.log(data);
        		show_vendor();    
        	}
        });  
	});
});