<?php
    include_once('templates/header.php');
       if(isset($_GET['id']) && !empty($_GET['id'])){
        
        $id = $_GET['id'];
        $query = "SELECT * FROM Notifications WHERE id = '$id'";       
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
        $id = $_GET['id'];
         $new_title = $_POST['title'];
         $new_content = $_POST['content'];
    
         $query = "UPDATE `Notifications` SET `title`='$new_title',
         `content`='$new_content' 
         WHERE `id`=$id";
         $reslt = mysqli_query($db,$query);
         if($reslt){
    
             header('location: index.php?page=notification&id='.$id.'&action=view');
         } else {
            die();
         }
            
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
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                               <div class="article">
                            <h3>'.$row['title'].'</h3>
                            
                                <p><i class="fa fa-calendar"></i> '.$row['date'].'  ';
                                if ($teacher){
                                    echo '  <a href="index.php?page=notification&id='.$id.'&action=edit"><i class="far fa-edit"></i> Edit</a>';
            
                            echo '  <a  href="index.php?page=notification&id='.$id.'&action=delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> </p>';               
                                }
                                
                            echo '<div class="article-content">
    
                                <p>'.$row['content'].'</p>                            
                            </div>';
                  
                            echo '</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }
    
        else if($_GET['action'] == 'edit'){
            if($teacher){
            echo '
    <div class="jumbotron">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-4 col-lg-offset-4 toppad" >
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <form class="table table-user-information" action="index.php?page=notification&id='.$id.'" method="post">';
                                            
                                        
                                        echo'    Title: 
                                            <input class="form-control" name="title" type="text" value="'.$row['title'].'"</input>
                                        
                                            Content: 
                                            <textarea class="form-control" rows="10" name="content"  type="text" >'.$row['content'].'</textarea><br>
                                        
                                        <input type="submit" name="submit" class="btn btn-success float-right" value="Edit"></input>    
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

    else if($_GET['action'] == 'delete'){
        $query = "DELETE FROM Notifications WHERE id=$id";
        $reslt = mysqli_query($db,$query);
        header('location: index.php?home');
    }
    } else {
        die();
    }
    
    
    ?>