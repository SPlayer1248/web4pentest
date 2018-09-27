<?php
    include_once('templates/header.php');
       if(isset($_GET['user']) && !empty($_GET['user'])){
       	
       	$user = $_GET['user'];
       	$query = "SELECT * FROM Users WHERE username = '$user'";       
          	$result = mysqli_query($db,$query);
          	$count = $result->num_rows;
          	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           if($result == NULL || $count != 1){
           	die();
           }
           
       } else {
       	header('location: index.php');
       }
       

    if(isset($_POST['submit']) && !empty($_POST['submit'])){
    	if($teacher){
    		$new_usrname = $_POST['username'];
    		$new_passwd = $_POST['password'];
    		$new_fname = $_POST['fullname'];
    		$new_email = $_POST['email'];
    		$new_phone = $_POST['phone'];

    		$query = "UPDATE `Users` SET `username`='$new_usrname',
    		`password`='$new_passwd',
    		`fullname`='$new_fname',
    		`email`='$new_email',
    		`phone`='$new_phone'
    		WHERE `username`='$user'";
    		$reslt = mysqli_query($db,$query);
          	header('location: index.php?page=profile&user='.$new_usrname.'&action=view');
    		
    	} 
    }


    if(isset($_GET['action']) && !empty($_GET['action'])){
    	if($_GET['action'] == 'view'){
    		echo '
    <div class="jumbotron">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-4 col-lg-offset-4 toppad" >
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">User profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Username</td>
                                            <td>'.$row['username'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Full name: </td>
                                            <td>'.$row['fullname'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td>'.$row['email'].'</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>'.$row['phone'].'</td>
                                        </tr>
                                    </tbody>
                                </table>';
                                
                                if ($teacher && $row['teacher'] == false || $login_session === $user){
                                	echo '<a class="btn btn-primary" href="index.php?page=profile&user='.$user.'&action=edit">Edit</a>';

                                	if($teacher){
										echo '	<a class="btn btn-danger" href="index.php?page=profile&user='.$user.'&action=delete">Delete</a>';           
                                	}
                                }
                            echo '</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    	}
    
    	else if($_GET['action'] == 'edit'){
    		if($teacher && $row['teacher'] == false || $login_session === $user){
    		echo '
    <div class="jumbotron">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-4 col-lg-offset-4 toppad" >
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">User profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <form class="table table-user-information" action="index.php?page=profile&user='.$user.'" method="post">';
                                    
                                        if($teacher){
                                        	echo 'Username: 
                                            <input class="form-control" type="text" name="username" value="'.$row['username'].'"</input>

                                            Password: 
                                            <input class="form-control" type="password" name="password" value="'.$row['password'].'"</input>
                                        
                                            Full name: 
                                            <input class="form-control" name="fullname" value="'.$row['fullname'].'"</input>';
                                        } else {
                                        	echo 'Username: 
                                            <input class="form-control" disabled value="'.$row['username'].'"</input>
                                        
                                            Full name: 
                                            <input class="form-control" disabled value="'.$row['fullname'].'"</input>';
                                        }
                                            
                                        
                                        echo'    Email: 
                                            <input class="form-control" name="email" type="text" value="'.$row['email'].'"</input>
                                        
                                            Phone: 
                                            <input class="form-control" name="phone"  type="text" value="'.$row['phone'].'"</input><br>
                                        
                                		<input type="submit" name="submit" class="btn btn-success" value="Submit"></input>    
                                </form>
                                
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } else {
    	header('location: index.php?home');
    	}
    }
    else if($_GET['action'] == 'delete' && $teacher && $row['teacher'] == false) {
        $query = "DELETE FROM Users WHERE username='$user'";
        $reslt = mysqli_query($db,$query);
        if($reslt){
            header('location: index.php?page=users');
        }
        
    }
    } else {
    	die();
    }
    
    ?>