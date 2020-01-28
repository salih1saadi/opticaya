<?php require_once("../resources/config.php");  ?>


<?php include(TEMPLATE_FRONT . DS . "header.php") ?> 



  <div class="container">
      
      

      <header>
          <div class="sidenav">
         <div class="login-main-text">
            <h2 style="direction:rtl;">ברוך הבא<br>לאופטיקאיה</h2>
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
             
            
             
         </div>
            
      </div>
          
          
         
          
       <div class="main">
           <div class="top-header">
         <div class="text-center">
            
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
         </div>
        </div>
           
         <div class="col-md-6 col-sm-12">
                       <h5 style="color:red;" class="text-center"><?php  display_message(); ?></h5>

            <div class="login-form">
               <form class="" action="" method="post" enctype="multipart/form-data" >
                   
                     <?php register(); ?>
                  <div class="form-group">
                     <label style="direction:rtl;">שם משתמש</label>
                     <input type="text" class="form-control" name="username"  placeholder="User Name">
                  </div>
                   <div class="form-group">
                     <label style="direction:rtl;">כתובת מייל</label>
                     <input type="text" class="form-control" name="email"  placeholder="User Email">
                  </div>
                  <div class="form-group">
                     <label style="direction:rtl;">סיסמה</label>
                     <input type="password"  class="form-control" name="password" placeholder="Password">
                  </div>
                  <button type="submit" name="add" class="btn btn-black" style="direction:rtl;">הרשמה</button>
                     <a href="login_modal.php"  class="btn btn-black" style="direction:rtl;">התחבר</a>
                  
               </form>
            </div>
         </div>
      </div>


    </header>


        </div>
    

 <?php include(TEMPLATE_FRONT . DS ."footer.php"); ?>

  