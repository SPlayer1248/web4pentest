<?php
    include_once('templates/header.php');
    ?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
        <div class="panel panel-default user_panel">
            <div class="panel-heading">
                <h3 class="panel-title">User List</h3>
            </div>
            <div class="panel-body">
        <div class="table-container">
                    <table class="table-users table" border="0">
                        <tbody>
                            <?php
                
                      $query = "SELECT * FROM Users ORDER BY username";
                      $result = mysqli_query($db,$query);
                      
                  
                   if ($result != NULL && $result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                            $is_teacher = $row['teacher'];
                      if($is_teacher){
                        $role = 'Teacher';
                      } else {
                        $role = 'Student';
                      }
                            echo '<tr href="#">
                                <td width="10" align="center">
                                    <i class="fa fa-2x fa-user fw"></i>
                                </td>
                                <td>
                                     <a href="index.php?page=profile&user='.$row['username'].'&action=view">'.$row['username'].'</a><br>
                                </td>
                                <td>
                                    '.$row['fullname'].'
                                </td>
                                <td align="center">
                                    '.$role.'
                                </td>
                            </tr>';
                          }
                        }
                          ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

  </div>

        </div>
    </div>

<?php 
    // include_once('templates/footer.php');
    ?>

</body>
</html>