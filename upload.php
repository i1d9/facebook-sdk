<?php
include_once('fb.php');
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {



  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
    echo "Error no file selected";
    //Normal post
  } else {

    if (isset($_POST['description']) && !empty($_POST['description'])) {

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

          //echo "<a href='$_SERVER['SERVER_NAME'].'/'.$target_file />";

          $fbUploadLink_address = "http://" . $_SERVER['SERVER_NAME'] . '/' . $target_file;
          $link_address = $target_file;

          echo "Success" . PHP_EOL;
          echo "<a href='" . $link_address . "'>Your uploaded Image</a>";
          //echo $fbUploadLink_address;

          $message = $_POST["description"];
          $data = [
            'message' => $message,
            'source' => $fb->fileToUpload($fbUploadLink_address),
          ];
          makeImagePost($data, $foreverPageAccessToken);
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }
  }
}

if (isset($_POST["sharedLink"])) {


  if (isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['website']) && !empty($_POST['website'])) {

    $message = $_POST["description"];
    $website = $_POST["website"];


    $data = [
      'link' => $website,
      'message' => $message,
    ];
    makePost($data, $foreverPageAccessToken);
  }
}


if (isset($_POST["sharedTextPost"])) {



  if (isset($_POST['post']) && !empty($_POST['post'])) {

    $message = $_POST["post"];
    $data = [
      'message' => $message,
    ];
    makePost($data, $foreverPageAccessToken);
  }
}
