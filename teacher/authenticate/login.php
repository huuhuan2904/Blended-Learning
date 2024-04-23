<?php 
session_start();
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
define('ROOT_URL', 'http://localhost/final_project_admin/');

if(isset($_POST['submit'])) {
    // get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$email) {
        $_SESSION['signin'] = "Vui lòng nhập email";
    }
    elseif(!$password) {
        $_SESSION['signin'] = "Vui lòng nhập mật khẩu";
    }
    else {
        //get user from database
        $fetch_user_query = "SELECT * FROM logins WHERE email='$email'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1) {
            // lấy inf đăng nhập
            $login_record = mysqli_fetch_assoc($fetch_user_result);

            $login_id = $login_record['id'];//lưu login id để lấy teacher inf
            $_SESSION['login_id'] = $login_record['id'];
            $_SESSION['teacher_email'] = $login_record['email'];

            $teacher_result = mysqli_query($conn, "SELECT * FROM teachers WHERE login_id='$login_id'");
            $teacher_record = mysqli_fetch_assoc($teacher_result);
            $_SESSION['teacher_id'] = $teacher_record['id'];
            $_SESSION['teacher_name'] = $teacher_record['name'];

            $db_password = $login_record['password'];
            $md5Passwork = md5($password);
            if($md5Passwork == $db_password){
                // log user in
                header('location: ' . ROOT_URL . 'teacher/index.php');
            }else{
                $_SESSION['signin'] = "Sai email hoặc mật khẩu";
            }
        }
        else {
            $_SESSION['signin'] = "Sai email hoặc mật khẩu";
        }
    }

    // if there is a problem, back to log in page with data
    if(isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'teacher/authenticate/login_page.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'teacher/authenticate/login_page.php');
    die();
}

?>