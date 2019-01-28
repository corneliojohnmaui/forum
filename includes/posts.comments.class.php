<?php 


include_once 'dbconfig.php';

/**
 * 
 */
session_start();
class PostsComments 
{
	public $con;
	function __construct()
	{
		$this->con= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (mysqli_connect_errno()) {
			echo "Error: Cannot Connect To Database";
			exit;
		}
	}


	public function insert_posts($table,$myarray)
	{
		$sql ="";
		$sql .="INSERT INTO ".$table;
		$sql .=" (".implode(",",array_keys($myarray)).") VALUES ";
		$sql .="('".implode("','",array_values($myarray))."')";
		// print_r($fields);
		// echo $sql;
		// print_r($fields);
		$query =mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
	}

	public function display_posts($table,$table2){
		$sql = " SELECT * FROM ".$table.",".$table2." WHERE ".$table.".id_user =".$table2.".id";
		$array = array();

		$query =mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] =$row;
		}
		// echo $sql;
		return $array;
	}
	public function display_clicked_posts($table,$table2,$subject){
		$sql = " SELECT * FROM ".$table.",".$table2." WHERE ".$table.".id_user =".$table2.".id AND subject_posts = '".$subject."'";
		$array = array();
		// echo $sql;
		$query =mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] =$row;
		}
		// echo $sql;
		return $array;
	}

	public function insert_comment($table,$myarray)
	{
		$sql ="";
		$sql .="INSERT INTO ".$table;
		$sql .=" (".implode(",",array_keys($myarray)).") VALUES ";
		$sql .="('".implode("','",array_values($myarray))."')";
		// print_r($fields);
		// echo $sql;
		// print_r($fields);
		
		$query =mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
	}
	// SELECT * FROM posts,user_info,comments WHERE user_info.id = comments.id_user AND posts.id_posts = comments.id_posts // query for displaying comments

	// SELECT * FROM posts,user_info,comments WHERE user_info.id = comments.id_user AND posts.id_posts = '1' ORDER BY comments.date_comment ASC 

	// SELECT * FROM user_info,comments WHERE comments.id_posts = '1' AND comments.id_user = user_info.id ORDER BY comments.date_comment ASC
	public function display_comments($table,$table2,$idofpost)
	{
		$sql= " SELECT * FROM ".$table.",".$table2." WHERE ".$table.".id_posts =".$idofpost." AND ".$table.".id_user =".$table2.".id ORDER BY ".$table.".date_comment ASC ";

		// $sql= " SELECT * FROM ".$table.",".$table2.",".$table3." WHERE ".$table2.".id =".$table3.".id_user AND ".$table.".id_posts ='".$idofpost."' ORDER BY ".$table3.".date_comment ASC ";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		// echo $sql;
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		// echo $sql;
		return $array;

	}
	// public function display_users()
	// {

	// 	$sql = " SELECT * FROM user_info";

	// 	$array = array();

	// 	$query =mysqli_query($this->con,$sql);
	// 	while ($row = mysqli_fetch_assoc($query)) {
	// 		$array[] =$row;
	// 	}
	// 	// echo $sql;
	// 	return $array;
	// 	// echo "string";
	// }


}
?>