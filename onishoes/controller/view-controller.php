<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	if(isset($_GET['view'])){
		$view=$_GET['view'];
			switch ($view) {
                case 'chitietsanpham':
                    include('view/main/chitietsp.php');
                    break;
            case 'login':
                    include('view/main/login.php');
                    break; 
            case 'dangky':
                    include('view/main/dangky.php');
                    break;                	
            case 'binhluan':
                    $nd=$_GET['noidung'];
                    $masp=$_GET['msp'];
                    header("Location:./view/main/xlcmt.php?nd=".$nd."&masp=".$masp."&a=");
                    break;
            case 'cart':
                    include('view/main/giohang.php');
                    break;  
            case 'timkiem':
              		if(isset($_POST['btsearch'])){include('view/main/timkiem.php');}
                    break;
            case 'thanhtoan':
              			include('view/main/thanhtoan.php');
                    break;
            case 'dksanpham':
              			include('view/main/dksanpham.php');
                    break;
            case 'thanks':
              			include('view/main/camon.php');
                    break;
            case 'thongtinkhachhang':
                        include('view/main/khachhang.php');
                    break; 
            case 'about':
                        include('view/main/about.php');
                    break; 
            case 'hethong':
                        include('view/main/hethongcuahang.php');
                    break;                           
            default:
                     include('view/main/baohanh.php');
                    break;
        	}
	}
	else {
		 include('view/main/home.php');
	}
	if(isset($_GET['tb'])){
		$tb=$_GET['tb'];
		switch ($tb) {
			case 'hethang':
				$t=$_GET['t'];
				$s=$_GET['s'];
				$m=$_GET['m'];
				echo '<script>alert("Sản phẩm : '.$t.' - '.$m.'/'.$s.' Đã Hết Hàng.")</script>';
				break;
			case 'sll':
				echo '<script>alert("Bạn chỉ mua được 10 / mỗi sản phẩm. Vui lòng thanh toán sản phẩm đó để mua thêm")</script>';
				break;		
		}
}
?>
</body>
</html>