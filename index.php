<?php 
include 'usersmngt.php';
include 'postscommentsmngt.php';



if (isset($_SESSION['id'])) {
	$uid = $_SESSION['id'];
}


?>
<!DOCTYPE html>
<html>
<head>
	<title> FORUM </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript">
	function register(){

	}
	
	</script>
</head>
<body>
	<div id="mySidenav" class="sidenav">
	  <a href="#" id="about"> Ask Question + </a>
	  <a href="#" id="blog"> Forum </a>
	  <a href="#" id="projects">Message</a>
	  
	  <?php
	  if (isset($_SESSION['id'])){
	  ?>
	  <a href="index.php?logout=logout" id="contact">LOGOUT</a>
	  <?php } ?>
	</div>

	<div id="wholediv">
		<div class="container" id="fcon">	
			<div class="row" id="firstrow" style="">
				<div class="col-sm-8" id="newtop">
					<br><br>
					<form action="" method="post">
					<div class="form-group">
						<?php if (isset($_SESSION['id'])) { ?>
						<input type="text" id="uid" name="uid" value="<?php echo $uid; ?>">
						<?php }else{ ?>
						<input type="text" name="uid" value=" ">
						<?php } ?>
						<label class="">  Topic Subject </label>
						<input type="text" id="subject" class="form-control" name="subject" placeholder="">
					</div>
					<div class="form-group">
						<label class="">  Topic Category </label>
						<select class="form-control" name="category" id="category">
							<option ></option>
						    <option value="HTML"> HTML </option>
						    <option value="CSS"> CSS  </option>
						    <option value="JS"> JS   </option>
						    <option value="PHP"> PHP  </option>
						</select>
					</div>					
					<div class="form-group">
						<label class=""> Topic Description </label>
						<textarea id="description" class="form-control" name="description" placeholder="">
						</textarea>
						
					</div>
 					<button type="submit" class="btn btn-dark float-right" id="submitPost" name="submitPost"> POST </button>	
 					</form>
				</div>
				<!-- --------- DIV LOGIN AND REGISTER ------------- -->
				<?php if (!isset($_SESSION['id'])) { ?>
				<div class="col-sm-3 loginReg" id="signup" style="display: none;">

					<form action="" method="post">
					<span class="text-center">  </span>
					<div class="form-group mt-1">
						<span class=""> Fullname </span>
						<input type="text" id="fullname" class="form-control" name="fullname" placeholder="Full Name">
						
					</div>
					<div class="form-group">
						<span class=""> Username</span>
						<input type="text" id="username" class="form-control" name="username" placeholder="First Name">					
					</div>
					<div class="form-group">
						<span class=""> Email</span>
						<input type="text" id="email" class="form-control" name="email" placeholder="First Name">
					</div>		
					<div class="form-group">
						<span class=""> Password</span>
						<input type="password" id="password" class="form-control" name="password" placeholder="First Name">
					</div>	
					<button type="submit" name="submitReg" class="form-control"> SIGN UP </button>	
					<small> Back To Login <a style="color: #0366d6;" id="loginLG">Register</a></small>
					</form>
				</div>
				<div class="col-sm-3 loginReg" id="login" >
					<span class="text-center"> </span>
					<form action="" method="post">
					<div class="form-group mt-3">
						<span class=""> Username or Email Address </span>
						<input type="text" id="useroremail" class="form-control" name="useroremail" placeholder="">
						
					</div>
					<div class="form-group">
						<span class=""> Password </span>
						<input type="password" id="pass" class="form-control" name="pass" placeholder="">					
					</div>
					
					<button type="submit" name="submitLog" class="form-control"> LOGIN </button>	
					<small> Don't have an account?<a style="color: #0366d6;" id="register"> Create Account </a></small>
					</form>
				</div>
				<?php } ?>

		
				<!-- <div class="row" id="logRegDiv">
			
				</div> -->
			</div>
		</div>
		
		<div class="container" id="scon">
			<div class="row" id="secondrow">
				<div class="col-sm-8" id="posts">
				<div class="form-group">
				  <label for="sel1">Category:</label>
				  <select class="form-control" id="sel1">
			  		<option> HTML </option>
				    <option> CSS  </option>
				    <option> JS   </option>
				    <option> PHP  </option>
				  </select>
				</div>
				<?php 
				if (!isset($_GET['name'])) {
				 ?>
				<div class="col-lg-8" id="tablePosts">
					<table class="table table-hover">
					  <thead>
					    <tr>
					      <th colspan="3"> Recent </th>				
					    </tr>
					  </thead>
					  <tbody id="forumTb">
				  		<?php 
							$myrow = $postcomment->display_posts('posts','user_info');
							foreach ($myrow as $row) {	
							$var = $row['date_posts'];
							//remove / or -
							$date = str_replace('/', '-', $var);
							//format date by month day yeae	
							$date_post = date("M j, Y h:i a", strtotime($date));			
						?>
						<tr>
							<td style="width: 70px;"><img src="assets/images/user.jpg" style="  width: 50px;height: 50px;">
							<input type="hidden" name="" id="postsId" value="<?php echo $row['id_posts']; ?>">
							</td>
							<td>

								<a class="subjects" href="index.php?name=1&subj=<?php echo $row['subject_posts'];?>" target=""><b><?php echo ucwords($row['subject_posts']);?></b></a>							
								<br><small>
								<?php echo ucfirst($row['fullname']); ?> • <?php echo $date_post; ?></small>
							</td>
							<td></td>
						</tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				<?php }else { ?>
				<div class="col-lg-7" id="selectedPost">
					<button id="sp-back">back</button>
					<form action="" method="post">
					
					<?php
					 if (isset($_REQUEST['name'])) {
						$subject = $_REQUEST['name'];
						$subject = $_REQUEST['subj'];
						
						$myrow2 = $postcomment->display_clicked_posts('posts','user_info',$subject);
						foreach ($myrow2 as $row2) {	
						$idpost = $row2['id_posts'];
					 ?>
					 
					 <!-- <h1>Subject</h1> -->
					 <input type="hidden" id="idofpost" value="<?php echo $row2['id_posts'];?>" name="">
					
					 <table class="table table-bordered">
					 	<tr>
					 		<td style="width: 70px;">
					 			<img src="assets/images/user.jpg" style="  width: 70px;height: 100px;"><br><br>
					 			<small><?php echo ucfirst($row2['fullname']); ?></small>
					 	
					 		</td>
					 		<td> <h3><?php echo ucwords($row2['subject_posts']); ?></h3>
					 			<hr>
					 			<p><?php echo $row2['description_posts']; ?></p>

					 		</td>
					 	</tr>
					 </table>
					<?php 
					}//end of foreach
				
					?>
					<div id="comment-section">
					<?php	$myrow3 = $postcomment->display_comments('comments','user_info',$idpost);
					foreach ($myrow3 as $row3) {	
						$idpost = $row3['id_posts'];  ?>
					 <table class="table table-bordered">
					 	<tr>
					 		<td style="width: 70px;">
					 			<img src="assets/images/user.jpg" style="  width: 70px;height: 100px;"><br><br>
					 			<small><?php echo ucfirst($row3['fullname']); ?></small>
					 	
					 		</td>
					 		<td >
					 			<div style="border-left:2px solid gray; padding: 20px; margin-top:15px;">
					 			<p><?php echo $row3['message_comment']; ?></p>
					 		<!-- 	<hr> -->
					 			</div>
					 		</td>
					 	</tr>
					 </table>				
					 <?php } // end of myrow3 foreach ?>	
					 </div> 
					 <div id="sp-div">
					 	
					 	<textarea class="form-control" id="comment_message" rows="5" name="comment_message"></textarea>
					 	<button type="button" name="comment" id="comment" class="float-right">comment</button>
					 </div>
					 </form>
				</div>
				
				<?php  } } ?>
				</div>
			</div>
		</div>
		<!--  end of second container -->
		<!-- ------ Third container ------  -->
		<div class="container" id="tcon">
			<div class="row" id="secondrow">
				<div class="col-sm-6" id="chatbox">
					<div class="card mt-3 mb-3">
					  <div class="card-header" id="nameofclickuser">
					    <h3> Name </h3>	
					    <input type="text" id="" name="">
					  </div>
					  <div class="card-body" id="convo_body">
					  <?php 


					  ?>

					   <div class="card-body float-right" >
						  <div class="input-group">
						  	<div class="input-group-prepend">
						  		<label class=" m-2 mt-3"> Dadaadadads</label>
						  		
						  	</div>
						  	<img src="assets/images/user.jpg" style="  width: 50px;height: 50px;">
						  </div> 	
					  </div>	
					   <div class="card-body">
						  <div class="input-group">
						  	<div class="input-group-prepend">
						  		<img src="assets/images/user.jpg" style="  width: 50px;height: 50px;">
						  	</div>
						  	<label class=" m-2 mt-3"> Dadas</label>
						  </div> 	
					  </div>	
					  </div>
					  <div class="card-footer">
					    	<textarea class="form-control" id="message_chat"></textarea>
					    	<button type="button" id="sendchat" data-id="">send</button>
					  </div>
					</div>
				</div>
				<div class="col-sm-4" id="online_users" style="">
					<div class="card mt-3 mb-3	">
					  	<div class="card-header">
						    <div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1">@</span>
							  </div>
							  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
							</div>
					  	</div>
					  	<div id="online_users_body">
					  <?php 
					  	// $postcomment->display_users_chat();
					  	$myrow4 = $user->display_users();
					  	  foreach ($myrow4 as $row4) {
					  	 
					
					 ?>
					  <div class="card-body user_online_div" id="" data-id="<?php echo $row4['id']; ?>">
						  <div class="input-group">
						  	<div class="input-group-prepend">
						  		<img src="assets/images/user.jpg" style="  width: 50px;height: 50px;">
						  	</div>
						 
							
						  	<label class=" m-2 mt-3"><?php  echo $row4['fullname']; ?></label>
						  	
						  </div> 	
					  </div>
					<?php   }  ?>
					</div>
					</div>
				</div>
			</div>
		</div>




	</div>
</body>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#fcon').hide();
			// $('#scon').hide();
			$('#tcon').hide();

			$('#about').click(function(){
				$('#fcon').show(1000);
				$('#scon').hide(1000);
				$('#tcon').hide(100);	
			});
			$('#blog').click(function(){
				$('#scon').show(1000);
				$('#fcon').hide(1000);
				$('#tcon').hide(100);
			});
			$('#register').click(function(){
				// alert('sda')
				$('#login').hide(100);
				$('#signup').show(1000);
				
			});
			$('#projects').click(function(){
				// alert('sda')
				$('#tcon').show(1000);
				$('#scon').hide(100);
				$('#fcon').hide(100);
				
			
				
			});

			$('#loginLG').click(function(){
				// alert('sda')
				$('#signup').hide(100);
				$('#login').show(1000);
				
			});

		});

		$('#sp-back').click(function(event){
			 // window.history.back();
			 window.history.go(-1);
		});

		$(document).ready(function(){

			//DISPLAY DETAILS OF CLICKED SUBJECT
			$('#comment').click(function(event){
				event.preventDefault(); 
				var idofpost = $('#idofpost').val();
				var idofuser = $('#uid').val();
				var comment_message = $('#comment_message').val();
				$.post("postscommentsmngt.php",{
					postid:idofpost,
					userid:idofuser,
					comment_messages:comment_message
				},
				function(data){
					$('#comment_message').val("");
					$('#comment-section').append(data);
					// alert(data)
				});

				
			});
			// $('#postidget').click(function(event){
			// 	$('#selectedPost').show(900);
			// 	$('#tablePosts').hide(200);
			// });
			// 
			$('.user_online_div').click(function(event){
				var idofonlineuser = $(this).attr('data-id');
				alert(idofonlineuser)
				
				// event.preventDefault(); 
				var idofpost = $('#idofpost').val();
				var idofuser = $('#uid').val();
				var comment_message = $('#comment_message').val();
				$.post("usersmngt.php",{
					useridclick:idofonlineuser,
				},
				function(data){
					// alert(data)
					// $('#comment_message').val("");
					$('#nameofclickuser').html(data);
					// alert(data)
				});

				
			});
			$('#sendchat').click(function(event){
				var receiverid = $('#idofclickeduser').val();
				var senderid = $('#uid').val();
				var chatmsg = $('#message_chat').val();
				alert(receiverid +'-'+senderid+'-'+chatmsg)
				$.post("usersmngt.php",{
					receiverid:receiverid,
					senderid:senderid,
					chatmsg:chatmsg
				},
				function(data){
					alert(data)
					
					// $('#nameofclickuser').html(data);
					
				});
			});

		});
	</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</html>