<?php require_once("./resources/config.php");  ?>


<?php include(TEMPLATE_FRONT . DS . "header.php") ?> 


    <!-- Page Content -->
   
        
    <div class="container">
        
        <div class="row carousel-holder">

                    <div class="col-md-12">

                      <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>
                        
                    </div>

                </div>
         <hr class="hr1">
                  <div class="top-header">
         <div class="text-center">
            <h2 style="direction:rtl;">ברוך הבא<br>לאופטיקאיה</h2>
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
         </div>
        </div>
    
       
          <hr class="hr1">
        
        
          <div class="col-md-12 con2">

            
          

            

         <?php include(TEMPLATE_FRONT . DS ."home-grid.php"); ?>
              
              
               

        </div>
        
         
        
         <div class="col-md-12 ">

             <hr class="hr1">
          
 
         <div class="text-center">
            <h2 style="direction:rtl;"> תעקבו אחרינו!</h2>
            
         </div>
      
            

          <hr class="hr1">

        </div>
        
        <div class="col-md-12 social-media ">
            
            <?php include(TEMPLATE_FRONT . DS ."social_media.php"); ?>
            
            
        
        </div>
        

    </div>



 
    <!-- /.container -->


    <?php include(TEMPLATE_FRONT . DS ."footer.php");?>
 
    
