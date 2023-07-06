<?php include "connectionredfield/db.php"; ?>
<?php  include("include/header.php"); ?>


<div class="row navhead">
    <h1 align="center">Welcome to FBS</h1>
    <p align="center">Take It Easy Make It Easy</p> 
</div>
<!-- Login form -->
      <div class="col-md-3">
        <h1><b>Login</b></h1>
        <form id="loginform" action="" method="">
            <div class="form-group">
                <label><b> Email: </b></label>
                <input type="text" class="form-control" placeholder="Enter Email" id="login-email" name="email" required><br>

                <label><b> Password: </b></label>
                <input type="password" class="form-control" placeholder="Enter Password" id="login-password" name="password" required><br>

                <a href="forgot.php">Password forgotten??</a><br>
                
                <button class="btn btn-default" id="loginbutton">Login</button>
                <!--<a href="#" id="signinButton" class="google btn" style="background-color: #dd4b39; color: white;"><i class="fa fa-google fa-fw">-->
                <!--      </i> Login with Google+-->
                <!--    </a>-->
            </div>
        </form>                
    </div>
    
    <form action="" id="signupform" method="">
        <div class="col-md-9">        
                <h1><b>Signup</b></h1>
                <div class="col-md-6 form-group">
                    <label><b> First Name: </b></label>
                    <input type="text" class="form-control" placeholder="Enter First Name" name="signfirstname" required><br>

                    <label><b> Last Name: </b></label>
                    <input type="text" class="form-control" placeholder="Enter Last Name" name="signlastname" required><br>

                    <label><b> Email: </b></label>
                    <input type="text" class="form-control" placeholder="Enter Email" name="signemail" required><br>
                    

                    
                </div> 
                <div class="col-md-6">

                    <label><b> Contact: </b></label>
                    <input type="text" class="form-control" placeholder="Enter Phone No" name="signcontact" required><br>

                    <label><b> Address: </b></label>
                    <input type="text" class="form-control" placeholder="Enter Address" name="signaddress" required><br>

                    <!-- <label><b> Address 2: </b></label>
                    <input type="password" class="form-control" placeholder="Enter Address 2" name="signaddress2" required><br> -->

                    <label><b> Password: </b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="signpassword" required><br>

                    <button type="submit" class="btn btn-default">Signup</button>

                </div>           
        </div>
    </form>




<?php  include("include/footer.php"); ?>

