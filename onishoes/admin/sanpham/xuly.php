
<?php
include_once('../../config/database.php');	
	// Thêm Sản Phẩm
		if(isset($_POST['xlthem'])){
			$tensp=$_POST['tensp'];
			$madm=$_POST['madm'];
			$mancc=$_POST['mancc'];
			$dongia=$_POST['dongia'];
			$anhnen=$_FILES['anhnen']['name'];
			$AnhSP_tmp=$_FILES['anhnen']['tmp_name'];
			move_uploaded_file($AnhSP_tmp,'../../webroot/img/sanpham/'.$anhnen);
			$size=$_POST['size'];
			$mau=$_POST['mau'];
			if(isset($_POST['mota'])){$mota=$_POST['mota'];}else{$mota=NULL;}
     		 $sql_them=" INSERT INTO `sanpham`(`MaSP`, `TenSP`, `MaDM`, `MaNCC`, `MoTa`, `DonGia`, `MaAnh`, `AnhNen`) VALUES (NULL,'$tensp',$madm,$mancc,'$mota',$dongia,NULL,'$anhnen')";
			$rs_them=mysqli_query($conn,$sql_them);
				if(isset($rs_them)){
					$sql_masp="select MaSP from sanpham where TenSP='$tensp' ORDER BY MaSP DESC";
					$sr=mysqli_query($conn,$sql_masp);$qk=mysqli_fetch_array($sr);	
					if(isset($qk)){
						(int) $so =$qk['MaSP'];
						 foreach ($size as $key1 => $values1){
						 	foreach ($mau as $key => $values) {
								$sql_ctsp="insert into chitietsanpham(MaSP,MaSize,MaMau) values('$so','$values1','$values')";
								$rs_ctsp=mysqli_query($conn, $sql_ctsp);
						 	}
						 }header('location:../index.php?action=sanpham&view=themsp&thongbao=them');
					}else{
					header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
				}
				
				
			}

		}
	//-----------------------------------------------------------------------------------------	
			// cập nhập Sản Phẩm
		if(isset($_POST['xlsua'])){
			$masp=$_POST['masp'];
			$tensp=$_POST['tensp'];
			$madm=$_POST['madm'];
			$mancc=$_POST['mancc'];
			$dongia=$_POST['dongia'];
			if(isset($_FILES['anhnen'])){
				$anhnen=$_FILES['anhnen']['name'];
				$AnhSP_tmp=$_FILES['anhnen']['tmp_name'];
				move_uploaded_file($AnhSP_tmp,'../../webroot/img/sanpham/'.$anhnen);}else{$anhnen=false;}
			$size=$_POST['size'];
			$mau=$_POST['mau'];
			if(isset($_POST['mota'])){$mota=$_POST['mota'];}else{$mota=NULL;}
			if($anhnen){
				$sql_them=" UPDATE `sanpham` SET `TenSP`='$tensp',`MaDM`='$madm',`MaNCC`='$mancc',`MoTa`='$mota',`DonGia`='$dongia',`AnhNen`='$anhnen' WHERE `MaSP`='$masp'";
			}else{
				$sql_them=" UPDATE `sanpham` SET `TenSP`='$tensp',`MaDM`='$madm',`MaNCC`='$mancc',`MoTa`='$mota',`DonGia`='$dongia' WHERE `MaSP`='$masp'";
			}
			$rs_them=mysqli_query($conn,$sql_them);
				if(isset($rs_them)){
					$sql_xoa="DELETE FROM `chitietsanpham` WHERE MaSP='$masp'";	$sr2=mysqli_query($conn,$sql_xoa);
					if(isset($sr2)){
						$sql_masp="select MaSP from sanpham where TenSP='$tensp' ORDER BY MaSP DESC";
						$sr=mysqli_query($conn,$sql_masp);$qk=mysqli_fetch_array($sr);	
						if(isset($qk)){
							(int) $so =$qk['MaSP'];
								 foreach ($size as $key1 => $values1){
								 	foreach ($mau as $key => $values) {
										$sql_ctsp="insert into chitietsanpham(MaSP,MaSize,MaMau) values('$so','$values1','$values')";
										$rs_ctsp=mysqli_query($conn, $sql_ctsp);
								 	}
								 }header('location:../index.php?action=sanpham&view=themsp&thongbao=sua');
							}else{
							header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
						}
						
					}
					
				
			}
     		 	
		}
			

		
	//-----------------------------------------------------------------------------------------	
	// Xóa Sản Phẩm
		if(isset($_GET['xoa'])){
			$masp=$_GET['masp'];
			$delete="DELETE FROM `chitietsanpham` WHERE MaSP = $masp";
			$rs_d=mysqli_query($conn,$delete);
			if(isset($rs_d)){
				$delete2="DELETE FROM `sanpham` WHERE MaSP = $masp";
				$rs_d2=mysqli_query($conn,$delete2);
				if(isset($rs_d2)){
					header('location:../index.php?action=sanpham&view=themsp&thongbao=xoa');
				}
				else{
					header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
				}
			}
		}    	

		//-----------------------------------------------------------------------------------------	
		// Thêm màu 
		
		 ?>		
