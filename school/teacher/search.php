<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $output = '';
    if(isset($_GET['key']) && $_GET['key']!=""){

        $key=trim($_GET['key']);
        $filter_data = "SELECT teachers.*, logins.* , teachers.id as teachers_id from teachers join logins on teachers.login_id = logins.id 
                            WHERE CONCAT(name, dob, gender, address, phone, email) LIKE '%$key%'";
        $query_run = mysqli_query($conn,$filter_data);
        
        $output .='<table style="text-align: center" class="table table-bordered">
        <tr class="title_style" style="background-color: #007BFF; color: white">
            <th> Họ tên </th>
            <th> Ngày sinh </th>
            <th> Giới tính </th>
            <th> Địa chỉ </th>
            <th> Số điện thoại </th>
            <th> Email </th>
            <th> Sửa </th>
            <th> Xóa </th>
        </tr>';
        if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $row)
            {
                $output .= '<tr>
                    <td>'.$row['name'].' </td>
                    <td>'.date('d-m-Y', strtotime($row['dob'])).' </td>
                    <td>'.$row['gender'].' </td>
                    <td>'.$row['address'].' </td>
                    <td>'.$row['phone'].' </td>
                    <td>'.$row['email'].' </td>
                    <input class="teacher_id" value="'.$row['teachers_id'].'" name="teachers_id" id="id"
                        type="hidden">
                    <td>
                        <button type="button" class="btn btn-secondary" >
                            <a style="color: white" href="index.php?page=edit&Id='.$row['teachers_id'].'"><i class="fa-regular fa-pen-to-square"></i></a>
                        </button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger" onclick="deleteTeacher('.$row['teachers_id'].')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
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
        $output = '1';
        echo $output;
    }
 
?>
