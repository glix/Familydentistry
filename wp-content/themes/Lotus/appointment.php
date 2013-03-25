<?php
/*
Template Name: appointment
*/
get_header();?>

</div>
<div id="content_wrapper" class=" appoint">
    <div class="inner">
       <div class="inner_wrapper">
            <div class="inner-wrapper appointmentback appointment" style="background:url(images/appointment_bg.png);">
                <div class="appointmenttitle"><h2 class="cufon"><?php echo the_title(); ?></h2></div>
                <div class="left_side">
                    <form>
                        
                    <label class="inline "> 
                     Monday
                    <input type="radio" name="OptionRadios" id="optionRadios1">
                   
                    </label >
                    <label class="inline ">  
                     Tuesday
                    <input type="radio" name="OptionRadios" id="optionRadios2" />
                   
                    </label>
                    <label class="inline ">
                    Wednesday
                    <input type="radio" name="OptionRadios" id="optionRadios4"  />
                    
                    </label>
                    <label class="inline">
                     Thrusday
                    <input type="radio" name="OptionRadios" id="optionRadios5"  />
                   
                    </label>
                    <label class="inline">
                     Friday
                    <input type="radio" name="OptionRadios" id="optionRadios6"   />
                   
                    </label>
                    <label class="inline">
                     Saturday
                    <input type="radio" name="OptionRadios" id="optionRadios7"  />
                   
                    </label>
                    <label class="inline">
                    Sunday
                    <input type="radio" name="OptionRadios" id="optionRadios3" />
                    
                    </label>
                </form> 
            </div> 
            <div class="right_side">
                <div class="data name">
                    <h5><?php  ?></h5>
                </div>
                <div class="inner_right">
                   <h5>HAS AN APPOINTMENT ON</h5>
                </div>
                <div class="inner_right date">
                    <h5><?php echo $date ?>
                </div>
                <div class="inner_right time">
                    <h5><?php ?></h5>
                </div>
               </div> 
            <div class="appointlogo">
                <div class="logo">
                        <!-- Begin logo -->
                    
                        <?php
                            //get custom logo
                            $pp_logo = get_option('pp_logo');
                            
                            if(empty($pp_logo))
                            {
                                $pp_logo = get_bloginfo( 'stylesheet_directory' ).'/images/logo.png';
                            }
                            else
                            {
                                $pp_logo = get_bloginfo( 'stylesheet_directory' ).'/cache/'.$pp_logo;
                            }

                    ?>

                        
                        <a id="custom_logo" href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
                        
                        <!-- End logo -->
                    </div>
            <div style="padding:40px;padding-right:0">
                <span>If unable to keep appointment kindly give 24 hours notice</span>
        </div>
        
    </div>
</div>
</div>

<?php get_footer(); ?>