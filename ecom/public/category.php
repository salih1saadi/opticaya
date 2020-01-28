<?php require_once("../resources/config.php");  ?>


<?php include(TEMPLATE_FRONT . DS . "header.php") ?> 


    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="j">
                       <div class="top-header">
         <div class="text-center">
            <h2 style="direction:rtl;">ברוך הבא<br>לאופטיקאיה</h2>
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
         </div>
        </div>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            
            <div class="col-lg-10 text-center">
                 <?php  product_category(); ?>  
            </div>
             <div class="col-md-2" >

                     <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
                        
                    </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
       
        <!-- /.row -->

  

        <!-- Footer -->
       

    </div>
    <!-- /.container -->
 <?php include(TEMPLATE_FRONT . DS ."footer.php"); ?>