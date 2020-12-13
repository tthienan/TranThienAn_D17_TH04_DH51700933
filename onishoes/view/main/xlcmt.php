<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
<?php
	 session_start(); 
	 include_once './../../config/database.php';
	if(isset($_SESSION['login'])){
			$tenkhh=$_SESSION['login'];
			$nd=$_GET['nd'];
			$masp=$_GET['masp'];
			$sql6="INSERT INTO `binhluan`( `MaSP`, `MaKH`, `NoiDung`) VALUES('$masp',".$tenkhh['MaKH'].",'$nd')";
			$query6=mysqli_query($conn,$sql6);
			if ($query6) {
				header('location:/onishoes/index.php?view=chitietsanpham&masp='.$masp."&a='");
			}
			
	} 
	else {
		header('location:/onishoes/index.php?view=login');
	}
?>