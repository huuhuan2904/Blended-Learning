<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Class_Name = $_POST['class_name'];

$name_check = mysqli_query($conn, "select * from class where class_name = '$Class_name'");
if(mysqli_num_rows($name_check) > 0){
  $msg = "Tên lớp đã được sử dụng";
  header('location: class_management.php?msg='.$msg);
}else{
  $query = mysqli_query($conn, "INSERT INTO class (class_name)
  VALUES ('$Class_Name')");
  header('location: class_management.php');
}




// if ($query) {
//   echo "<script>alert('Dữ liệu đã được thêm vào bảng thành công!');</script>";
// } else {
//   echo "<script>alert('lỗi');</script>";
// }

?>