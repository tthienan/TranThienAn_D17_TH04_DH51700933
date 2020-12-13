<div class="container-fluid">
	<div class="container">
		<div class="row boderbot">
			<h3 class="col-md-10 ft"> <?php echo mb_strtoupper('Giỏ hàng'); ?> </h3>
		</div>
		<div class="row ">
<?php 	if(isset($_SESSION['cart_product'])){ ?>
			<table class="t1 "> 
				<thead>
					<tr  >
						<th colspan="2">Thông tin sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Tổng giá</th>
					</tr>
				</thead>
<?php 

	$stt=0; $money=0;	
		foreach ($_SESSION['cart_product'] as $item_cart) { 
				$sql8="SELECT * FROM `sanpham` WHERE MaSP=".$item_cart['MaSP'];
				$rs=mysqli_query($conn,$sql8);
				$kqa=mysqli_fetch_array($rs);
?>
				<tbody>
					<td class="td"><img class="img-gh" src="/onishoes/webroot/img/sanpham/<?php echo $kqa['AnhNen'];?>"></td>
					<td class="td2"><a href="index.php?view=chitietsanpham&masp=<?php echo $item_cart['MaSP']; ?>" ><p><?php echo $item_cart['TenSP'];?></p></a>
						<p><?php echo $item_cart['Size'];?> / <?php echo $item_cart['Mau'];?></p>
						<a href="/onishoes/view/cart/cart_update.php?xoa1=xoa&masp=<?php echo $item_cart['MaSP'];?>&mau=<?php echo $item_cart['Mau'];?>&size=<?php echo $item_cart['Size'];?>"><p>Xóa</p></a>
					</td>
					<td><?php echo number_format($item_cart['DonGia']).' ₫';?></td>
					<td><span class="input-group-btn">
							<a href="/onishoes/view/cart/cart_update.php?tru=tru&masp=<?php echo $item_cart['MaSP'];?>&mau=<?php echo $item_cart['Mau'];?>&size=<?php echo $item_cart['Size'];?>" title="">
								<button  class="nut-" <?php if($item_cart['SoLuong']<=1){echo 'disabled="disabled"';}?> type="button">-</button>
							</a>
						</span>
<!-- số lượng --> 		<span class="input-group-btn boder" >
							<input class="nutsl" type="text" value="<?php echo $item_cart['SoLuong'];?>">
						</span>			
<!-- Cộng số lượng -->	<span  class="input-group-btn boder">
							<a href="/onishoes/view/cart/cart_update.php?cong=cong&masp=<?php echo $item_cart['MaSP'];?>&mau=<?php echo $item_cart['Mau'];?>&size=<?php echo $item_cart['Size'];?>" title="">
								<button class="nutc" <?php if($item_cart['SoLuong']>=10){echo 'disabled="disabled"';}?> type="button">+</button>
							</a>
						</span>
					</td>
					<td><?php $tt=0; $tt1=$item_cart['SoLuong'] * $item_cart['DonGia']; $tt=$tt+$tt1;echo number_format($tt).' ₫';?></td>
				</tbody>
<?php 	$money=$money+$tt; }
	 ?>
				<?php if(isset($_SESSION['cart_product'])){echo '<td><a href="/onishoes/view/cart/cart_update.php?xoaall=xoaall" title="">xóa tất cả</a></td>	';}?><th></th><th></th>
					<th colspan="2" rowspan="2" class="tt" style="text-align: right;"> 
							<?php if(isset($_SESSION['cart_product'])){echo	'Tổng :  '.number_format($money).' ₫'; }?><br>
					</th>
			</table>

			<div class="col-8"></div>
			<div class="col-2" class="sa">
				<a href="index.php?"><input class="btn  btn-dark pull-right nutmua" type="button" name="" value="TIẾP TỤC MUA HÀNG"></a>
			</div>
			<div class="col-2" class="sa">
				<a href="index.php?view=thanhtoan"><input class="btn  btn-dark pull-right nutmua" type="submit" name="" value="THANH TOÁN"></a>
			</div>
			<?php }else{
				echo "<h3  style='margin-top:100px;margin-bottom:100px;margin-left:400px; '>Giỏ Hàng Của Bạn Trống ! </h3>";
			}  ?>
		</div>
	</div>
	
</div>