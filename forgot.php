
<?php  include("include/header.php"); ?>

<div class="row navhead">
	<h1 align="center">Did you forgot your password??</h1>
</div>
	  

<!-- Vegetables area -->
	<div class="container">
		 
		<div class="row">
			<h3>Find your account with your.</h3>
			<form id="forgot-password">
			<div class="col-sm-4">
				<label><b> First Name: </b></label>
				<input type="text" class="form-control" placeholder="Enter First Name" name="forgotfname"  required><br>
			</div>
			<div class="col-sm-4">
				 <label><b> Last Name: </b></label>
				<input type="text" class="form-control" placeholder="Enter First Name" name="forgotlname" required><br>
			</div>
			<div class="col-sm-4">		
				<label><b> & Email: </b></label>
				<input type="email" class="form-control" placeholder="Enter Email" name="forgotemail" required><br>
			</div>
			<div class="col-sm-4">	
				<input type="submit" class="btn btn-default" value="Find">
			</div>
			</form>
 	 	</div>

 	 	<div class="row">
 	 		<div class="col-md-8">
 	 			<div id="display-password"></div>
 	 			
 	 		</div>
 	 	</div>
	</div>

	



 


<?php  include("include/footer.php"); ?>