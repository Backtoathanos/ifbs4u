$(document).ready(function(){

	// header search
	$('#close-search-field').hide();
	$('#search-res-box').hide();
	$('#search-box').on('keyup',function(e){
		e.preventDefault();
		var pro_name=$('#search-box').val();
	    $.ajax({
	      url:'actions/data_action.php',
	      method:'post',
	      data:{search_product:1,search_products_name:pro_name},
	      success:function(data){
	      	$('#close-search-field').show();
	        $('#search-res-box').html(data);
	        $('#search-res-box').toggle(500);
	      }
	   	});
		$('#close-search-field').on('click',function(e){
			e.preventDefault();
			$('#search-res-box').fadeOut(500);
			$('#close-search-field').hide();
		});
	});


	// Login
	$('#loginform').on('submit', function(e){
	    e.preventDefault();
	    $.ajax({
	      url: 'actions/login.php',
	      method: 'POST',
	      data: new FormData(this),
	      contentType: false,
	      processData: false,
	      success: function(data){

	        $('#loginform')[0].reset();
	        if(data=='Success'){
				window.location="index.php";
			}
			if(data=='Error'){
				alert('Please check your Username & Password!');
			}
	      }
	    });
	 });

	// Signup

	$('#signupform').on('submit', function(e){
	    e.preventDefault();
	    $.ajax({
	      url: 'actions/signup.php',
	      method: 'POST',
	      data: new FormData(this),
	      contentType: false,
	      processData: false,
	      success: function(data){
	      	// console.log(data);

	        $('#signupform')[0].reset();
	        if(data=='Success'){
				window.location="index.php";
			}
			if(data=="registered"){
				alert("These Email is already Registered!!");
			}
			if(data=="success"){
				alert("Thankyou!! You Can Login Now.");
			}
			if(data=='empty'){
				alert('Please fill them');
			}
	      }
	    });
	 });


	// forgot password form
	$('#forgot-password').on('submit',function(e){
		 e.preventDefault();
	    $.ajax({
	      url: 'actions/forgotp.php',
	      method: 'POST',
	      data: new FormData(this),
	      contentType: false,
	      processData: false,
	      success: function(data){
	        $('#forgot-password')[0].reset();
	        $('#display-password').html(data);
	      }
	    });
	});


	// contact form
	$('#contact_us').on('submit', function(e){
	    e.preventDefault();
	    $.ajax({
	      url: 'actions/contact.php',
	      method: 'POST',
	      data: new FormData(this),
	      contentType: false,
	      processData: false,
	      success: function(data){

	        $('#contact_us')[0].reset();
	        if(data=='Success'){
				window.location="index.php";
			}
			if(data=='error'){
				alert('Hmmm! here something problem please try later.');
			}
			if(data=='sorry'){
				alert('Hmmm! cannot recieve mail.');
			}
	      }
	    });
	});



});



