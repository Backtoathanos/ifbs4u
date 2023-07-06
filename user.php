<?php  include("include/header.php"); ?>

<div class="row">
	<div><h2 align="center">Personal Details.</h2></div>
	<div class="col-sm-6 form-group">
		<form id="user-form">
			<div><label>First Name:</label><input class="form-control" type="text" id="ufname"></div>
			<div><label>Last Name:</label><input class="form-control" type="text" id="ulname"></div>
			<div><label>Email:</label><input class="form-control" type="email" id="uemail"></div>
			<div><label>Contact:</label><input class="form-control" type="text" id="ucontact"></div>
			<div><label>Address:</label><textarea class="form-control" type="text" id="uaddress"></textarea></div>
			<div id="button-cat">
				<div class="col-sm-4"><button id="edit-pdetails">Edit</button></div>
				<div class="col-sm-4"><button id="save-pdetails" >Save</button></div>
				<div class="col-sm-4"><button id="change-password" >Change Password</button></div>
			</div>
		</form>
	</div>

	<div id="p-section" class="col-sm-6 form-group">
		<div id="p-section">
			<div><h2><b>Change Password</b></h2></div>
			<div><label>Current Password:</label><input class="form-control" type="password" id="crrt-password"></div>
			<div><label>New Password:</label><input class="form-control" type="password" id="new-password"></div>
			<div><label>Confirm Password:</label><input class="form-control" type="password" id="conf-password"></div>
			<div><button id="update-password" >Update</button></div>
			<p id="update-mssg"><b></b></p>
		</div>
	</div>
</div>
	  

<?php  include("include/footer.php"); ?>