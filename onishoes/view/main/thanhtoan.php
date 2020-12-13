<?php 
	if (!isset($_SESSION['login'])) {
		 header('Location:?view=login');
	}
	$kh=$_SESSION['login']; 
?>
<div class="container">
	<div class="container-fluid">
		<div class="row boderbot">
			<div class="col-md-10 ft ta">
				<h5><a href="index.php?view=cart">GIỎ HÀNG </a> -> THANH TOÁN</h5>
			</div>
		</div>
	<form action="view/main/xulydathang.php" method="POST" accept-charset="utf-8">
		<div class="row boderbot card-footer">
			<div class="col-md-7  ft2 "> 
			<center>
				<div class="col-md-12  boderbot">
					<h6>Địa Chỉ Giao Hàng</h6>
				</div><br>
				<div class="col-md-9">
					<input type="text" class="form-control" name="nn" placeholder=" &nbsp; Họ và Tên" required  value="<?php echo $kh['TenKH']?>"><br>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dcnn" placeholder=" &nbsp; Địa Chỉ" required value="<?php echo $kh['DiaChi']?>"><br>
				</div>
				<div class="col-md-9">
				 	<input type="text" class="form-control" name="sdtnn" placeholder=" &nbsp; Sô điện thoại" required value="<?php echo $kh['SDT']?>"><br>
				</div>
				<div class="col-md-9" ><hr>
					<button type="submit" class="btn-sm btn btn-secondary btn-lg btn-block" value="dathang" name="action"> Đặt Hàng </button>
				</div>
			</center>
			</div>
			<div class="col-5 ft2">
				<div class="col-md-12  boderbot">
					<center><h6>Phương thức thanh toán</h6></center>
				</div><br>
				<div class="boder1">
					    <div class="custom-control custom-checkbox" >
					      <input type="radio" class="custom-control-input" id="customCheck1"  checked>
					      <label class="custom-control-label" for="customCheck1">Thanh toán  khi nhận hàng</label>
					    </div>
					    <div class="custom-control custom-checkbox" >
					      <input type="radio" class="custom-control-input" id="customCheck2"  disabled >
					      <label class="custom-control-label" for="customCheck2"> Thanh toán online <label style="font-size: 15px;">(coming soom)</label></label>
					    </div> 						
				</div>
		
				<div class="col-md-12  boderbot">
					<hr>
					<center><h6>Hóa Đơn</h6></center>
				</div><br>
				
				<?php $tgt=0; foreach ($_SESSION['cart_product'] as $key) { $tt=$key['SoLuong']*$key['DonGia'];?>
				<div class="dh row">
					<div class="col-md-9 ">
						<label ><?php echo $key['SoLuong'].' x ';?><?php echo $key['TenSP']. ' - '.$key['Mau'].'/'.$key['Size'];?></label>
					</div>
					<div class="col-md-3 ">
						<label ><?php  echo number_format($tt).'đ';$tgt=$tgt+$tt ?></label>
					</div>
				</div>		
				<?php	}?>
				<hr>
				<div class="dh row">
					<div class="col-md-9 "><label > Tạm tính : </label></div>
					<div class="col-md-3"><label ><?php echo number_format($tgt).'đ';?></label></div>
				</div>
				<div class="dh row">
					<div class="col-md-10 "><label > Phí vận chuyển : </label></div>
					<div class="col-md-2"><label >0 đ</label></div>
				</div>	
				<hr>
				<div class="dh row">
					<div class="col-md-9 "><label > Tổng : </label></div>
					<div class="col-md-3 "><label ><?php echo number_format($tgt).'đ';?></label></div>
					<input hidden name="tt" value="<?php echo $tgt ?>">
				</div>
			</div>
		</div>
	</form>	
	</div>
</div>