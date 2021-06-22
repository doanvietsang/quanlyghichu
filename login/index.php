<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label
                            for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab"
                            class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <!-- php form login begin -->
                            <?php
//Gọi file connection.php ở bài trước
require_once("../connect.php");
// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
if (isset($_POST["login"])) {
    // lấy thông tin người dùng
    $username = $_POST["userName"];
    $password = md5($_POST["userPass"]);
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    if ($username == "" || $password =="") {
        $mess = "username và password bạn không được để trống!";
    }else{
        $sql = "select * from user where userName = '$username' and userPass = '$password' ";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($query);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows==0) {
            $mess ="tên đăng nhập hoặc mật khẩu không đúng !";
        }else{
            //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $row['userID'];
            // Thực thi hành động sau khi lưu thông tin vào session
            // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
            header('Location: ../admin/index.php');
        }
    }
}   
                        
?>
                            <!-- php form login end -->

                            <!-- form login -->
                            <div class="login">
                                <?php echo '<span>'.$mess.'</span>';?>
                                <form action="index.php" method="post">
                                    <div class="group"> <label for="user" class="label">Username</label>
                                        <input name="userName" id="user" type="text" class="input"
                                            placeholder="Enter your username">
                                    </div>
                                    <div class="group"> <label for="pass" class="label">Password</label>
                                        <input name="userPass" id="pass" type="password" class="input"
                                            data-type="password" placeholder="Enter your password">
                                    </div>
                                    <div class="group"> <input id="check" type="checkbox" class="check" checked> <label
                                            for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                                    <div class="group">
                                        <input name="login" type="submit" class="button" value="login">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot"> <a href="#">Forgot Password?</a> </div>
                                </form>
                            </div>

                            <!-- from sigin up -->
                            <div class="sign-up-form">
                                <form action="sigup.php" method="POST">
                                    <div class="group"> <label for="user" class="label">Username</label> <input
                                            id="user" type="text" class="input" placeholder="Create your Username" name="username">
                                    </div>
                                    <div class="group"> <label for="pass" class="label">Password</label> <input
                                            id="pass" type="password" class="input" data-type="password"
                                            placeholder="Create your password" name="pass"> </div>
                                    <div class="group"> <label for="pass" class="label">Repeat Password</label> <input
                                            id="pass" type="password" class="input" data-type="password"
                                            placeholder="Repeat your password" name="rpass"> </div>
                                    <div class="group"> <input type="submit" class="button" value="Sign Up" name="signUp" > </div>
                                </form>
                                <div class="hr"></div>
                                <div class="foot"> <label for="tab-1">Already Member?</label> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap-4.0.0/dist/js/bootstrap.js"></script>
</body>

</html>