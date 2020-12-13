<!--chi tiết sản phẩm-->
          
   <?php    $masp=$_GET['masp'];
            $sql="SELECT * FROM `sanpham` WHERE `MaSP`=$masp";
            $query=mysqli_query($conn,$sql);
            $kq=mysqli_fetch_array($query);
            $sql_ncc="SELECT TenNCC FROM `nhacc` WHERE `MaNCC`=".$kq['MaNCC'];
            $query2=mysqli_query($conn,$sql_ncc);
            $kq2=mysqli_fetch_array($query2);
            // lấy size sản phẩm và số lượng
            $sql_size="SELECT  DISTINCT MaSize FROM `chitietsanpham` WHERE `MaSP`=".$kq['MaSP'];
            $query3=mysqli_query($conn,$sql_size);
             $sql_size="SELECT DISTINCT MaMau FROM `chitietsanpham` WHERE `MaSP`=".$kq['MaSP'];
            $query4=mysqli_query($conn,$sql_size);
            //check khuyến mãi
             $km="SELECT * FROM `sanphamkhuyenmai` WHERE `MaSP`=".$masp;
            $query_km=mysqli_query($conn,$km);
            date_default_timezone_set('Asia/Ho_Chi_Minh');$date=getdate();
            $ngay=$date['year']."-".$date['mon']."-".($date['mday']);$a=0;$b=0;
             while ($kq_km=mysqli_fetch_array($query_km)) {
		        $km1="SELECT * FROM `khuyenmai` WHERE `MaKM`=".$kq_km['MaKM']." and NgayBD <='".$ngay."' and NgayKT >='".$ngay."'";
	            $query_km1=mysqli_query($conn,$km1);
	            while ($kq_km=mysqli_fetch_array($query_km1)) { 
	            		 if(isset($kq_km['KM_PT'])){ $b=$b+($kq_km['KM_PT']);} 
	            		 if(isset($kq_km['TienKM'])){ $a=$a+($kq_km['TienKM']);} 				            	
				}	
			} 
    ?>
<div class="container ">
	<form action="view/cart/cart_update.php" method="POST" accept-charset="utf-8">
       <input hidden name="masp" value="<?php echo $kq['MaSP']; ?>">
	<div class="row ">
		<div class="col-md-6  badge-light">
			<img class="img-ctsp" src="./webroot/img/sanpham/<?php echo $kq['AnhNen'];?>">
		</div>
		<div class="col-md-6 ">
			<h3 class="ft1"><?php echo mb_strtoupper($kq['TenSP']); ?></h3>
			<h6 class="ft4">Thương hiệu : <?php echo $kq2{'0'}; ?>&emsp;&emsp; MSP : <?php echo $masp ?></h6><br/>
<?php   $tk=0;	if ($a!==0 || $b!==0) {
				$t=0; if($b==0){$t=$kq['DonGia']-$a;$tk=$a;}else{$t=($kq['DonGia']-($kq['DonGia']*$b)/100)-$a;$tk=($kq['DonGia']*$b)/100+$a;} ?>
				<h5><mark class="text-danger"><?php echo  number_format($t, 0 , $c = "," , $d = "." )." ₫"; ?></mark></h5>
				<h6><?php echo  'Giá gốc : '.number_format($kq['DonGia'], 0 , $c = "," , $d = "." )." ₫"; ?></h6>
				<h6><?php echo  'Tiết kiệm : '.number_format($tk, 0 , $c = "," , $d = "." )." ₫"; ?></h6>
<?php 		}else{?><h5><mark><?php echo  number_format($kq['DonGia'], 0 , $c = "," , $d = "." )." ₫"; ?></mark></h5><?php }?>
			
			

			<div class="row ">
				<div class="col-9 "><hr/></div><div class="col-3 "></div>
				<div class="col-2 "><h5 class="ft2">MÀU: </h5></div>
				 <div class="btn-group  col-8 row ">
			        <?php   while($kq4=mysqli_fetch_array($query4)) { ?>
			          <div class=" custom-checkbox custom-control col-4 ">
			              <input type="radio" class="custom-control-input " id="<?php echo $kq4['MaMau'];?>" name="mau" value="<?php echo $kq4['MaMau'];?>" required>
			              <label class="custom-control-label " for="<?php echo $kq4['MaMau'];?>"><h6><?php echo $kq4['MaMau'];?></h6></label>
			          </div>
			        <?php } ?>
				</div>

			</div>
			<div class="row ">
				<div class="col-9 "><hr/></div><div class="col-3 "></div>
				<div class="col-2 "><h5 class="ft2">Size: </h5></div>
				<div class="btn-group  col-8 row ">
			        <?php   while($kq3=mysqli_fetch_array($query3)) { ?>
			          <div class=" custom-checkbox custom-control col-3 ">
			              <input type="radio" class="custom-control-input " id="<?php echo $kq3['MaSize'];?>" name="size" value="<?php echo $kq3['MaSize'];?>" required>
			              <label class="custom-control-label " for="<?php echo $kq3['MaSize'];?>"><h6><?php echo $kq3['MaSize'];?></h6></label>
			          </div>
			        <?php } ?>
				</div>
				<div class="col-9 "><hr/></div><div class="col-3 "></div>
			</div>
			<h6 class="ft2">Số lượng mua : <select  class="form-control-sm" name="slmua">
									<option  value="1">1</option> <option value="2">2</option> <option value="3">3</option>
                                    <option value="4">4</option> <option value="5"> 5</option> 
                        		 </select>
            </h6><br/>
			<div class="row ">
				<div class="col-9">
					
					<input hidden name="tk" value="<?php echo $tk; ?>">
					<button type="submit" name="action" value="them" class="btn-sm btn btn-block btn-dark pull-right">Thêm Giỏ Hàng 
						<i class="fas fa-cart-plus"></i></button>
				</div><div class="col-9"> &emsp;</div>
				<div class="col-9">
					<button type="submit" class="btn-sm btn btn-block btn-dark pull-right" name="action" value="mua">Mua Hàng 
						<i class="fas fa-cart-arrow-down"></i></button>	 
				</div>
         		   
			</div>		
	</div>
	</div></form>
	<div class="col-md-6 ">
			 <hr>
              <h4 class="ft1">Mô Tả :</h4>
              <p class="ft"><?php echo $kq['MoTa'];?></p>
	</div>
	<div class="col-md-6 "></div>
	<div class="col-md-6 ">
			 <hr>
              <?php include_once('view/main/binhluan.php');?>
	</div>
</div>