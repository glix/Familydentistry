<?php
/*
Template Name: faq's
*/
	get_header();?>
</div>
<!-- <div id="content_wrapper" class=" appoint">
    <div class="inner">
       <div class="inner_wrapper">
       		
          

		   		<div>
		   			<form action="#" method="get">
		   			<table>
		   				
		   					<input type='hidden' name='faq' value='1' />
		   				<tr>
		   					<th><label for='faqname' >Name :</label></th>
		   					<td><input type='text' id="faqname" name='faqname' class="faqname" /></td>
						</tr>
						<tr>
		   					<th><label for='faqage' >Age :</label></th>
		   					<td><input type='text' id="faqage" name='faqage' class="faqage" /></td>
						</tr>
						<tr>
		   					<th><label for='faqque' >Ase Your Question :</label></th>
		   					<td><textarea id="faqque" name='faqque' class="faqque" /></textarea></td>
						</tr>
						<tr>
							<td><input style="float:right" type='submit' class='btn btn-success' name="faqsubmit" value="Submit"></td>
							<td><input style="float:left" type='reset' class='btn btn-success' name="faqreset" Value='Reset'></td>
						</tr>
					
					</table>	
					</form>		
				</div>
		   	</div>
		</div>
	</div>
</div>      	 -->


<div id="content_wrapper" class=" appoint">
    <div class="inner">
       <div class="inner_wrapper">
       		<h2 class="cufon"><?php echo the_title(); ?></h2>
       			<hr />
       		       		<div class="sidebar_content" style="position:relative;left:10px;width:660px ; margin-top:20px; width:650px">
       			<?php
       				$val =0;
       				wp_reset_query();
					$mypost = array( 
						'post_type' => 'faq',
						'posts_per_page' => 10
					);
   					 $loop = new WP_Query( $mypost ); ?>
   					<!--   // debug($loop);exit(); -->
   					 <table class="faqtable">

   				<?php while ( $loop->have_posts() ) : $loop->the_post(); $val++ ?>
   					
   					<tr class="question">		
						<th> Question :</th><td style="padding-top:15px;"><a href=""><span style=" color:#222;font-family:Arial,​​Verdana,​​sans-serif "><?php echo the_title(); ?> ?</span> </a>
						<span style="font-size:12px;">Asked By : <?php echo  get_post_meta($post->ID, 'name', TRUE); ?></span>
					</td></tr>
                   
                    
                     <tr class="answer">
                        <th style="color:green">Answer :</th>
                        <td style="margin-top:10px;"><a href=""><span style=" color:#222;font-family:	Arial,​​Verdana,​​sans-serif ">
                        	<?php
                        	 if(get_the_content()==""){
                        		if (current_user_can("manage_options")) {?>
      								<a class="btn btn-small faqreply" name="faqreply" id="faqreply<?php echo $val ?>">Reply</a>
      								<div class="faqanswerbox <?php echo get_the_ID() ?>">
      									<form method="post" action="<?php echo curPageURL(); ?>">
      									<input type="hidden" value="1" name="faqans" />	
      									<input type="hidden" value="<?php echo  get_the_ID() ?> " name="faqid" />
      									<textarea class="faqtext"cols="80" name="faqreplynanswer" ></textarea>
      									<input type="submit" class="btn btn-success btn-small" name="faqanswersubmit" value="Submit Answer">
      								</form>
      								</div>
								<?php }else{
									echo "<p>There Have No Answer yet</p> ";

								}

                        	 }else{
                        	 	echo the_excerpt("Read More");
                        	 	 ?>.</span> </a>
                        	 	 <span style="float:right;font-size:12px;margin-top:2px;">Submit By :
								<?php $user_info = get_userdata(1);
      								echo $user_info->user_login ;
    								  echo $user_info->user_level ;
     								 echo  $user_info->ID ;
     								 ?>	
     						</span>
						</td>
					</tr>
						

						<?php } ?>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</table>
				<div style="margin-top:50px; width:640px">
				<hr style="clear:both;" />
				<h5 style="margin:20px; float:left">Ask Your Own Question <hr style="margin-top:5px;clear:both;" /></h5>
				<form  style="clear:both; "name="contact" id="faq_form"  action="<?php echo curPageURL(); ?>" method="post">
					<table cellspacing="20">
			    		<tbody>
			    			<tr>
			    				<input type="hidden" name="faqvalue" value="1" >
			    				<th><label for="Yname"><strong>Name :</strong> </label></th>
			    				<td><input size="80" style="width:450px;" id="Yname" class="notEmpty" type="text" name="yname" placeholder=" Enter Your Name" /></td>
			    			</tr>
			    			<tr>
			    				
			    				<th><label for="Yemail"><strong>Email :</strong> </label></th>
			    				<td><input size="80" style="width:450px;" id="Yemail" class="notEmpty" type="text" name="yemail" placeholder=" Enter Your Email" /></td>
			    			</tr>
			    			<tr class="noborder">
			    				<th><label for="faqs"><strong>Your Question :</strong> </label></th>
			    				<td><textarea style="height:50px; width:450px;" cols="20" id="faqs" name="faqs" class="notEmpty" placeholder="Ask Your Question" ></textarea></td>
			    			</tr>
			    		
			    			<tr class="noborder" style="margin-top:15px">
			    		
			    				<td><button style="float:right ; " type="submit" name="submit" value="submit" id="submit" class="btn btn-success">Submit</button></td>
			    				<td><button style="float:left ; "class="btn btn-success" name="reset"  type="Reset">Reset</button></td>
			    			</tr>
			    		</tbody>
			    	</table>
			    </form>
			</div>
		</div>
		<div class="faqsidebar" style="width:250px;margin-top:15px;float:right">
			<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
				<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
					<div class="content">
					
							<?php get_sidebar(); ?>
						
					</div>
				</div>	
		</div>	
		<br class="clear">	
						
			   
	</div>
</div>

<?php get_footer(); ?>	
	