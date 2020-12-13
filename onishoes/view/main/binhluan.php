<?php   $sql_bl="SELECT * FROM `binhluan` WHERE `MaSP`='".$masp."' ORDER BY ThoiGian DESC ";
            $query4=mysqli_query($conn,$sql_bl);?>
           <h5>Bình Luận</h5><hr>
<?php 		while ( $kq4=mysqli_fetch_array($query4)) { 
				$sql5="SELECT TenKH FROM `khachhang` WHERE `MaKH`=".$kq4['MaKH'];
	            $query5=mysqli_query($conn,$sql5);
	            $kq5=mysqli_fetch_array($query5); ?>			
            <!--xem cmt -->
		    <div  class="row fonttt  badge-light" >
		    	<div class="col-md-3 ">
		        	<h1 style="margin-left: 15px;"><i class="fas fa-user"></i></h1> <?php echo $kq4['ThoiGian']; ?>
		        </div>
	           <div class="col-md-9">
	              <h6 style="color: #007bff;"><?php echo $kq5['TenKH']; ?></h6>
	              <h7> <?php echo $kq4['NoiDung'];?></h7>
	            </div>
				
			</div><hr>
			<!-- end xem cmt -->
<?php 		} ?>
<form name="bl" action="" method="get">
			<!-- cmt -->
			<hr>
			<div  class="row  " >
		    	<div class="col-md-12">
		        	<div class="form-group">
					  <label for="comment">Comment:</label>
					  <textarea class="form-control" rows="3"  name="noidung"></textarea>
					</div>
		        </div>
			</div>
			<div  class="row " >
		    	<div class="col-md-9"></div>
				<div class="col-md-3">
					
					<input hidden name="msp" value="<?php echo $masp ?>">
					<button name="view" value="binhluan" type="submit" class="btn btn-outline-info  " >Bình Luận</button>
				</div>
		    </div>
</form>
			<!--  xem cmt -->

 <style type="text/css"> .a{margin-top: -25px;margin-bottom: 5px;margin-left: 25px;}</style>   
    