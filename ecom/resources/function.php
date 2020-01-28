<?php

$upload_directory = "uploads";


function last_id(){
    
    global $conn;
    
    return mysqli_insert_id($conn);
    
    
}

function set_message($msg){
    
    if(!empty($msg)){
        
        
        $_SESSION['message']= $msg;
        
    }else {
        
        
        $msge = "";
        
        
    }
    
}


function display_message(){
    
    if(isset($_SESSION['message'])){
        
        
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        
    }
    
    
    
}

function redirect($location){
    
    
    
    header("Location: $location ");
    
}

function query($sql){
    
    global $conn;
    
    return mysqli_query($conn,$sql);
    
}


function confirm($result){
    global $conn;
        
        if(!$result){
            
            
            die("QUERY FAILED" . mysqli_error($conn));
            
        }
}
 
function escape_string($string){
    
    global $conn;
    
    return mysqli_real_escape_string($conn, $string);
    
    
}

function fetch_array($result){
    
    
    return mysqli_fetch_array($result);
    
}

//get product

function get_products(){
    
    
  $query =  query("SELECT * FROM products");
    
    confirm($query);
    
    //how much row in query//
    
    $rows = mysqli_num_rows($query);
    
    //check if get has page
    
    if(isset($_GET['page'])){
        
        //if its number 
    $page = preg_replace('#[^0-9]#','',$_GET['page']);    
     
    }else{
        
        
        $page = 1;
        
        
    }
    
    //define how many product in page//
    
    $perPage = 6;
    
    //define last page//
    
    $lastPage = ceil($rows / $perPage);
    
    //condition for last page or get is smaller than zero//
    
    if($page < 1){
        
        $page = 1;
    }elseif($page > $lastPage){
        
        
       $page = $lastPage; 
        
    }
    
    
    $middleNumbers = '';
    
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;
    
    if($page == 1){
        
     
            
            $middleNumbers .= ' <li class="page-item active"><a>' .$page. '</a></li>';
            
            $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1. '</a></li>';
        
   
        
        
        
       
    }elseif($page == $lastPage){
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1. '</a></li>';
        
        $middleNumbers .= ' <li class="page-item active"><a>'.$page. '</a></li>';
        
     
        
        
        
    }elseif ($page > 2 && $page < ($lastPage -1)){
        
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">'.$sub2. '</a></li>';
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1. '</a></li>';
        
         $middleNumbers .= ' <li class="page-item active"><a>'.$page. '</a></li>';
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1. '</a></li>';
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">'.$add2. '</a></li>';
        
         
        
        
        
        
        
    }elseif($page > 1 && $page < $lastPage){
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1. '</a></li>';
        
         $middleNumbers .= ' <li class="page-item active"><a>'.$page. '</a></li>';
        
        $middleNumbers .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1. '</a></li>';
        
         
    }
    
    
    $limit = 'LIMIT '. ($page-1) * $perPage . ',' . $perPage;
    
    $query2 =  query("SELECT * FROM products {$limit}");
    confirm($query2);
    
    $outputPagination = "";
    
   if($page != 1){
       
       $prev = $page - 1;
       
       $outputPagination .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
       
   }
    
    $outputPagination .= $middleNumbers;
    
    
    if($page != $lastPage){
        
        $next = $page + 1;
        
        $outputPagination .= ' <li class="page-item "><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';
        
        
    }
    
    
    while($row = fetch_array($query2)){
         $product_image = display_image($row['product_image']);
        
       $product = <<<hd
       <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                        <a href="item.php?id={$row['product_id']}"><img style="height:150px" src="../resources/{$product_image}" alt=""></a>
                                <div class="caption">
                                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>Quantity:{$row['product_quantity']}</p>
                                
                                 <a class="btn btn-primary" style="width:100%; margin-top:5%;"  href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                                 
                        </div>
                    </div>
                 </div>
hd;
        
echo $product;       
       
        
    
    }
    
    echo "<div  class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
    
    
}

function get_categories(){
    
         $query = query("SELECT * FROM categories");
    confirm($query);
    
    while($row = fetch_array($query)){
        
        
        
        $category_link = <<<hd
       
        <a style="color:black; font-family:"Heebo",Arial,Helvetica,sans-serif;" href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
        
        
       
hd;
 
      echo $category_link;  
        
    }
}

function product_category(){
    
    
    $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id'] . " "));
    confirm($query);
    
    
    while($row = fetch_array($query)){
        $product_image = display_image($row['product_image']);
        
        $product = <<<hd
       <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                        <a href="item.php?id={$row['product_id']}"><img style="height:150px" src="../resources/{$product_image}" alt=""></a>
                                <div class="caption">
                                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>Quantity:{$row['product_quantity']}</p>
                                
                                 <a class="btn btn-primary" style="width:100%; margin-top:5%;"  href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                                 
                        </div>
                    </div>
                 </div>
hd;
        
        
         echo $product;
        
        
    }
    
    
    
}


function get_product_shop(){
    
    
    $query = query("SELECT * FROM products");
    confirm($query);
    
    
    while($row = fetch_array($query)){
        
        $product_image = display_image($row['product_image']);
        
        $product = <<<hd
        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img width='150px' height='100px' src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>See more snippets like this online store item at </p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
        
hd;
        
        
         echo $product;
        
        
    }
    
    
    
}


 function log_in_out(){
    
    
    if(isset($_SESSION['username'])){
                
                 $logout = <<<hd
    <a href="admin/logout.php">התנתק</a>
    
hd;
    echo $logout;
                   
                }else{
                    
    
                 $login = <<<hd
    <a href="login_modal.php">התחבר</a>
    
hd;
                    
                    echo $login;
                    
                }
    
} 

function login(){
    
    if(isset($_POST['submit'])){
        
        $username= escape_string($_POST['username']);
        $password= escape_string($_POST['password']);
        
        
        $query = query("SELECT * FROM users WHERE username ='{$username}' AND password = '{$password}'");
        
        confirm($query);
        
        if(mysqli_num_rows($query) == 0){
            
            set_message("שם משתמש או סיסמה שגויה! נסה שנית*");
            redirect("login_modal.php");
        }else{
            while($row = fetch_array($query)){
                
             $db_id = $row['user_id'];
             $db_username = $row['username'];
             $db_password = $row['password'];
             $db_firstname = $row['fname'];
             $db_lastname = $row['lname'];   
             $db_user_role = $row['user_role'];   
                
                
                
                
            }
            
            
            $_SESSION['username'] = $username;
            $_SESSION['dbusername'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['user_role'] = $db_user_role;
            
            if(isset($_SESSION['user_role'])){
                
                if($_SESSION['user_role'] == 'admin'){
            
            redirect("admin");
                    
                }else{
                    
                    
                    
                    redirect("index.php"); 
                }
            
        }
            
        
        
        
    }
    
    }
}


function register(){
    
    
    if(isset($_POST['add'])){
    
        $username= escape_string($_POST['username']);
        $email= escape_string($_POST['email']);
        $password= escape_string($_POST['password']);
    
        
        if(!empty($username) && !empty($email) && !empty($password)){
            
            
            
            
             $query = query("INSERT INTO users(username, email, password) VALUES('{$username}', '{$email}', '{$password}')");
        confirm($query);
        
            
        redirect("login_modal.php");
   set_message("הרשמה עברה בהצלחה נסה להתחבר*");
            
            
            
        }else{
            
               set_message("תרשום את כל הפרטים*");
            
            
        }
        
      
    
}
}

function send_message(){
    
    
    if(isset($_POST['submit'])){
        
        $to = "salih-sadi@hotmail.com";
        $From_name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $headers = "From: {$From_name} {$email}";
        
        $result = mail($to, $subject, $message, $headers);
        
        if(!$result){
            
            
            echo "error";
            
            
        }else{
            
            
          echo "Sent";  
            
        }
        
        
        
        
    }
    
    
}

////-----------backend function-----------///


function display_orders(){
    
    $query = query("SELECT * FROM orders");
    confirm($query);
    
    
   while($row = fetch_array($query)){
        
        
        $orders = <<<hd
     <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_currency']}</td>
            <td>{$row['order_status']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
           
        </tr>
    
hd;
       
     echo $orders;
}

}


/******Admin products*******/

function display_image($picture){
    
    global $upload_directory;
    
    return $upload_directory . DS . $picture;
}

function get_product_admin(){
    
    
     $query = query("SELECT * FROM products");
    confirm($query);
    
    
    while($row = fetch_array($query)){
        
      $category = show_product_cat_title($row['product_category_id']);
        
        $product_image = display_image($row['product_image']);
        
        $product = <<<hd
        <tr>
        <td>{$row['product_id']}</td>
        <td>{$row['product_title']}<br>
        <a href="index.php?edit_product&id={$row['product_id']}"><img width='150px' height='100px' src="../../resources/{$product_image}" alt=""></a>
        </td>
        <td>{$category}</td>
        <td>{$row['product_price']}</td>
        <td>{$row['product_quantity']}</td>
        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        
hd;
        
        
         echo $product;
        
        
    }
    
    
    
}

//*******ADD product*****//



function add_product(){
    
    if(isset($_POST['publish'])){
    
        $product_title = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_price= escape_string($_POST['product_price']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc = escape_string($_POST['short_desc']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $product_image = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);
        
        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        
        
       $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity, product_description, short_desc, product_image) VALUES('{$product_title}','{$product_category_id}','{$product_price}','{$product_quantity}','{$product_description}','{$short_desc}','{$product_image}')");
       $last_id = last_id();    
       confirm($query);
       set_message("New Product with id {$last_id} was Added");
        
        
        redirect("index.php?products");
        
        
       
    
    
}

    }


function show_product_cat_title($product_category_id){
    
    
    
    $category_query = query("SELECT * FROM categories WHERE cat_id = {$product_category_id} ");
    confirm($category_query);
    
    while($category_row = fetch_array($category_query)){
        
        
        
        return $category_row['cat_title'];
    }
    
}


function categories_add_product(){
    
         $query = query("SELECT * FROM categories");
    confirm($query);
    
    while($row = fetch_array($query)){
        
        
        
        $category_options = <<<hd
       
        <option value="{$row['cat_id']}">{$row['cat_title']}</option>
       
hd;
 
      echo $category_options;  
        
    }
}


/******* update product****/


function update_product(){
    
    if(isset($_POST['update'])){
    
        $product_title = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_price= escape_string($_POST['product_price']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc = escape_string($_POST['short_desc']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $product_image = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);
        
        if(empty($product_image)){
            
            
        $get_pic = query("SELECT product_image FROM products WHERE product_id = ".escape_string($_GET['id'])." "); 
            
            confirm($get_pic);
            
            while($pic = fetch_array($get_pic)){
                
                $product_image = $pic['product_image'];
                
            }
            
            
        }
        
        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        
        
       $query =  "UPDATE products SET ";
       $query .= "product_title = '{$product_title}'            , ";
       $query .= "product_category_id = '{$product_category_id}', ";
       $query .= "product_price = '{$product_price}'            , ";
       $query .= "product_description = '{$product_description}', ";
       $query .= "short_desc = '{$short_desc}'                  , ";
       $query .= "product_quantity = '{$product_quantity}'      , ";
       $query .= "product_image = '{$product_image}'              ";
       $query .= "WHERE product_id=" . escape_string($_GET['id']);
       
       $send_update_query = query($query);
       confirm($send_update_query);
       set_message("Product with id {$last_id} was Updated");
        
        
        redirect("index.php?products");
        
        
       
    
    
}

    }

/*********Category in admin *****************/

function show_categories_in_admin(){
    
    
    
$query =  query("SELECT * FROM categories");
confirm($query);
    
    while($row = fetch_array($query)){
        
        $cat_id = $row['cat_id'];
        $cat_tite = $row['cat_title'];
        
        
        $category = <<<hd
        
        
         <tr>
            <td>{$cat_id }</td>
            <td>{$cat_tite}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        
        
        
hd;
        
      echo   $category;
        
    }
    
    
}

function add_category(){
    
    
    
    if(isset($_POST['add_category'])){
        
        
     $cat_title = escape_string($_POST['cat_title']); 
        
         if(empty($cat_title) || $cat_title == " " ){
             
             
             echo "<p class='bg-danger'>its empty</p>";
             
             
         }else{
        
        $insert_cat = query("INSERT INTO categories (cat_title) VALUES('{$cat_title}') ");
        confirm($insert_cat);
        set_message("Category Added");
        
        
        
         }
    }
    
    
    
    
}
/**********admin users *****/


function display_users(){
    
    
    
$query =  query("SELECT * FROM users");
confirm($query);
    
    while($row = fetch_array($query)){
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $email = $row['email'];
        
        
        
        $user = <<<hd
        
        
           <tr>
                                        <td>{$user_id}</td>
                                        <td>{$username}</td>
                                        <td>{$email}</td>
                                        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                      
                                    </tr>
        
        
        
hd;
        
      echo   $user;
        
    }
    
}

function add_user(){
    
    if(isset($_POST['add_user'])){
        
        $username  = escape_string($_POST['username']);
        $email     = escape_string($_POST['email']);
        $password  = escape_string($_POST['password']);
        $user_photo= escape_string($_FILE['file']['name']);
        //$photo_temp= escape_string($_FILE['file']['tmp_name']);
       // move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);
        
        $query = query("INSERT INTO users(username, email, password) VALUES('{$username}', '{$email}', '{$password}')");
        confirm($query);
        
        set_message("User Added");
        
        redirect("index.php?users");
    }
    
    
    
}

function get_reports(){
    
    
     $query = query("SELECT * FROM reports");
    confirm($query);
    
    
    
    
    while($row = fetch_array($query)){
        
      
        
        $report = <<<hd
        <tr>
         <td>{$row['report_id']}</td>
        <td>{$row['product_id']}</td>
        <td>{$row['order_id']}</td>
        <td>{$row['product_price']}</td>
        <td>{$row['product_title']}</td>
        <td>{$row['product_quantity']}</td>
        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        
hd;
        
        
         echo $report;
        
        
    }
    
}

function get_shop_cart(){
    
    
    if(isset($_GET['add'])){
    
    
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    
    confirm($query);
    
    while($row = fetch_array($query)){
        
        
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){
            
            $_SESSION['product_' . $_GET['add']]+=1;
               
            redirect("../public/index.php");
               
       
            
            
            
        }else{
            
            
            set_message("we only have " . $row['product_quantity'] . " " . "{$row['product_title']}" ." available");
            redirect("../public/checkout.php");
            
            
        }
    }
    }
    
     $total=0;
    $item_quantity=1;
    $item_name = 1;
    $item_number=1;
    $amount=1;
    $quantity = 1;
    
    foreach($_SESSION as $name => $value){
        
        
        
        if($value > 0){
            
            
                 if(substr($name, 0, 8) == "product_"){
                     
                     $length = strlen($name - 8);
                     $id = substr($name, 8 , $length);
            
            
             $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
    confirm($query);
    
    
      //$query = query("SELECT * FROM products");
   // confirm($query);
    
    while($row = fetch_array($query)){
        
        $sub = $row['product_price']*$value;
        $item_quantity += $value;
        $product_image = display_image($row['product_image']);
        
        $product = <<<hd
        
      
        
        <div style="background-color:#e7e7e7; padding:5px; border:solid 3px #01ACC8; margin:5px;">
     
<div style=" margin:4%;">


        <span class="item">
        <span class="item-right">
                         <a style="font-size:10px; margin: 6px 0px; padding:5px; float:right; "class='btn' href="../resources/cart.php?delete={$row['product_id']}"><span " class='glyphicon glyphicon-remove'> </span></a>
                    </span>
                    <span class="item-left">
                        <img  style="margin:0px; width:80px; height:60px;" src="../resources/{$product_image}" />
                        <span class="item-info">
                            <span ><p style="margin:3px; color:black;font-weight:600; font-family: "Heebo",Arial,Helvetica,sans-serif;">{$row['product_title']}</p></span>
                            <span style="color:#B22222;" >&#36;{$row['product_price']}</span>
                            
                           
                            
                        </span>
                    </span>
                    
                </span>
             </div>
             
            
              
     </div>
   
                
hd;
        
      
        
        echo $product;
        

  
        
    }
                     
                 
            
        }   
            
            
        }
        
    }
    

}

function count_product(){
    
    
     if(isset($_GET['add'])){
    
    
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    
    confirm($query);
    
    while($row = fetch_array($query)){
        
        
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){
            
            $_SESSION['product_' . $_GET['add']]+=1;
               
            redirect("../public/index.php");
               
       
            
            
            
        }else{
            
            
            set_message("we only have " . $row['product_quantity'] . " " . "{$row['product_title']}" ." available");
            redirect("../public/checkout.php");
            
            
        }
    }
    }
    
     $total=0;
    $item_quantity=0;
    $item_name = 1;
    $item_number=1;
    $amount=1;
    $quantity = 1;
    
    foreach($_SESSION as $name => $value){
        
        
        
        if($value > 0){
            
            
                 if(substr($name, 0, 8) == "product_"){
                     
                     $length = strlen($name - 8);
                     $id = substr($name, 8 , $length);
            
            
             $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
    confirm($query);
        
      
        $item_quantity += $value;
       
    
            
        }   
            
            
        }
        
    }
    
    $product = <<<hd
        
     
{$item_quantity}
       
             
              
     
   
                
hd;
    
     echo $product;
        
    
    
    
} 

/***** slides function *****/

function add_slides(){
    
    if(isset($_POST['add_slide'])){
        
        
        $slide_title     = escape_string($_POST['slide_title']);
        $slide_image     = escape_string($_FILES['file']['name']);
        $slide_image_loc = escape_string($_FILES['file']['tmp_name']);
        
        
        if(empty($slide_title) || empty($slide_image)){
            
            
            echo "<p class='bg-danger'>This field cannot be empty</p>";
        
    }else { 
    
    
    
    move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);
    
        
        $query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
        confirm($query);
        set_message("Slide Added");
        redirect("index.php?slides");
        
        
        }
    

    }

}

function get_current_slide(){
    
     $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    
       while($row = fetch_array($query)){
        
        $slide_image = display_image($row['slide_image']);
        
        $slide_active_admin = <<<hd
        
        
         
         <img class="img-responsive" src="../../resources/{$slide_image}" alt="">
     
        
        
        
        
hd;
        
        echo $slide_active_admin;
    }
    
}






function get_active_slide(){
    
      $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    
    while($row = fetch_array($query)){
        
        $slide_image = display_image($row['slide_image']);
        
        $slide_active = <<<hd
        
        
         <div class="item active"> 
         <img style="width:100%; height:400px;"  class="slide-image" src="../resources/{$slide_image}" alt="">
          </div>
        
        
        
        
hd;
        
        echo $slide_active;
    }
    
    
    
    
}
function get_slides(){
    
    $query = query("SELECT * FROM slides");
    confirm($query);
    
    while($row = fetch_array($query)){
        
        $slide_image = display_image($row['slide_image']);
        
        $slides = <<<hd
        
        
         <div class="item" > 
         <img style="width:100%; height:400px;"  class="slide-image" src="../resources/{$slide_image}" alt="">
          </div>
        
        
        
        
hd;
        
        echo $slides;
    }
    
    
    
    
}

function get_slides_thumbnails(){
    
    
     $query = query("SELECT * FROM slides ORDER BY slide_id ASC");
    confirm($query);
    
       while($row = fetch_array($query)){
        
        $slide_image = display_image($row['slide_image']);
        
        $slide_thumb_admin = <<<hd
        
        
         
      <div class="col-xs-6 col-md-3">
    
    
    <a href="index.php?delete_slide_id={$row['slide_id']}">
        
        <img style=" width: 200px; height: 100px;
    margin-bottom:10px;" class="img-responsive slide_image image_container" src="../../resources/{$slide_image}">
          
        </a>
        
        <div class="caption"> 
    
    <p>{$row['slide_title']}</p>
    
    </div>
    
    </div>
    
    
     
        
        
        
        
hd;
        
        echo $slide_thumb_admin;
    }
    
    
}


?>