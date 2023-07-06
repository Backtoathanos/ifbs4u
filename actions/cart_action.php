<?php
session_start();
$order_table = '';
$order_table = ''; 
$total = 0;
if(isset($_POST["add_to_cart"])){        

      // if add to cart trigered
      if($_POST["add_to_cart"] == "add"){  
           if(isset($_SESSION["fbs_shopping_cart"])){  
                $is_available = 0;  
                foreach($_SESSION["fbs_shopping_cart"] as $keys => $values){  
                     if($_SESSION["fbs_shopping_cart"][$keys]['product_id'] == $_POST["product_id"]){  
                          $is_available++;  
                          $_SESSION["fbs_shopping_cart"][$keys]['product_quantity'] = $_SESSION["fbs_shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                          echo "Cart Quantity Increased!!!!!!";
                     }  
                }  
                if($is_available < 1){  
                     $item_array = array(  
                          'product_id'               =>     $_POST["product_id"], 
                          'product_vendor_id'        =>     $_POST["product_vendor_id"],  
                          'product_name'             =>     $_POST["product_name"],  
                          'product_price'            =>     $_POST["product_price"],  
                          'product_quantity'         =>     $_POST["product_quantity"]
                     );  
                     $_SESSION["fbs_shopping_cart"][] = $item_array;  
                     echo "Item Added to Cart!!!";
                }  
           }else{  
                $item_array = array(  
                          'product_id'               =>     $_POST["product_id"], 
                          'product_vendor_id'        =>     $_POST["product_vendor_id"],  
                          'product_name'             =>     $_POST["product_name"],  
                          'product_price'            =>     $_POST["product_price"],  
                          'product_quantity'         =>     $_POST["product_quantity"]
                );  
                $_SESSION["fbs_shopping_cart"][] = $item_array;  
                echo "Item Added to Cart!!!";
           }  
      }        
}

// if remove cart trigered
 if(isset($_POST['delete'])){  
     foreach($_SESSION["fbs_shopping_cart"] as $keys => $values){  
          if($values["product_id"] == $_POST["product_id"]){  
               unset($_SESSION["fbs_shopping_cart"][$keys]);  
               echo "Product Removed!!!";  
          }  
     }  
}  


if(isset($_POST['show_cart'])){
  $order_table .= ' 
       <table class="table table-bordered">  
            <tr>  
                 <th width="50%">Product Name</th>
                 <th width="30%">Price</th>  
                 <th width="15%">Total</th>  
                 <th width="5%">Action</th>  
            </tr>  
       ';
  if(!empty($_SESSION["fbs_shopping_cart"])){ 
    foreach(@$_SESSION["fbs_shopping_cart"] as $keys => $values){
        $order_table .= '
                        <tr>  
                            <td>'.$values["product_name"].'</td> 
                            <td align="right"><i class="fas fa-rupee-sign"></i> '.$values["product_price"].'X'.$values["product_quantity"].'</td>  
                            <td align="right">
                            
                            <i class="fas fa-rupee-sign"></i> '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>  
                            <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'">Remove</button></td>  
                        </tr> 
                        ';
                        $total = $total + ($values["product_quantity"] * $values["product_price"]) ; 
    }
     $order_table .= ' 
                          <tr>  
                               <td colspan="2" align="right">Total</td>  
                               <td align="right"><i class="fas fa-rupee-sign"></i> '.number_format($total, 2).'</td>  
                               <td></td>  
                          </tr>  
                          <tr>  
                               <td colspan="4" align="center">  
                                    <form method="post" action="cart.php">  
                                         <a href="place_order.php" class="btn btn-warning" >Place Order</a>  
                                    </form>  
                               </td>  
                          </tr>  
                        ';  
  }else{
    $order_table.='
                <tr>  
                  <td colspan="5" align="center">  
                      <h3>Cart Empty!!!</h3>
                  </td>  
                </tr>  
                ';
  }
  $order_table .= '</table>';  
  $countopr=count(@$_SESSION["fbs_shopping_cart"]);
  $countop=$countopr;
  $export=array(
    "orderTable" => $order_table,
    "count" => $countopr,
    "subtotal" => $total
  ); 
  echo json_encode($export);
}

?>