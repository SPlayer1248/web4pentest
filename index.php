<?php
	include('session.php');
	if ($_SESSION['loggedin']) {
		if(isset($_GET['page']) || !empty($_GET['page'])){
        $page = $_GET['page'];
        include("$page.php");
    }
    else
    {
        // include('home.php');
        header('location: index.php?page=home');
    }
	} else {
		header('location: login.php');
	}
    
    
    
?>