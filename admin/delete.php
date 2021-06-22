<?php
$conn = mysqli_connect("localhost","root","123456","notemanager");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} 
 
// Câu SQL delete
$id = $_GET['noteid'];
$sql = "DELETE FROM note WHERE noteID= '$id'";
 
// Thực hiện câu truy vấn
if ($conn->query($sql) === TRUE) {
    $notename = $_GET['notename'];
    unlink("data/$notename");
    header('Location: index.php');
} else {
    echo "Xóa thất bại: " . $conn->error;
}
 
$conn->close();
        // $notename = $_GET['notename'];
        // unlink("data/$notename");
?>