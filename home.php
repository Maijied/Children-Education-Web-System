<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
	header("location:index.php");
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
						<li><a href="group.php">GROUPS</a></li>
						<li><a href="topic.php" class="topic" name="topic">TRENDING</a></li>
						<?php
						$get_topics="select * from topics";
						$run_topics=mysqli_query($con,$get_topics);
						while($row=mysqli_fetch_array($run_topics)){
							$topic_id=$row['topic_id'];
							$topic_title=$row['topic_title'];
							echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
						}
						
						?>
					</ul>
					<form method="get" action="results.php" id="form1">

						<input type="text" class="searchtopic" name="user_query" style="height: 35px; border-radius: 5px; font-size: 15px; box-shadow: 0 2px #999; font-family: Garamond; padding-top: 4px; " placeholder="   Search A Topic" />
						<input type="submit" class="button" name="search" value="search" />
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

					$user_posts = "select * from posts where user_id='$user_id'";
					$run_posts = mysqli_query($con,$user_posts);
					$posts = mysqli_num_rows($run_posts);
					echo " 
						<center><img src= 'user/user_images/$user_image' width='200' height='200' /></center>
					
						<div id='user_mention'>
						<p><strong>Name:</strong> $user_name</p>
						<p><strong>Country:</strong> $user_country</p>
						<p><strong>Last Login:</strong> $last_login</p>
						<p><strong>Member Since:</strong> $register_date</p>
						
						<p><a href='my_messages.php?u_id=$user_id'>Messages</a></p>
						<p><a href='my_posts.php?u_id=$user_id'>My Posts ($posts)  </a></p>
						<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p> 
						<p><a href='logout.php'>Logout</a></p>
						</div>
					";
					?>
					</div>
				</div>
				<div id="content_timeline">
					<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f">
					<h2 style="font-family: courier;" >Discuss your issues:</h2></br>
					<input type="text" name="title" placeholder="Write a Title.." size="95"  required="required"><br/>
					<textarea cols="83" rows="4" name="content" placeholder="Write Description..." ></textarea>
					<select name="topic">
						<option>Post Type</option>
						<?php getTopics(); ?>
					</select>
					<input type="submit" name="sub" value="Post to Timeline" />
					</form><br>
					<?php  insertPost(); ?>
					
					
					<h3 style="font-family: courier;" >Most Recent Discussions:</h3><br>
					<b><?php get_posts(); ?></b>
					
				</div>
			</div>
		</div>
	</body>





</html>
<?php } ?>