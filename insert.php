<?php

//set connection
$mysql = mysqli_connect("localhost", "root", "", "temp");

// Check connection
if($mysql === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//setting upload
// $file = explode(".", $_FILES["fileToUpload"]["name"]);
// $newfilename = round(microtime(true)) . '.' . end($temp);
// move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../img/" . $newfilename);

    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        echo $filename;
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        $newfilename = round(microtime(true)) . '.' . end(explode(".", $_FILES["photo"]["name"]));

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $_FILES["photo"]["name"])){
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $newfilename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }




// Escape user inputs
$temp = mysqli_real_escape_string($mysql, $_REQUEST['temp']);

// attempt insert query execution
$insert_temp = "INSERT INTO temperature (temp, pic) VALUES ('$temp', '$newfilename')";
if(mysqli_query($mysql, $insert_temp)){
    echo "<br/>Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysql);
}
 
// close connection
mysqli_close($mysql);
?>