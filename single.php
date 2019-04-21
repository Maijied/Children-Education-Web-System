<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])) {
	header("location: index.php");
}
else {
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles/home_style.css" media="all" />
	</head>
	
	<body>
		<div class="container">
			<div id="head_wrap">
				<div id="header">
					<ul id="menu">
						<li><a href="home.php">HOME</a></li>
						<li><a href="members.php">MEMBERS</a></li>
						<li><a href="topic.php">TRENDING</a></li>
						<?php
						$get_topics="select * from topics";
						$run_topics=mysqli_query($con,$get_topics);
						while($row = mysqli_fetch_array($run_topics)){
							$topic_id=$row['topic_id'];
							$topic_title=$row['topic_title'];
							echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
						}
						
						?>
					</ul>
					<form method="get" action="results.php" id="form1">
						<input type="text" name="user_query" placeholder="search a topic" />
						<input type="submit" name="search" value="search" />
					</form>
				</div>
			</div>
			<div class="content">
				<div id="user_timeline">
					<div id="user_details">
					<?php
					$user=$_SESSION['user_email'];
					$get_user="select * from users where user_email='$user'";
					$run_user=mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);
					$user_id=$row['user_id'];
					$user_name=$row['user_name'];
					$user_country=$row['user_country'];
					$user_image=$row['user_image'];
					$register_date=$row['register_date'];
					$last_login=$row['last_login'];
					echo " 
						<center><img src= 'user/user_images/$user_image' width='200' height='200' /></center>
					
						<div id='user_mention'>
						<p><strong>Name:</strong> $user_name</p>
						<p><strong>Country:</strong> $user_country</p>
						<p><strong>Last Login:</strong> $last_login</p>
						<p><strong>Member Since:</strong> $register_date</p>
						
						<p><a href='my_messages.php'>Messages</a></p>
						<p><a href='my_posts.php'>My Posts</a></p>
						<p><a href='Edit Profile.php'>Edit My Account</a></p>
						<p><a href='logout.php'>Logout</a></p>
						</div>
					";
					?>
					</div>
				</div>
				<div id="content_timeline">
					
					
					<h3>Most Recent Discussions:</h3>
					<?php single_post(); ?>
					
				</div>
			</div>
		</div>
	</body>





</html>
<?php } ?>