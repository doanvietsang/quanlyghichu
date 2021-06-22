<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- nav begin -->
    <?php session_start(); ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?php echo $_SESSION['username']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../login/logout.php">Logout<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav end -->
    <!-- php begin -->
    <?php
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	 header('Location: ../login/index.php');
}
//su ly tao file
if($_POST['uploadfile'] == 'uploadfile') {
    $_FILES['filename'];
}

?>
    <!-- php end -->
    <!-- table begin -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Note Name</th>
                <th scope="col">write notes</th>
                <th scope="col">title</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
//tải dử liệu lên
$userID = $_SESSION['userid'];
include_once('../connect.php');
$query = mysqli_query($conn,"select * from note where userID = $userID");
while($row = mysqli_fetch_array($query)){
?>
            <tr>
                <th scope="row"><?php echo $row['noteID'] ?></th>
                <th scope="row"><?php echo $row['noteName'] ?></th>
                <th scope="row"><a class="btn btn-primary" href="wtrite.php?id=<?php echo $row['noteID']; ?>" role="button">wtrite</a></th>
                <th scope="row"><?php echo $row['title'] ?></th>
                <th><a class="btn btn-danger"
                        href="delete.php?noteid=<?php echo $row['noteID']; ?>&notename=<?php echo $row['noteName']; ?>"
                        role="button">delete</a>|
                    <a class="btn btn-success" href="download.php?name=<?php echo $row['noteName'];?>" role="button">download</a>
                </th>

            </tr>
            <?php }
$conn->close();
?>
        </tbody>
    </table>
    <!-- table end -->
    <div class="container">
        <a href="#demo" class="btn btn-info" data-toggle="collapse">Upload file</a>
        <div id="demo" class="collapse">
            <div class="container mt-3">
                <h2>Custom File</h2>
                <form action="uploadfile.php" enctype="multipart/form-data" method="POST">
                    <p>Custom file:</p>
                    <div class="custom-file mb-3">
                        <label for="exampleInputEmail1">title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="title">
                    </div>
                    <br>
                    <br>
                    <div class="custom-file mb-3">
                        <label for="customFile">file</label>
                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="uploadfile" value="uploadfile">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../bootstrap-4.0.0/dist/js/bootstrap.js"></script>
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
</body>

</html>