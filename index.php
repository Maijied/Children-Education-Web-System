


<?php
session_start();
 
include("functions/functions.php");
//include("template/header.php");
//include("template/content.php");
//include("template/footer.php");
include("login.php");


?>

<!DOCTYPE html>
<html>
<head>
      <title>Justice For All</title>
      <link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
</head>
<body>

   <!--container starts-->

   <div class="container">

   <!--Head wrap starts-->
      <div id="head_wrap">

      <!--Headers starts-->
      <div id="header">
      
      
       <form method="post" action="" id="form1">
            <!--<strong>Email:</strong>-->
            <input type="email" name="email" placeholder="Email" required="required" />
            <!--<strong>Password:</strong>-->
            <input type="password" name="pass" placeholder="Password" required="required" />
              <button class="button" name="login">Login</button>
            
       </form>
            
      </div>      

      <!--Headers ends-->
      </div>
 <!--Head wrap ends-->


 <!--content Area starts--> 

    <div id="content">
       
      
       <div id="form2">
            <form action="" method="post">
            <h2></h2>
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

  <div id="footer">
      <footer class="container-fluid text-center">
<p>Developed By MajhiOla Team</p>
  <a href="contact.html" style="color: #E6E6FA;">Contact With Us</a>
</footer>
 </div>

</div>
<!--container ends-->
</body>
</html>



    

