$(document).ready(function(){

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const product_category = urlParams.get('cat');
  // console.log(product_category);

  // category data on navigations and footer
    nav_cat();
    function nav_cat(){
      $.ajax({
        url: 'actions/data_action.php',
        method:'POST',
        data:{nav_category:1},
        dataType: 'JSON',
        success:function(data){
          $('.show_product_at_id').html(data);

        }
      });
    }


    index_cat();
    function index_cat(){
      $.ajax({
        url: 'actions/data_action.php',
        method:'POST',
        data:{index_category:1},
        dataType: 'JSON',
        success:function(data){
          $('#category_data').html(data);

        }
      });
    }

   // Product data
    Common_Products();
    function Common_Products(){
      $.ajax({
        url: 'actions/data_action.php',
        method:'POST',
        data:{product_category:product_category},
        success:function(data){
          // console.log(data);
          $('#Product_data').html(data);
        }
      });
    }
});

$(document).ready(function(){
        
    juice_index();
    function juice_index(){
      $.ajax({
        url: 'actions/data-index.php',
        method:'POST',
        data:{juice_index:4},
        success:function(data){
          $('#juice_index_data').html(data);

        }
      });
    }
    
    veg_index();
    function veg_index(){
      $.ajax({
        url: 'actions/data-index.php',
        method:'POST',
        data:{veg_index:8},
        success:function(data){
            // console.log(data);
          $('#veg_index_data').html(data);

        }
      });
    }

    non_veg_index();
    function non_veg_index(){
      $.ajax({
        url: 'actions/data-index.php',
        method:'POST',
        data:{non_veg_index:3},
        success:function(data){
          $('#non_veg_index_data').html(data);

        }
      });
    }

    fruits_index();
    function fruits_index(){
      $.ajax({
        url: 'actions/data-index.php',
        method:'POST',
        data:{fruits_index:1},
        success:function(data){
          $('#fruits_index_data').html(data);

        }
      });
    }

    dryfruits_index();
    function dryfruits_index(){
      $.ajax({
        url: 'actions/data-index.php',
        method:'POST',
        data:{dry_fruits_index:5},
        success:function(data){
          $('#dryfruits_index_data').html(data);

        }
      });
    }

    // add to cart 
    $('body').delegate('.add_to_cart','click',function(){
        var product_id = $(this).attr("id");  
        var product_name = $('#name'+product_id).val();
        var product_vendor_id = $('#product_vendor_id'+product_id).val();  
        var product_price = $('#price'+product_id).val();  
        var product_quantity = $('#quantity'+product_id).val();  
        var add_to_cart="add";
        $.ajax({  
          url:"actions/cart_action.php",  
          method:"POST",
          data:{  
              product_id:product_id,
              product_vendor_id:product_vendor_id,
              product_name:product_name,
              product_price:product_price,
              product_quantity:product_quantity,   
              add_to_cart:add_to_cart  
          },  
          success:function(data){
            show_cart();
            alert(data);
            console.log(data);
                              
          }  
        });           
    });


/*----------------------------------------------------------cart page-------------------------------------------------------*/
    
    // cart
    show_cart();
    function show_cart(){
      $.ajax({
        url:'actions/cart_action.php',
        method:'POST',
        data:{show_cart:1},
        dataType: 'JSON',
        success:function(data){
                $('#order_table').html(data["orderTable"]);
                $('.badge').html(data["count"]);
                $('#Sub_total_place').html(data["subtotal"]);
                var final_total=data["subtotal"] + 20;
                $('#total_order_place').html(final_total);
        }
      });
    }

    // quantity change
    $(document).on('change', '.quantity', function(){  
        var product_id = $(this).data("product_id");  
        var quantity = $(this).val();  
        var change_cart = $('#cartprice'+product_id).val();
        var action = "quantity_change"; 
        if(quantity != ''){  
          $.ajax({  
               url :"actions/cart_action.php",  
               method:"POST",  
               data:{product_id:product_id, quantity:quantity, change_cart:change_cart, quantity_action:action},  
               success:function(data){ 
                show_cart();
                // console.log(data);
               }  
          });  
      }  
    });  

    // delete from cart
      $('body').delegate('.delete','click',function(e){
      e.preventDefault();
      var product_id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this product?")){   
          $.ajax({  
            url:"actions/cart_action.php",  
            method:"POST",
            data:{  
                product_id:product_id,
                delete:1  
            },  
            success:function(data){  
              show_cart();
              alert(data);                        
            }  
          });  
        }         
    });
    

/*----------------------------------------------------------place order page-------------------------------------------------------*/


    // deliver
    $('#deliverAddress').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'actions/checkout.php?deliver',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data){
          // console.log(data);
          if (data="success") {
             window.location="thankyou.php";
          }else{
            alert(data);
          }
        }
      });
   });
  

});


// user.php
$(document).ready(function(){
   //get personal details data
   pdetails();
   function pdetails(){
    $.ajax({
      url:'actions/pdetails.php',
      method:'POST',
      dataType:'json',
      data:{pdetails:1},
      success:function(data){
        $('#ufname').val(data['signup_firstName']);
        $('#ulname').val(data['signup_lastName']);
        $('#uemail').val(data['signup_email']);
        $('#ucontact').val(data['signup_contact']);
        $('#uaddress').val(data['signup_address']);
        
      }
    });
   } 

   // onload all fields are disabled
   enablepdetails();
  function enablepdetails(){
    $('#ufname').attr('disabled','disabled');
    $('#ulname').attr('disabled','disabled');
    $('#uemail').attr('disabled','disabled');
    $('#ucontact').attr('disabled','disabled');
    $('#uaddress').attr('disabled','disabled');
    $('#save-pdetails').attr('disabled','disabled');
   }

   // on click edit button all fields are enabled
   $('body').on('click','#edit-pdetails',function(e){
    e.preventDefault();
    $('#ufname').removeAttr('disabled','disabled');
    $('#ulname').removeAttr('disabled','disabled');
    $('#uemail').removeAttr('disabled','disabled');
    $('#ucontact').removeAttr('disabled','disabled');
    $('#uaddress').removeAttr('disabled','disabled');
    $('#save-pdetails').removeAttr('disabled','disabled');
   });

   // on click of save button all data will go save
   $('body').on('click','#save-pdetails',function(e){
    e.preventDefault();
        fname=$('#ufname').val();
        lname=$('#ulname').val();
        email=$('#uemail').val();
        contact=$('#ucontact').val();
        address=$('#uaddress').val();
        $.ajax({
          url:'actions/pdetails.php',
          method:'POST',
          data:{
            save:1,
            fname:fname,
            lname:lname,
            email:email,
            contact:contact,
            address:address
          },
          success:function(data){
            enablepdetails();
          }
        });
   });

  psection();
  function psection() {
      // password section
    $('#p-section').hide();
  }
 

  // show password section after click change password
  $('#change-password').on('click', function(e){
    e.preventDefault();
    $('#p-section').show();
  });

  // on click update password
  $('#update-mssg').hide();
  $('#update-password').on('click',function(e){
    e.preventDefault();
    var current_password=$('#crrt-password').val();
    var new_password=$('#new-password').val();
    var confirm_password=$('#conf-password').val();
    $.ajax({
      url:'actions/pdetails.php',
      method:'post',
      data:{
        update:1,
        crrntpassword:current_password,
        npassword:new_password,
        con_password:confirm_password
      },
      success:function(data){
        $('#update-mssg').html(data);
        $('#update-mssg').show();
        window.setTimeout(function(){
              $('#update-mssg').hide();
          },5000);
      }
    });
  });
 
});

// order_status form details
$(document).ready(function(){
  user_order();
  function user_order(){
    $.ajax({
      url: 'actions/user_order.php',
      method:'post',
      data:{user_order:1},
      dataType:'json',
      success:function(data){
        $('#order-data').html(data);
      }
    });
  }
});

// find product page

$(document).ready(function(){
  
  $('#find-btn').on('click',function(e){
    e.preventDefault();    
    var pro_name=$('#find').val();
    $.ajax({
      url:'actions/data_action.php',
      method:'post',
      data:{find_product:1,products_name:pro_name},
      success:function(data){
        $('#find-product').html(data);
        $('#category_data').hide();
      }
    });
  });
$('#find-btn').hide();
  $('#find').on('keyup',function(e){
    e.preventDefault();
    var pro_name=$('#find').val();
      $.ajax({
        url:'actions/data_action.php',
        method:'post',
        data:{find_product:1,products_name:pro_name},
        success:function(data){
          $('#find-product').html(data);
          $('#category_data').hide();
          $('#find-product').toggle();
        }
      });
  });
});
