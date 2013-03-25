 <?php
/*
Template Name: appointment-form
*/

	get_header();

	?>
</div>
<div id="content_wrapper" class=" appoint">
    <div class="inner">
       <div class="inner_wrapper">
       		 <div class="inner-wrapper" >
            	<div class="appointmenttitle"><h2 class="cufon"><?php echo the_title(); ?></h2></div>
					 <div class="appiontmentform">
						<form name="contact" id="appiontment_form"  action="<?php echo curPageURL(); ?>" method="get">
					    	<table cellspacing="20">
					    		<tbody>
					    			<tr>
					    				<input type="hidden" name="apoint" value="1" >
					    				<th><label for="firstname"><strong>First Name :</strong> </label></th>
					    				<td><input size="80"id="firstname"class="notEmpty" type="text" name="firstname" placeholder=" Enter Your FirstName" /></td>
					    			</tr>
					    			<tr>
					    				<th><label for="lastname"><strong>Last Name :</strong> </label></th>
					    				<td><input  id="lastname" class="notEmpty" type="text" name="lastname" placeholder="Enter Your LastName" /></td>
					    			</tr>	
					    			<tr>
					    				<th><label for="age"><strong>Age :</strong> </label></th>
					    				<td><input type="text" id="age" class="notEmpty" name="age" placeholder="Enter Your Age" /></td>
					    			</tr>
					    			<tr>
					    				<th><label for="address"><strong>Address :</strong> </label></th>
					    				<td><textarea rows="3" cols="10" id="address" name="address" class="notEmpty" placeholder="Address" ></textarea></td>
					    			</tr>
					    			<tr>
					    				<th><label for="phonenumber"><strong>Phone Number :</strong> </label></th>
					    				<td><input type="text" id="phonenumber" class="notEmpty" name="phonenumber" Placeholder="Contact Number"/></td>
					    			</tr>
					    			<tr>
					    				<th><label for="emailid"><strong>Email Id :</strong></label></th>
					    				<td><input type="text" name="emailid" class="notEmpty" name="emailid" Placeholder="Enter Email ID" /></td>
					    			</tr>
					    			<tr class="noborder">
					    				<th><label for="date"><strong>Date For Appointment :</strong></label></th>
					    				<td><input type="text" name="date" class="notEmpty datepicker-contact " id="datepicker" name="date" Placeholder="Select a Date" /></td>
					    			</tr>
					    			<tr class="noborder">
					    				<td><button style="float:right ; " type="submit" name="submit" value="submit" id="submit" class="btn btn-success">Submit</button></td>
					    				<td><button style="float:left ; "class="btn btn-success " name="reset"  type="Reset">Reset</button></td>
					    			</tr>
					    		</tbody>
					    	</table>
					    </form>
					</div>
   				</div>	
   			</div>
   	</div>
   		<?php get_footer(); ?>	
