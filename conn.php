<?php 
$host = 'localhost';
$db='bao_cao_web';
$user ='root';
$pass = '';
$conn =  mysqli_connect($host,$user,$pass,$db);
if(!$conn) {
  echo 'kết nối lỗi';
}
?>