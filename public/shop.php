<?php require_once("../resources/config.php");  ?>


<?php include(TEMPLATE_FRONT . DS . "header.php") ?> 





    <div class="container">
        
              <div class="top-header">
         <div class="text-center">
            <h2 style="direction:rtl;">ברוך הבא<br>לאופטיקאיה</h2>
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
         </div>
        </div>
        
        
    
         <hr class="hr1">

        <div class="row ">

            
          

<div class="row carousel-holder ">

                    <div class="col-md-10">

                      <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>
                        
                    </div>

                
            
  

                    <div class="col-md-2" >

                     <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
                        
                    </div>

             </div>
            

            <div class="col-md-9">

              
 <hr class="hr1">
                <div class="row">

                    <?php get_products(); ?>


                </div><!-- ROw ends here-->

            </div>

        </div>

    


</div>


  
 <?php include(TEMPLATE_FRONT . DS ."footer.php"); ?>