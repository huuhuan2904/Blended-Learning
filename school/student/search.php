<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    if(isset($_GET['key']) && $_GET['key']!=""){
        $output = '';
        $key=trim($_GET['key']);
        $filter_data = "Select students.*, logins.* , students.id as students_id from students join logins on students.login_id = logins.id 
                        where CONCAT(last_name, first_name, dob, gender, address, phone, nation, email) LIKE '%$key%'";
        $query_run = mysqli_query($conn,$filter_data);
        
        $output .='<table style="text-align: center" class="table table-bordered">
        <tr class="title_style" style="background-color: #007BFF; color: white">
            <th> Họ và tên đệm </th>
            <th> Tên </th>
            <th> Ngày sinh </th>
            <th> Giới tính </th>
            <th> Địa chỉ </th>
            <th> Số điện thoại </th>
            <th> Dân tộc </th>
            <th> Email </th>
            <th> Sửa  </th>
            <th> Xóa </th>
        </tr>';
        if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $row)
            {
                $output .= '<tr>
                    <td>'.$row['last_name'].'</td>
                    <td>'.$row['first_name'].'</td>
                    <td>'.date('d-m-Y', strtotime($row['dob'])).'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['nation'].'</td>
                    <td>'.$row['email'].'</td>
                    <input class="student_id" value="'.$row['students_id'].'" name="students_id" id="id" type="hidden">
                    <td><button type="button" class="btn btn-secondary">
                        <a style="color: white" href="index.php?page=edit_student&Id='.$row['students_id'].'" >
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a></button></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteStudent('.$row['students_id'].')"><i class="fa-solid fa-trash"></i></button></td>
                </tr>';

            }
          }else{
            $output .= '<tr>
                    <td colspan="4">Không tìm thấy</td>
                </tr>
                </table>';
          }
          echo $output;
    }else{
        $output = '';
        if(isset($_GET['key']) && $_GET['key']==''){
            $filter_data = "Select students.*, logins.* , students.id as students_id from students join logins on students.login_id = logins.id";
            $query_run = mysqli_query($conn,$filter_data);
            
            $output .='<table style="text-align: center" class="table table-bordered">
            <tr class="title_style" style="background-color: #007BFF; color: white">
                <th> Họ và tên đệm </th>
                <th> Tên </th>
                <th> Ngày sinh </th>
                <th> Giới tính </th>
                <th> Địa chỉ </th>
                <th> Số điện thoại </th>
                <th> Dân tộc </th>
                <th> Email </th>
                <th> Sửa  </th>
                <th> Xóa </th>
            </tr>';
            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row)
                {
                    $output .= '<tr>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.date('d-m-Y', strtotime($row['dob'])).'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['nation'].'</td>
                        <td>'.$row['email'].'</td>
                        <input class="student_id" value="'.$row['students_id'].'" name="students_id" id="id" type="hidden">
                        <td><button type="button" class="btn btn-secondary">
                            <a style="color: white" href="index.php?page=edit_student&Id='.$row['students_id'].'" >
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a></button></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteStudent('.$row['students_id'].')"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>';
    
                }
              }else{
                $output .= '<tr>
                        <td colspan="4">Không tìm thấy</td>
                    </tr>
                    </table>';
              }
        }
        echo $output;
    }
 
?>
