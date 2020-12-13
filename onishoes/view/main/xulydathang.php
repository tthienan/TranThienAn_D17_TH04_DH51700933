<?php 
session_start();
include_once('./../../config/database.php');

$nn=$_POST['nn'];//người nhận hàng
$dcnn=$_POST['dcnn']; //địa chỉ người nhận
$sdtnn=$_POST['sdtnn'];//số điện thoại người nhận
$kh=$_SESSION['login'];$makh=$kh['MaKH'];
$tt=$_POST['tt'];
$sql="INSERT INTO `hoadon`(`MaKH`,  `TinhTrang`, `TongTien`) VALUES ($makh,N'chưa duyệt',$tt)";
$rs=mysqli_query($conn,$sql);
if($rs){
	$sql2="select MaHD from hoadon where MaKH=$makh and TongTien=$tt ORDER BY MaHD DESC limit 1";
	$rs2=mysqli_query($conn,$sql2);
	$kq2=mysqli_fetch_array($rs2);$mahd=$kq2['MaHD'];
	foreach ($_SESSION['cart_product'] as $item) {
		$ttt=($item['SoLuong']*$item['DonGia']);
		$masp=$item['MaSP']; $sl=$item['SoLuong']; $dg=$item['DonGia']; $mamau=$item['Mau']; $size=$item['Size'];
$sql3="INSERT INTO `chitiethoadon`(`MaHD`, `MaSP`, `SoLuong`, `DonGia`, `ThanhTien`, `Size`, `MaMau`) VALUES($mahd,$masp,$sl,$dg,$ttt,$size,'$mamau')";
		$rs3=mysqli_query($conn,$sql3);

		$sql_sl="UPDATE `chitietsanpham` SET `SoLuong`=(`SoLuong`-'$sl') WHERE `MaSP`='$masp' and `MaSize`='$size' and `MaMau`='$mamau'";
		$rs_sl=mysqli_query($conn,$sql_sl);
	}
	if($rs3){
		if($rs_sl){
			$sql4="INSERT INTO `nguoinhan`(`MaHD`, `TenNN`, `DiaChiNN`, `SDTNN`) VALUES($mahd,'$nn','$dcnn',$sdtnn)";
			$rs4=mysqli_query($conn,$sql4);
			if($rs4){
				unset($_SESSION['cart_product']);
				header('location:/onishoes/index.php?view=thanks');
			}
		}
		
		
	}
	
}
?>