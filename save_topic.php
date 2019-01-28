<?php

$con = new mysqli("localhost","admin","root","forum");
$st = $con->prepare("INSERT INTO topics(fname_tp,lname_tp,title_tp,desc_tp) VALUE(?,?,?,?) ");
$st->bind_param("ssss",$_POST["fn"],$_POST['ln'],$_POST['tl'],$_POST['dc']);
$st->execute();
echo "Succesfully added";
		


?>