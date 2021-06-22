<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<!-- php begin -->
<?php 
session_start();

if(!isset($_SESSION['username'])){
    header('Location: ../login/index.php');
} else {
    include_once ('../connect.php');
    $id=$_GET['id'];
    $query=mysqli_query($conn,"select * from `note` where noteID='$id'");
    $row=mysqli_fetch_assoc($query);    
    $namefile = 'data/'.$row['noteName'];
    $conn -> close();


    //đọc file
    $myfile = fopen($namefile,'r') or die("Unable to open file!");
    $content = fread($myfile, filesize($namefile));
    fclose($myfile);
    //lưu file
    if($_POST['save'] == 'save'){
        $title = $_POST['title'];
        $id = $_POST['id'];
        
                // Create connection
            $conn = new mysqli("localhost", "root", "123456", "notemanager");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "UPDATE `note` SET title='$title' WHERE noteID='$id'";
            
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                echo 'update thanh cong';
            } else {
                echo "Error updating record: " . $conn->error;
            }
 
            $conn->close();

        $data = $_POST['text'];
        $namefile = 'data/'.$_POST['filename'];
        $myfile = fopen($namefile,'w')or die("Unable to open file!");
        fwrite($myfile,$data);
        fclose($myfile);
        header('Location: index.php');
    }
}
?>
<!-- php end -->
    <style>
        .none{
            display: none;
        }
    </style>
    <div class="container">
        <form action="wtrite.php" method="POST">
        <div class="form-group none" >
            <input type="text" value="<?php echo $row['noteID']; ?>" name='id'>
        </div>
        <div class="form-group none" >
            <input type="text" value="<?php echo $row['noteName']; ?>" name='filename'>
        </div>
        <div class="form-group" >
        <label for="title">title</label>
            <input type="text" value="<?php echo $row['title']; ?>" id="title" name='title'>
        </div>
            <div class="form-group">
                <label for="comment">write here</label>
                <textarea class="form-control" rows="30" cols="100" height="500px" id="comment" name="text">
                    <?php 
                       echo $content;
                    ?>
                </textarea>
            </div>
            <div class="form-group">
            <input name="save" type="submit" class="btn btn-primary" value="save">
            </div>
        </form>
    </div>

</body>

</html>
