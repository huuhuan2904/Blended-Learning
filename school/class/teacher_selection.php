<?php

if(isset($_POST["teacher_id"])){
    $output = '';

    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    
    $query = "SELECT teachers.*, logins.*, teachers.id AS teachers_id FROM teachers JOIN logins ON teachers.login_id = logins.id WHERE teachers.id = '".$_POST["teacher_id"]."'";
    $result = mysqli_query($conn,$query);

    $output .= '
      <div style="padding: 30px">
        <table class="table table-bordered">
          <tr class="title_style" style="background-color: #007BFF; color: white">
            <th> Họ tên </th>
            <th> Ngày sinh </th>
            <th> Giới tính </th>
            <th> Địa chỉ </th>
            <th> Số điện thoại </th>
            <th> Email </th>
          </tr>';

                    while($row = mysqli_fetch_array($result))
                    {
                        $output .= '
                        <tr>
                            <td>'.$row['name'].' </td>
                            <td>'.date('d-m-Y', strtotime($row['dob'])).'</td>
                            <td>'.$row['gender'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.$row['phone'].'</td>
                            <td>'.$row['email'].'</td>
                        </tr>';
                    }                                                  
        $output .= "</table>
        </div>";
  echo $output;
}