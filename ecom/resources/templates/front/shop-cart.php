<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 <ul class="nav navbar-nav navbar-left">
           
                    <li class="dropdown">
          <a href="index.php" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><label style="color:#e7e7e7;" ><?php count_product(); ?></label ><span   id="shop-icon" class="glyphicon glyphicon-shopping-cart" style="color:#01ACC8;"></span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
              
    <li>
          <div style="right:0; "><label class="list" style="color:black;display: block; text-align:center; direction:rtl;" >סל קניות</label></div>
                  
                  
        <?php     get_shop_cart(); ?>
        
         <div >
             <a class="btn " style="background-color:#01ACC8; color:#fff; width:80%; margin:5%; margin: 3% 10%; margin-top:5%;"  href="../public/checkout.php">מעבר לתשלום</a>
             </div>
        
         </li>
              
          </ul>
        </li>
  
          
      </ul>


