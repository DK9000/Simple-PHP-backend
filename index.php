<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include 'connector.php';

if(isset($_GET['action'])){
	if(function_exists($_GET['action'])) {
	//if is auth
	call_user_func($_GET['action']);
	
	}
}

function getAllColors() {
	$con = getConnection();
	$stmt = $con->prepare("select * from color");
	$stmt->execute();
	$stmt->bind_result($id, $colorName);
	
	
	while($stmt->fetch()) {
		$output[]=array('id' => $id,
		'color_name' =>$colorName
		);
	}
	
	echo json_encode($output);
	
	$stmt->close();
	$con->close();
}

function createColor() {
	if(isset($_GET['color'])) {
		$con = getConnection();
		
		$stmt = $con->prepare("insert into color(color_name) VALUES(?)");
		$stmt->bind_param("s", $_GET['color']);
		$stmt->execute();
		$stmt->close();
		$con->close();
	}
}

function getColorById() {
	if(isset($_GET['id'])) {
		$con = getConnection();
		
		$stmt = $con->prepare("select * from color where id=?");
		$stmt->bind_param("i", $_GET['id']);
		
		$stmt->execute();
		$stmt->bind_result($id, $colorName);
		
		while($stmt->fetch()){
			$output[]=array('id' => $id,
			'color_name' =>$colorName
		);
		}
		
		echo json_encode($output);
	
		$stmt->close();
		$con->close();
	}
}


?>