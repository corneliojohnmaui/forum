<?php 

include_once 'includes/users.class.php';

$user = new Users();

	//ON SUBMIT OF FORM ON REGISTER DIV
	if (isset($_REQUEST['submitReg'])) {
		extract($_REQUEST);
		$login = $user->register_user($fullname,$username,$email,$password);
		if ($login) {
			// header("location:home.php");
			// alert('SUCCESS REGISTERED');
			$_SESSION['msg'] = "SUCCESS REGISTERED";
			echo $_SESSION['msg'];
			// $_SESSION['']
		}
		else
		{
			echo "Mali ";
		}
	}
	// if (isset($_SESSION['id'])) {
	// 	header("location:home.php");
	// }

	//ON SUBMIT OF FORM ON LOGIN DIV
	else if (isset($_REQUEST['submitLog'])) {
		extract($_REQUEST);
		$login = $user->login_user($useroremail,$pass);
		if ($login) {
			// header("location:home.php");
			echo "SUCCESS LOGIN";
		}
		else
		{
			echo "Mali ang password or username";
		}
	}
	//USER LOGOUT
	else if (isset($_GET['logout'])) {
		$user->logout_user();
		header("location:index.php");
	}
	//GET DATA OF CLICKED USER ON CHATBOX
	else if (isset($_REQUEST['useridclick'])) {

		$useridclick = $_REQUEST['useridclick'];
		$result = $user->display_clicked_user($useridclick);

		foreach ($result as $row3) {
			$id = $row3['id'];
			$fname = $row3['fullname'];
		}
		$output = "";
		$output .="<h3>".ucfirst($fname)."</h3>";
		$output .="<input type='text' id='idofclickeduser' value='".$id."'>";
		echo $output;


	}
	else if(isset($_REQUEST['receiverid'])){
		$reciever = $_REQUEST['receiverid'];
		$sender = $_REQUEST['senderid'];
		$message = addslashes($_REQUEST['chatmsg']);

		$myarray = array(
					"sender_id"=>$sender,
					"receiver_id"=>$reciever,
					"message_chat"=>$message);

		$result = $user->send_message('live_chat',$myarray);

		$myrow5 = $user->display_convo('live_chat','user_info',$sender,$reciever);

		foreach ($myrow5 as $row5) {
			$msg = $row5['message_chat'];
		}

		$output ="";
		$output .="<div class='card-body'>";
		$output .=" <div class='input-group'>";
		$output .="	 <div class='input-group-prepend'>";
		$output .="		<img src='assets/images/user.jpg' style='width: 50px;height: 50px;'></div>";
		$output .="<label class='m-2 mt-3'>".$msg."</label> </div></div>";
		echo $output;

	}

?>