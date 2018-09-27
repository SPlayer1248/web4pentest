<?php
// Check if image file is a actual image or fake image
if (isset($_GET['challenge']) && !empty($_GET['challenge'])) {
    $challenge = str_replace("_"," ",$_GET['challenge']);
if(isset($_POST["submit"])) {
    $sql = "SELECT * FROM `Challenges` WHERE `name`='$challenge'";
    // echo $sql;
    $result = mysqli_query($db,$sql);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$target_dir = $row['link'].'/'.$login_session;
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);  //create directory if not exist
    }
    
$target_file = $target_dir.'/' . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header('location: '.$target_dir);
    } else {
        echo $target_file;
        echo "Sorry, there was an error uploading your file.";
    }
}   
}
}

?>

<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

</body>
</html>