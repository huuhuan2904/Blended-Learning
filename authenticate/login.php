<?php 
session_start();
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
define('ROOT_URL', 'http://localhost/final_project_admin/');

if(isset($_POST['submit'])) {
    // get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = $_POST['role'];

    if(!$email) {
        $_SESSION['signin'] = "Vui lòng nhập email";
    }
    elseif(!$password) {
        $_SESSION['signin'] = "Vui lòng nhập mật khẩu";
    }elseif(!$role) {
        $_SESSION['signin'] = "Vui lòng chọn vai trò";
    }
    else {
        $fetch_login_result = mysqli_query($conn, "SELECT * FROM logins WHERE email='$email'");

        if(mysqli_num_rows($fetch_login_result) == 1) {
            // lấy inf đăng nhập
            $login_record = mysqli_fetch_assoc($fetch_login_result);
            $login_role = $login_record['role'];
            $login_id = $login_record['id'];//lưu login id để lấy inf
            $_SESSION['login_id'] = $login_record['id'];
            $_SESSION['login_email'] = $login_record['email'];
            if($role == "1" && $role == $login_role){
                $user_result = mysqli_query($conn, "SELECT * FROM students WHERE login_id='$login_id'");
                $user_record = mysqli_fetch_assoc($user_result);
                $_SESSION['student_id'] = $user_record['id'];
                $_SESSION['last_name'] = $user_record['last_name'];
                $_SESSION['first_name'] = $user_record['first_name'];
                $_SESSION['success'] = 2;
                $_SESSION['notification'] = 'Đăng nhập thành công';

                $db_password = $login_record['password'];
                $md5Passwork = md5($password);
                if($md5Passwork == $db_password){
                    header('location: ' . ROOT_URL . 'student/index.php?page=timetable_page');
                }else{
                    $_SESSION['signin'] = "Sai email hoặc mật khẩu";
                }

            }elseif($role == "2" && $role == $login_role){
                $user_result = mysqli_query($conn, "SELECT * FROM teachers WHERE login_id='$login_id'");
                $user_record = mysqli_fetch_assoc($user_result);
                $_SESSION['teacher_id'] = $user_record['id'];
                $_SESSION['teacher_name'] = $user_record['name'];
                $_SESSION['success'] = 2;
                $_SESSION['notification'] = 'Đăng nhập thành công';

                $db_password = $login_record['password'];
                $md5Passwork = md5($password);
                if($md5Passwork == $db_password){
                    header('location: ' . ROOT_URL . 'teacher/index.php?page=schedule_page');
                }else{
                    $_SESSION['signin'] = "Sai email hoặc mật khẩu";
                }
            }else{
                $_SESSION['signin'] = "Sai thông tin đăng nhập";
            }
        }
        else {
            $_SESSION['signin'] = "Sai email hoặc mật khẩu";
        }
    }

    // if there is a problem, back to log in page with data
    if(isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'authenticate/login_page.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'authenticate/login_page.php');
    die();
}

?>