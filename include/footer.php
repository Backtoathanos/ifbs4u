  
<!-- both close div is containers div which opened in header.php -->
    </div>
</div>
<!--  Footer  -->
    <!--footer area start-->
    <!-- <div id="footer-main"> -->

        <div class="footer">
    <!-- first footer -->
    <div class="footer-first">
        <div class="container">
            <div class="row social-act col-sm-6">
                <a href="#">
                    <span>
                        <i class="fa fa-google-plus-official" style="font-size:48px;color:red"></i>
                    </span>
                </a>
                <a href="https://www.facebook.com/ifbs4u-2682140695149103/">
                    <span>
                        <i class="fa fa-facebook-official" style="font-size:48px;color:#428bca"></i>
                    </span>
                </a>
                <a href="#">
                    <span>
                        <i class="fa fa-instagram" style="font-size:48px;color:#e4405f"></i>
                    </span>
                </a>
            </div>
            <div class="social-act col-sm-6">
                <a id="play-store-logo" href="https://play.google.com/store/apps/details?id=com.gmail.nausherkhan12.fbs" ><img src="include/assets/images/android.png"></a>
            </div>
        </div>
    </div>

    <!-- second footer -->
    <div class="footer-second">
        <div class="container">
            <div class="row social-act col-sm-12">
                <div class="col-sm-4">
                    <b>We Are</b>
                    <ul>
                        <li>
                            <p>
                                FBS is india's largest online food and glocery store. with over 18000 products and over a 1000 brands in our data logue you wil find everything you are looking for. Right from fresh fruits, Vegetables and seasonings to packaged products. Beverages, Personal care Meats - we have it all
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-map-marker f_left"></i>
                                Near Karim City College Road No.1 Old Purulia Road Zakir Nagar Mango,Jamshedpur,
                                832110, Jharkhand, India.
                            </p>
                        </li>
                        <li><i class="fa fa-phone">: +918789139913 </i></li>
                        <li><i class="fa fa-envelope">: wefbs4you@gmail.com</i></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <b>Product's Category</b>
                    <ul class="show_product_at_id for-this">
                    </ul>
                </div>
                <div class="col-sm-4">
                    <b>Informations</b>
                    <ul class="for-this">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="ReturnPolicy.php">Return Policy</a></li> 
                        <li><a href="Delivery.php">Delivery</a></li> 
                        <li><a href="PrivacyPolicy.php">Privacy Policy</a></li>
                        <li><a href="T&C.php">Terms & Conditions</a></li> 
                    </ul>
                </div>
            </div>
        </div>
    </div>

     <!-- third footer -->
    <div class="footer-third">
        <div class="container">
            <div class="row social-act">
                <div class="col-sm-12">
                    <span> &copy; By FBS 2018. All Rights Reserved.</span>
                </div>
        </div>
    </div>


</div>
       
<script src="include/assets/js/jquery.min.js"></script>
<script src="include/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="include/assets/js/func.js"></script>
<script type="text/javascript" src="include/assets/js/responsive.js"></script>
<script type="text/javascript" src="include/assets/js/getalldata.js"></script>
<script>
  $('#signinButton').click(function() {
    // signInCallback defined in step 6.
    auth2.grantOfflineAccess().then(signInCallback);
  });
</script>

<script>
function signInCallback(authResult) {
  if (authResult['code']) {

    // Hide the sign-in button now that the user is authorized, for example:
    $('#signinButton').attr('style', 'display: none');

    // Send the code to the server
    $.ajax({
      type: 'POST',
      url: 'http://ifbs4u.in/actions/gact.php',
      // Always include an `X-Requested-With` header in every AJAX request,
      // to protect against CSRF attacks.
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      contentType: 'application/octet-stream; charset=utf-8',
      success: function(result) {
        // Handle or verify the server response.
      },
      processData: false,
      data: authResult['code']
    });
  } else {
      console.log("error");
    // There was an error.
  }
}
</script>


</body>
</html>