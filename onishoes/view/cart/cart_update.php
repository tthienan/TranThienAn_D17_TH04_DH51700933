<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php 
	session_start();
	include_once './../../config/database.php';
	// thêm vào giỏ hàng.
if(isset($_POST['action'])){
		$masp=$_POST['masp'];
		$slmua=$_POST['slmua'];
		$size= $_POST['size'];
		$mau=$_POST['mau'];
		$tk=$_POST['tk'];
		$action=$_POST['action'];
		$sql="select * from sanpham where MaSP=".$masp;
		$resulf=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($resulf);
		if($row){
		 	$sql1="select SoLuong from chitietsanpham where MaSP=".$row['MaSP']." and MaMau='".$mau."' and MaSize=".$size;
		    $rs=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_array($rs);$loisl=0;$loi=0;
			if($row1['SoLuong']>=$slmua){$loisl=0;
				$new_cart=array(array('MaSP'=>$row['MaSP'],'TenSP'=>$row['TenSP'],'SoLuong'=>$slmua,'Size'=>$size,'Mau'=>$mau,'DonGia'=>($row['DonGia']-$tk)));
				if(isset($_SESSION['cart_product'])){
					$found = false; // biến tìm
					
					foreach ($_SESSION['cart_product'] as $item_cart) {
					 	if(($item_cart['MaSP']===$masp) and ($item_cart['Size']===$size) and ($item_cart['Mau']===$mau)){
					 			if(($item_cart['SoLuong']+$slmua)>100){
					 				$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>($item_cart['SoLuong']),'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
					 				$found=true;
					 				$loi=1;
					 			}else{
					 				if(($item_cart['SoLuong']+$slmua)<=$row1['SoLuong']){
					 					$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>($item_cart['SoLuong'] + $slmua),'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
						 				$found=true;
						 				$loi=0;
						 				$loisl=0;
					 				}else{
					 					$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>($item_cart['SoLuong'] ),'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
						 				$found=true;
						 				$loi=0;
						 				$loisl=1;
					 				}
					 			
					 		}
					 	}
					 	else{ $loi=0;
					 			$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
					 	}				
					 }
					 if($found==false){
					 	$_SESSION['cart_product']=array_merge($cart,$new_cart);
					 } 
					 else{
					 	$_SESSION["cart_product"] = $cart;
					 }			
				}
				else{

					$_SESSION['cart_product']=$new_cart;
				}
		
			}else{
				$loisl=1;
			}
		}	
			
		if($action==='mua'){
			if($loisl===0){
				if($loi===0){
					header('location:./../../index.php?view=cart');
				}else{
					header('location:./../../index.php?view=cart&tb=sll');
				}
			}
			else{
				header('location:./../../index.php?view=cart&tb=hethang&t='.$row['TenSP'].'&s='.$size.'&m='.$mau);
			}
			
		}
		else{
			if($loisl===0){
				if($loi===0){
					header("location:./../../index.php?view=chitietsanpham&masp=".$masp);
				}else{
					header("location:./../../index.php?view=chitietsanpham&tb=sll&masp=".$masp);
				}
			}else{
				header('location:./../../index.php?view=chitietsanpham&masp='.$masp.'&tb=hethang&t='.$row['TenSP'].'&s='.$size.'&m='.$mau);
			}
		}
}
// cộng thêm số lượng mua sản phẩm vào giỏ hàng.
if(isset($_GET['cong'])){
	$masp=$_GET['masp'];
	$size=$_GET['size'];
	$mau=$_GET['mau'];$loisl=0;$t='';
		foreach($_SESSION['cart_product'] as $item_cart){
			$sql1="select SoLuong from chitietsanpham where MaSP=".$masp." and MaMau='".$mau."' and MaSize=".$size;
		    $rs=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_array($rs);
			if(($item_cart['MaSP']==$masp) and ($item_cart['Size']==$size) and ($item_cart['Mau']===$mau)) {
				$t=$item_cart['TenSP'];				
				if($item_cart['SoLuong']<10){
					if($row1['SoLuong']>$item_cart['SoLuong']){
						$loisl=0;
						$tang=$item_cart['SoLuong']+1;
						$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$tang,'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
					}
					else{
						$loisl=1;
						$tang=$item_cart['SoLuong'];
						$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$tang,'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);

					}
				}else{
					$loisl=0;
					$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
				}
				$_SESSION['cart_product']=$cart;
					header('location:./../../index.php?view=cart');
			}
			else{
				$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
				$_SESSION['cart_product']=$cart;
			}

		}
		if($loisl===0){
			header('location:./../../index.php?view=cart');
		}else{
			header('location:./../../index.php?view=cart&masp='.$masp.'&tb=hethang&t='.$t.'&s='.$size.'&m='.$mau);
		}
		
	}
// trừ số lượng mua sản phẩm vào giỏ hàng.
if(isset($_GET['tru'])){
	$masp=$_GET['masp'];
	$size=$_GET['size'];
	$mau=$_GET['mau'];
		foreach($_SESSION['cart_product'] as $item_cart){
			if(($item_cart['MaSP']==$masp) and ($item_cart['Size']==$size) and ($item_cart['Mau']===$mau)) {
				if($item_cart['SoLuong']>1){
					$tang=$item_cart['SoLuong']-1;
					$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$tang,'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
					
				}else{
					$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);

				}
				$_SESSION['cart_product']=$cart;
					header('location:./../../index.php?view=cart');
			}
			else{
				$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
				$_SESSION['cart_product']=$cart;
			}
		}
		header('location:./../../index.php?view=cart');
	}
// xóa 1 sản phẩm trong giỏ hàng.
if(isset($_GET['xoa1'])){
	$masp=$_GET['masp'];
	$size=$_GET['size'];
	$mau=$_GET['mau'];
		foreach($_SESSION['cart_product'] as $item_cart){
			if($item_cart['MaSP']==$masp && $item_cart['Size']==$size and ($item_cart['Mau']===$mau)){	
			}
			else{
				$cart[]=array('MaSP'=>$item_cart['MaSP'],'TenSP'=>$item_cart['TenSP'],'SoLuong'=>$item_cart['SoLuong'],'Size'=>$item_cart['Size'],'Mau'=>$item_cart['Mau'],'DonGia'=>$item_cart['DonGia']);
				
			}
			$_SESSION['cart_product']=$cart;
		header('location:./../../index.php?view=cart');
		}
	}
	//xoa toan bo giỏ hàng
	if(isset($_GET['xoaall'])){
		unset($_SESSION['cart_product']);
		header('location:./../../index.php?view=cart');
	}
	?>
</body>
</html>
