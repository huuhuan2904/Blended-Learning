<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Teacher_query = "  SELECT teachers.*, logins.*
                        FROM teachers 
                        join logins on teachers.login_id = logins.id
                        where teachers.id = ".$_SESSION['teacher_id']."";
    $Subject_query = "  SELECT assignment.subject_id, subjects.name
                        FROM assignment 
                        join subjects on assignment.subject_id = subjects.id
                        where assignment.teacher_id = ".$_SESSION['teacher_id']."";     
    $Class_query = "    SELECT class_students.class_id, class.class_name
                        FROM class_students 
                        join class on class_students.class_id = class.id
                        where class_students.teacher_id = ".$_SESSION['teacher_id']."";                 
    $Teacher_result = mysqli_query($conn, $Teacher_query);
    $Subject_result = mysqli_query($conn, $Subject_query);
    $Class_result = mysqli_query($conn, $Class_query);  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- bootstrap core css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
        /* *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        } */
        .container{
            position: relative;
            border-radius: 6px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        .container header{
            position: relative;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        .container header::before{
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            height: 3px;
            width: 27px;
            border-radius: 8px;
            background-color: #4070f4;
        }
        .container form{
            position: relative;
            margin-top: 16px;
            min-height: 490px;
            background-color: #fff;
            overflow: hidden;
        }
        .container form .form{
            position: absolute;
            background-color: #fff;
            transition: 0.3s ease;
        }
        .container form .form.second{
            opacity: 0;
            pointer-events: none;
            transform: translateX(100%);
        }
        form.secActive .form.second{
            opacity: 1;
            pointer-events: auto;
            transform: translateX(0);
        }
        form.secActive .form.first{
            opacity: 0;
            pointer-events: none;
            transform: translateX(-100%);
        }
        .container form .title{
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 500;
            margin: 6px 0;
            color: #333;
        }
        .container form .fields{
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        form .fields .input-field{
            display: flex;
            width: calc(100% / 3 - 15px);
            flex-direction: column;
            margin: 4px 0;
        }
        .input-field label{
            font-size: 20px;
            font-weight: 500;
            color: #2e2e2e;
        }
        .input-field input, select{
            outline: none;
            font-size: 14px;
            font-weight: 400;
            color: #333;
            border-radius: 5px;
            border: 1px solid #aaa;
            padding: 0 15px;
            height: 42px;
            margin: 8px 0;
        }
        .input-field input :focus,
        .input-field select:focus{
            box-shadow: 0 3px 6px rgba(0,0,0,0.13);
        }
        .input-field select,
        .input-field input[type="date"]{
            color: #707070;
        }
        .input-field input[type="date"]:valid{
            color: #333;
        }
        .container form button, .backBtn{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 45px;
            max-width: 200px;
            width: 100%;
            border: none;
            outline: none;
            color: #fff;
            border-radius: 5px;
            margin: 25px 0;
            background-color: #4070f4;
            transition: all 0.3s linear;
            cursor: pointer;
        }
        .container form .btnText{
            font-size: 14px;
            font-weight: 400;
        }
        form button:hover{
            background-color: #265df2;
        }
        form button i,
        form .backBtn i{
            margin: 0 6px;
        }
        form .backBtn i{
            transform: rotate(180deg);
        }
        form .buttons{
            display: flex;
            align-items: center;
        }
        form .buttons button , .backBtn{
            margin-right: 14px;
        }
        @media (max-width: 750px) {
            .container form{
                overflow-y: scroll;
            }
            .container form::-webkit-scrollbar{
            display: none;
            }
            form .fields .input-field{
                width: calc(100% / 2 - 15px);
            }
        }
        @media (max-width: 550px) {
            form .fields .input-field{
                width: 100%;
            }
        }
</style>
<body>
    <div class="container" style="max-width: 2140px;">
        <form action="profile/edit_profile.php" method="POST">
            <div class="form first">
                <div class="fields">
                    <?php 
                        foreach($Teacher_result as $row){
                    ?>
                    <div class="input-field">
                        <label>Họ và tên</label>
                        <input value="<?php echo $row['name'] ?>" name="name" id="name" type="text"
                            placeholder="Nhập họ tên" required>
                    </div>
                    <div class="input-field">
                        <label>Sinh ngày</label>
                        <input value="<?php echo date("Y-m-d", strtotime($row['dob'])) ?>" name="dob" id="dob"
                            type="date" required>
                    </div>
                    <div class="input-field">
                        <label>Giới tính</label>
                        <select name="gender" id="gender" required>
                            <option disabled>Chọn giới tính</option>
                            <option value='Nam' <?php if($row["gender"] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value='Nữ' <?php if($row["gender"] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Địa chỉ</label>
                        <input value="<?php echo $row['address'] ?>" name="address" id="gender" type="text"
                            placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="input-field">
                        <label>Số điện thoại</label>
                        <input value="<?php echo $row['phone'] ?>" name="phone" id="phone" type="number"
                            placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="input-field">
                        <label>Tài khoản</label>
                        <input value="<?php echo $row['email'] ?>" name="email" id="email" type="text"
                            placeholder="Nhập email" required>
                    </div>
                    <div class="input-field">
                        <label>Mật khẩu</label>
                        <input disabled value="<?php echo $row['password'] ?>" name="password" id="password" type="password"
                            placeholder="Nhập mật khẩu" required>
                    </div>
                    <?php }?>
                    <!-- subject -->
                    <?php 
                        foreach($Subject_result as $row){
                    ?>
                    <div class="input-field">
                        <label>Môn dạy</label>
                        <input disabled value="<?php echo $row['name'] ?>" type="text">
                    </div>
                    <?php break;}?>   
                    <!-- class  -->
                    <?php 
                        foreach($Class_result as $row){
                    ?>
                    <div class="input-field">
                        <label>Lớp chủ nhiệm</label>
                        <input disabled value="<?php echo $row['class_name'] ?>" type="text">
                    </div>
                    <?php break; }?>  
                </div>
                <div style="text-align: right" class="right-button">
                    <button id="submit" class="submit" style="float: right"><i class="fa-solid fa-check"></i></button>
                </div>    
            </div>
        </form>
    </div>
</body>

</html>