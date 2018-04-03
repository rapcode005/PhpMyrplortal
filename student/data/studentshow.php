<?php

if (isset($_POST['submit'])) {
	$id = $_POST['submit'];
	$url = "../".$id."/";
	header("Location: ".$url);
}