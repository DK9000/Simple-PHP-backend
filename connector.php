<?php 
function getConnection() {
	return mysqli_connect("localhost:3306", "root", "", "color_db");
}

?>