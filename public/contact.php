
<!-- Configuration-->

<?php require_once("../resources/config.php"); ?>


<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>


     <!--Navigation -->




         <!-- Contact Section -->

        <div class="container">
        <header class="j">
            
                       <div class="top-header">
         <div class="text-center">
            <h2 style="direction:rtl;">ברוך הבא<br>לאופטיקאיה</h2>
            <p style="direction:rtl;">תודה שאתה מצטרף אלינו !</p>
         </div>
        </div>
            </header>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" method="post">
                        
                        <?php  send_message(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject *" id="phone" required data-validation-required-message="Please enter your subject.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                        </div>
                        
                                <div id="success"></div>
                                <button  type="submit" name="submit" class="btn col-lg-4  btn-xxl btn-info">Send Message</button>
                            
                    </form>
                </div>
            </div>
        </div>

    
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>