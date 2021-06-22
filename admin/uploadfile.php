<?php 
$target_dir = "data/";
$target_file = $target_dir . basename($_FILES["filename"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Kiểm tra xem tệp đã tồn tại chưa
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Cho phép các định dạng tệp nhất định
if($imageFileType != "txt") {
  echo "Sorry, only txt files are allowed.";
  $uploadOk = 0;
}

// Kiểm tra xem $uploadOk có được đặt thành 0 do lỗi không
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// nếu mọi thứ đều ổn,tải tệp lên
} else {
  if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
    require_once("../connect.php");
    // lấy giá trị userid từ session lưu vào database
    session_start();
    $noteName = $_FILES['filename']['name'];
    $userID = $_SESSION['userid'];
    $title = $_POST['title'];
    $query = "INSERT INTO note (noteName, userID, title) VALUES ('$noteName', '$userID', '$title')";
    if (mysqli_query($conn, $query)) {
          echo "New record created successfully";
    } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
    mysqli_close($conn);
    header('Location: index.php');
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

?>