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
				$('#aproducts').html(data[1]);
				$('#notificationcheckorder').html(data[3]);
				$('#categories').html(data[0]);
				$('#psolded').html(data[2]);
			}
		});
	}

	/////////////// Product Page /////////////////

	$('#add-products').hide();
	$(document).on('click', '#forshowHideproductform', function(e){
	e.preventDefault();
		$('#add-products').slideToggle();
	});


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
				// console.log(data);
				$('#search-field').html(data);
				
			}
		});
	});

	// add products
	$('#add-products').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
			url : "../actions/action.php",
			type : "post",
			data : new FormData(this),
			contentType : false,
			cache: false,
			processData : false,
			beforeSend: function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="https://media.giphy.com/media/y1ZBcOGOOtlpC/giphy.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
			success : function(data){
				// alert(data);
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
		var status="not deliver";
		$.ajax({
			url : '../actions/order.php',
			method : 'post',
			data : {confirmorder:1,status:status},
			success : function(data) {
				$('#diplay-order').html(data);
			}
		});
	}		

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
        		paid();  
        		window.reload(); 		                  
        	}  
        });      
	});
});
