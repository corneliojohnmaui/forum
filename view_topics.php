<?php

$con = new mysqli("localhost","admin","root","forum");
$st = $con->prepare("select * from topics");
// $st->bind_param("ssi", $_POST["name"],$_POST['msg']);
$st->execute();
$rs=$st->get_result();

while ($row=$rs->fetch_assoc()){
	$var = $row['date_post'];
	$date = str_replace('/', '-', $var);
	$date_posts = date('Y-m-d', strtotime($date));
	$date_post = date("M j, Y", strtotime($date));
	// strtotime()
	$res = "";

	// $res .="<table class='table table-bordered'>";
	// $res .="<tr>
	// 			<th class=""> Title </th>
	// 			<th> Date Posted </th>
	// 		</tr>";
	$res.="<tr><td> PIC 1</td>";
	$res .="<td><b> ". $row["title_tp"] ."</b><br><small>".ucfirst($row["fname_tp"])." ".ucfirst($row['lname_tp'])." • ".$date_post."</small></td>";
	$res .="<td class='float:right;'> </td></tr>";
	echo $res;
}



?>