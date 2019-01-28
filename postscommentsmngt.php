<?php 

include_once 'includes/posts.comments.class.php';

$postcomment = new PostsComments();

	// ON SUBMIT OF POST FORM
	if (isset($_POST['submitPost'])) {

		$id = $_POST['uid']; //user id
	 	
		if ($id == "") {
			echo "Login first before you post topic";
		}
		else{
		 	$myarray = array(
					"id_user"=>$_POST['uid'],
					"subject_posts"=>$_POST['subject'],
					"category_posts"=>$_POST['category'],
					"description_posts"=>$_POST['description']);

		 	$insert = $postcomment->insert_posts('posts',$myarray);
		 	 	// echo $insert;
		 	if ($insert) {
		 		// echo "Succesfully Posted";
		 		header('location:index.php?msg=insert request successfully');

		 	}else{
		 		echo "Error: Cannot Post";
		 	}
		}
	}
	else if (isset($_REQUEST['postid'])) {
		$comment_msg =  addslashes($_REQUEST['comment_messages']);
		$postid = $_REQUEST['postid'];
		$userid = $_REQUEST['userid'];

			if ($userid == "") {
				echo "Login first before you can comment";
			}else{
				$myarray = array(
					"id_user"=>$userid,
					"id_posts"=>$postid,
					"message_comment"=>$comment_msg);

		 		$insertcomment = $postcomment->insert_comment('comments',$myarray);
		 		$myrow3 = $postcomment->display_comments('comments','user_info',$postid);
		 		foreach ($myrow3 as $row3) {	
		 		$result = "";

		 		$result .=" <table class='table table-responsive'><tr>";
		 		$result .=" <td style='width: 70px;'>";
		 		$result .=" <img src='assets/images/user.jpg' style=' width: 70px;height: 100px;'><br><br>";
		 		$result .=" <small> ". ucfirst($row3['fullname'])."</small>";
				$result .=" </td><td>";
				$result .=" <div style='border-left:2px solid gray; padding: 20px; margin-top:20px;'>";
				$result .=" <p>".$row3['message_comment']."</p>";
				$result .=" </div></td></tr> </table>";

				}
				echo $result;					 				
								
			}


	}

	

?>
