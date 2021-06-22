<!-- php sigin up -->
<?php
if (isset($_POST["signUp"])) {
    //lấy thông tin từ các form bằng phương thức POST
    print_r ($_POST);
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $rpass = $_POST["rpass"];
    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if ($username == "" || $password == "" || $rpass == "") {
          echo "bạn vui lòng nhập đầy đủ thông tin";
    }else{
        if($password != $rpass){
                echo  "mật khẩu không trùng khớp";

        }else{
            include_once("../connect.php");
            $sql = "select * from user where userName = '$username' ";
            $query = mysqli_query($conn,$sql);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows > 0) {
                echo "tên đăng nhập đã tồn tại";
                $conn -> close();
            }else{
                $md5 = md5($password);
                $query = "INSERT INTO user (userName, userPass) VALUES ('$username', '$md5')";
                if (mysqli_query($conn, $query)) {
                    header('Location: index.php');
                    $conn -> close();
              } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
            }
        }
    }
}
?>
<!-- php -->