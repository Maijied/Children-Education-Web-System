<?php
	$con=mysqli_connect("localhost","root","","justice") or die("Connection was not Established");
	function getTopics(){
		global $con;
		$get_topics="select * from topics";
		$run_topics=mysqli_query($con,$get_topics);
		while($row = mysqli_fetch_array($run_topics)){
			$topic_id=$row['topic_id'];
			$topic_title=$row['topic_title'];
			echo "<option value='$topic_id'>$topic_title</option>";
		}
	}
	function insertPost(){
		
		if(isset($_POST['sub'])){
			global $con;
			global $user_id;
			$title=addslashes($_POST['title']);
			$content=addslashes($_POST['content']);
			$topic=$_POST['topic'];
			if($content==''){
				echo "<h2>please enter topic description</h2>";
				exit();
			}
			else{
			$insert="insert into posts
			(user_id,topic_id,post_title,post_content,post_date) values
			('$user_id','$topic','$title','$content',NOW())";
			$run= mysqli_query($con,$insert);
			if($run){
				
				
				$update="update users set posts='yes' where user_id='$user_id'";
				$run_update=mysqli_query($con,$update);
			}
			}
		}
	}
	
	
	function get_posts(){
		
		global $con;
		$per_page=5;
		
		if(isset($_GET['page'])){
			$page= $_GET['page'];
			
		}
		else{
			$page=1;
		}
		
		$start_from=($page-1)* $per_page;
		$get_posts="select * from posts ORDER BY 1 DESC LIMIT $start_from,$per_page";
		$run_posts=mysqli_query($con,$get_posts);
		
		while($row_posts=mysqli_fetch_array($run_posts)){
			
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$post_title=$row_posts['post_title'];
			$content=$row_posts['post_content'];
			$post_date=$row_posts['post_date'];
      $topic_id=$row_posts['topic_id'];
      if($topic_id==2) {
			
			$user="select * from users where user_id='$user_id' and posts='yes'";
			
			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			
			echo " <div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
			<h4>$post_title</h4>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;' ><button >See replies or Reply to this</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Vote Down</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button >Vote Up</button></a>
			</div><br/>
			
			
			";
    }
    else if($topic_id==1) {
      $user="select * from users where user_id='$user_id' and posts='yes'";
      $s=$post_id;
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name="Anonymous".$s;
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/default.jpg' width='50' height='50'></p>
      <h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
      <h4>$post_title</h4>
      <p>$post_date</p>
      <p>$content</p>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>See replies or Reply to this</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Vote Down</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Vote Up</button></a>
      </div><br/>
      
      
      ";
			
		}
  }
		
		include("pagination.php");
    }
		
	function single_post(){
		if(isset($_GET['post_id'])){
			global $con;
			$get_id=$_GET['post_id'];
			$get_posts="select * from posts where post_id='$get_id'";
		$run_posts=mysqli_query($con,$get_posts);
		
		$row_posts=mysqli_fetch_array($run_posts);
			
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$post_title=$row_posts['post_title'];
			$content=$row_posts['post_content'];
			$post_date=$row_posts['post_date'];
			
			$user="select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
      $user_image = $row_user['user_image'];
				$user_com=$_SESSION['user_email'];
					$get_com="select * from users where user_email='$user_com'";
					$run_com=mysqli_query($con,$get_com);
					$row_com=mysqli_fetch_array($run_com);
					$user_com_id=$row_com['user_id'];
					$user_com_name=$row_com['user_name'];
			
			
		
			
			echo " <div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
			<h4>$post_title</h4>
			<p>$post_date</p>
			<p>$content</p>
			
			</div>
      ";

      include ("comments.php");

      echo "
			
			
			<form action='' method='post' id='reply'>
			<textarea cols='50' rows='5' name='comment' placeholder='write your reply'> </textarea><br/>
			<input type='submit' name='reply' value='Reply to this'/>

			</form>

			
			";
      
        if(isset($_POST['reply'])){
        $comment=$_POST['comment'];
        $insert="insert into comments (post_id,user_id,comment, comment_author,  date) values ('$post_id','$user_id','$comment', '$user_com_name', NOW()) ";
        $run=mysqli_query($con,$insert);
        
        echo "<h2> Your Reply was added!</h2>";
        echo '<meta http-equiv="refresh" content="0">';
        
      }
		}
		
	}


  function get_Cats(){
    
    global $con;
    $per_page=5;
    
    if(isset($_GET['page'])){
      $page= $_GET['page'];
      
    }
    else{
      $page=1;
    }
    
    $start_from=($page-1)* $per_page;

    if(isset($_GET['topic']))
    {
      $topic_id = $_GET['topic'];
    }

    $get_posts="select * from posts where topic_id='$topic_id' ORDER BY 1 DESC LIMIT $start_from,$per_page";
    $run_posts=mysqli_query($con,$get_posts);
    
    while($row_posts=mysqli_fetch_array($run_posts)){
      
      $post_id=$row_posts['post_id'];
      $user_id=$row_posts['user_id'];
      $post_title=$row_posts['post_title'];
      $content=$row_posts['post_content'];
      $post_date=$row_posts['post_date'];
      
      $user="select * from users where user_id='$user_id' and posts='yes'";
      
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name=$row_user['user_name'];
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/$user_image' width='50' height='50'></p>
      <h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
      <h4>$post_title</h4>
      <p>$post_date</p>
      <p>$content</p>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>See replies or Reply to this</button></a>
      </div><br/>
      
      
      ";
      
    }
    
    include("pagination.php");
    
  }

  //function for getting search results

   function GetResults(){
    
    global $con;
    
    
    

    if(isset($_GET['user_query']))
    {
      $search_term = $_GET['user_query'];
    }
    

    $get_posts="select * from posts where post_title LIKE '%$search_term%' ORDER BY 1 DESC LIMIT 5";
    $run_posts=mysqli_query($con,$get_posts);

    $count_result = mysqli_num_rows($run_posts);

    if($count_result==0){
      echo "<h3 style='background:black; color:white; padding:10px;'>Sorry, we do not have results for this keyword. </h3>";
      exit();
    }
    
    while($row_posts=mysqli_fetch_array($run_posts)){
      
      $post_id=$row_posts['post_id'];
      $user_id=$row_posts['user_id'];
      $post_title=$row_posts['post_title'];
      $content=$row_posts['post_content'];
      $post_date=$row_posts['post_date'];
      
      $user="select * from users where user_id='$user_id' and posts='yes'";
      
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name=$row_user['user_name'];
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/$user_image' width='50' height='50'></p>
      <h6><a href='user_profile.php?user_id=$user_id' >$user_name</a></h6>
      <h6>$post_title</h6>
      <p><h6>$post_date</h6></p>
      <p><h6>$content</h6></p>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>See replies or Reply to this</button></a>

      </div><br/>
      
      
      ";
      
    }
    
    
    
  }

  function user_posts()
  {
    
    global $con;
   if (isset($_GET['u_id'])) 
   {
     $u_id = $_GET['u_id'];
   }
    $get_posts="select * from posts where user_id='$u_id' ORDER BY 1 DESC LIMIT 5";
    $run_posts=mysqli_query($con,$get_posts);
    while($row_posts=mysqli_fetch_array($run_posts)){
      
      $post_id=$row_posts['post_id'];
      $user_id=$row_posts['user_id'];
      $post_title=$row_posts['post_title'];
      $content=$row_posts['post_content'];
      $post_date=$row_posts['post_date'];
      
      $user="select * from users where user_id='$user_id' and posts='yes'";
      
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name=$row_user['user_name'];
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/$user_image' width='50' height='50'></p>
      <h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
      <h4>$post_title</h4>
      <p>$post_date</p>
      <p>$content</p>
      
      <a href='functions/delete_post.php?post_id=$post_id' style='float:right;' ><button>Delete</button></a>
      <a href='edit_post.php?post_id=$post_id' style='float:right;' ><button>Edit</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Reply</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>View</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Vote Down</button></a>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>Vote Up</button></a>
      


      </div><br/>
      ";
      include("delete_post.php");
      
    }
    
   
    
  }




  function get_posts1(){
    
    global $con;
    $per_page=5
    ;
    
    if(isset($_GET['page'])){
      $page= $_GET['page'];
      
    }
    else{
      $page=1;
    }
    
    $start_from=($page-1)* $per_page;
    $get_posts="select * from posts where group_id=1 ORDER BY 1 DESC LIMIT $start_from,$per_page";
    $run_posts=mysqli_query($con,$get_posts);
    
    while($row_posts=mysqli_fetch_array($run_posts)){
      
      $post_id=$row_posts['post_id'];
      $user_id=$row_posts['user_id'];
      $post_title=$row_posts['post_title'];
      $content=$row_posts['post_content'];
      $post_date=$row_posts['post_date'];
      $topic_id=$row_posts['topic_id'];
      if($topic_id==2) {
      
      $user="select * from users where user_id='$user_id' and posts='yes'";
      
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name=$row_user['user_name'];
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/$user_image' width='50' height='50'></p>
      <h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
      <h4>$post_title</h4>
      <p>$post_date</p>
      <p>$content</p>

      <a href='single.php?post_id=$post_id' style='float:right;' ><button>See replies or Reply to this</button></a>
      </div><br/>
      
      
      ";
    }
    else if($topic_id==1) {
      $user="select * from users where user_id='$user_id' and posts='yes'";
      $s=$post_id;
      $run_user=mysqli_query($con,$user);
      $row_user=mysqli_fetch_array($run_user);
      $user_name="Anonymous".$s;
      $user_image=$row_user['user_image'];
      
      echo " <div id='posts'>
      <p><img src='user/user_images/default.jpg' width='50' height='50'></p>
      <h3><a href='user_profile.php?user_id=$user_id' >$user_name</a></h3>
      <h4>$post_title</h4>
      <p>$post_date</p>
      <p>$content</p>
      <a href='single.php?post_id=$post_id' style='float:right;' ><button>See replies or Reply to this</button></a>

      </div><br/>
      
      
      ";
      
    }
  }
    
    include("pagination.php");
    
  }
?>