
<?php  include("include/header.php"); ?>



<div class="product-details-page-form Addresses">
					<div class="row">	
					<!-- Price Details -->
						<div class="col-sm-3">
							<div class="product-details-page-form">
								<div id="checkout_section">
									<h4>Price Details</h4>
									<h5><span style="text-align: left"><b><i class="fas fa-rupee-sign"></i> <span id="Sub_total_place"></span></span></b>: SubTotal</h5>
									<h5><span style="text-align: left"><b><i class="fas fa-rupee-sign"></i> 20 </span></b>: Delivery Charges</h5>
									<h5><span style="text-align: left"><b><i class="fas fa-rupee-sign"></i> <span id="total_order_place"></span></span></b>: Total</h5>
									<!-- <button class="btn btn-danger ptopay" id="checkout" disabled>Proceed to Pay</button> -->
								</div>
							</div>
						</div>					
						<!-- cart -->
						<div class="col-sm-9">
							<div class="container-fluid">
								<div class="product-details-page-form">
									<div class="row">
										<!-- <label for="YOURID">The clickable region<label>
										<input id="YOURID" type="text" /> -->
										<div id="SaHead"><h2>Deliver to (As a Guest)</h2></div>
										<div id="ShippAddress">
											<form id=deliverAddress>
												<input type="text" placeholder="First Name" name="FirstName" required>
												<input type="text" placeholder="Last Name" name="lastName" required>
												<input type="text" placeholder="Mobile No" name="mobileno" required>
												<!-- <input type="text" placeholder="Pincode" name="pincode"> -->
												<textarea name="Addresssec" cols="40" rows="5"   placeholder="Address" required></textarea>	
												<input type="text" value="Jamshedpur" disabled placeholder="City" name="city">
												<input type="text" value="Jharkhand" disabled placeholder="State" name="state">
												<input type="text" value="India" placeholder="Locality" disabled name="locality">
												<input type="submit" value="Save & Go" class="Savebtn">
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
	



 


<?php  include("include/footer.php"); ?>