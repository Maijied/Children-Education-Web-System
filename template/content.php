<!--content Area starts--> 

    <div id="content">
       <div>
       	<img src="images/image.png" style="float: left;margin-left: 220px; padding-top: 50px; height: 400px;" />
       </div>
       <div id="form2">
       	<form action="" method="post">
       	<h2>Sign Up Here</h2>
       	<table>
       		<tr>
       			<td align="right">Name:</td>
       			<td>
       				<input type="text" name="u_name" placeholder="Enter Your Name" required="required"/>
       			</td>
       		</tr>

           <tr>
       			<td align="right">Password:</td>
       			<td>
       				<input type="password" name="u_pass" placeholder="Enter Your Password" required="required"/>
       			</td>
       		</tr>
       		<tr>
       			<td align="right">Email:</td>
       			<td>
       				<input type="email" name="u_email" placeholder="Enter Your Email" required="required"/>
       			</td>
       		</tr>
       		<tr>
       			<td align="right">Country:</td>
       			<td>
       				<select name="u_country" required="required">
       					<option>Select A Country</option>
       					<option>Afganistan</option>
       					<option>Bangladesh</option>
       					<option>India</option>
       					<option>Pakistan</option>
       					<option>United States</option>
       					<option>United Arab Emirates</option>
       				</select>
       			</td>
       		</tr>
       		<tr>
       			<td align="right">Gender:</td>
       			<td><select name="u_gender" required="required">
       					<option>Select A Gender</option>
       					<option>Male</option>
       					<option>Female</option>

       				</select>
       			</td>
       		</tr>
       		<tr>
       			<td align="right">Birthday:</td>
       			<td>
       				<input type="date" name="u_birthday" required="required" />
       			</td>
       		</tr>
       		<tr>
       			
       			<td colspan="6">
       				<button class="button" name="sign_up" style="margin-left: 130px;margin-top: 30px;">Sign Up</button>
                              
       			</td>
       		</tr>

       	</table>
       		
       	</form>
       	<?php 

            include("user_insert.php");

            ?>
       </div>
 	
 </div>
 <!--Content Area ends-->