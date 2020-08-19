<?php
class  UploadFiles {

function validateFiles($params){
    echo "validateFiles in UploadFiles.php";

    // array for all file information
    $file = $_FILES['profileImg'];
    // Creating variables for each data point for the file
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Making an array to separate by the period
    $fileExt = explode('.', $fileName);
    // Making Lowercase before checking 
    $fileActualExt = strtolower(end($fileExt));

    // array of acceptable file endings
    $allowed = array('png', 'jpg', 'jpeg', 'gif');

    // test if the string (name of file) are in both arrays
    if(in_array($fileActualExt, $allowed)){
        // test if there are no errors
        if ($fileError === 0) {
            // test if file size is less than
            if ($fileSize < 1000000) {
                // replacing actual name of the file with a unique ID 
                // so there are no duplicates that delete previous 
                //  then add extension as well (made sure all lowercase)
                $newFileName = uniqid('', true). "." .$fileActualExt;
                // telling where to upload file to -> the 'uploads' folder
                $fileDestination = './public/img/uploads/' .$newFileName;
                // moving file from temporary location to actual location
                move_uploaded_file($fileTmpName, $fileDestination);
                // updating the database to set status to zero (get new image) rather than 1 for default
                // $query = "UPDATE user SET profileImg='$fileNameNew' WHERE id=$id";
                // $result = $dbh->exec($query);
                // bring back to front page with message in URL
                //header("Location: index.php?uploadsuccess");
            } else {
                echo "Your file size is too big";
            }
        } else {
            echo "There was an error uploading your image";
        }
    } else {
        echo "You cannot upload files of this type";
    }

    echo "validateFiles() returns fileDestination";
    return $fileDestination;

    }//close func. validateFiles

}