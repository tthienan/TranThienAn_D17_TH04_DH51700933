<div class="container-fluid header">
	<div class="row ">
		<div class="col-md-4">
		<a href="index.php" title="">	<img class="logoimg" src="webroot/img/6.png" ></a>
		</div>
		<div class="col-md-3 ">
			<form action="index.php?view=timkiem" method="POST" accept-charset="utf-8">
				<div class="input-group tk">
	                <input class="form-control border-secondary py-2" name="search" type="search" placeholder="Search">
	                <div class="input-group-append">
	                    <button class="btn btn-outline-secondary" type="submit" name="btsearch">
	                        <i class="fa fa-search"></i>
	                    </button>
	                </div>
            	</div>
			</form>  
		</div>
		<div class="col-md-2 lh" style="padding-left:10px;"><a href="?view=hethong">Hệ Thống Cửa Hàng</a></div>
		<div class="col-md-2  lh"><a href="?view=baohanh.php">Bảo Hành</a></div>
		
		
	</div>
</div>
<div class="container-fluid menu" id="menu">
	<div class="row">
		<div class="col-md-8">
			<ul class=" menu-l">
				<li class="w"><a href="index.php" title="">Danh Mục <i class="fa fa-angle-down"></i></a>
					<ul class="sub-menu">
					<?php $dmsql="SELECT * FROM `danhmuc`";
                    $rss=mysqli_query($conn,$dmsql); 
                    while ($row=mysqli_fetch_array($rss)) { ?>	
						<li><a href="/onishoes/index.php?view=dksanpham&madm=<?php echo $row['MaDM'];?>&t=<?php echo $row['TenDM'] ?>" ><?php echo $row['TenDM'];?></a></li>
					<?php  } ?>
					</ul>
				</li>
				<li class="a2 w"></li>
				<li class="w"><a href="index.php" title="">Sản Phẩm <i class="fa fa-angle-down"></i></a>
					<ul class="sub-menu">
					<?php $dmsql="SELECT * FROM `nhacc`";
                    $rss=mysqli_query($conn,$dmsql);                 
                    while ($row=mysqli_fetch_array($rss)) { ?>
						<li><a href="/onishoes/index.php?view=dksanpham&mancc=<?php echo $row['MaNCC'];?>&t=<?php echo $row['TenNCC'] ?>" ><?php echo $row['TenNCC'];?></a></li>
					 <?php  } ?>
					</ul>
				</li>
				<li class="a2 w"></li>
				<li class="w"><a href="?view=about" title="">Giới Thiệu</a></li>
			</ul>
		</div>
		<div class="col-4 ">
			<ul class="menu-r">
				<?php 
			            if (isset($_SESSION['login'])) {  
			                  $ten=$_SESSION['login'];
			                 ?>
			                  <li class="w"><i class="fas fa-user-alt"></i>
			                  <ul class="sub-menu">
			                    <li>Hi, <?php echo $ten['TenKH']; ?></li>
			                    <li><a href="?view=thongtinkhachhang">Cập nhập thông tin</a></li>
			                    <li><a href="view/main/dangxuat.php">Logout</a></li>
			                </ul></li>
	     		 <?php  }else{
	     		 		echo '<li class="w"><a href="index.php?view=login" >Đăng Nhập</a>
				     		 		<ul class="sub-menu">
									<li><a href="index.php?view=dangky" title="">Đăng Ký</a></li>
									
								</ul>';
	     		 } ?>
				
					
				</li>
				<li class="cart1  r">
					<a href="index.php?view=cart" title="">
						Giỏ Hàng <i class="fa fa-shopping-bag"></i>
						<?php $dem=0;
	                        if(isset($_SESSION['cart_product'])){
	                          foreach ($_SESSION['cart_product'] as $item_cart){
	                            $dem2=$item_cart['SoLuong'];
	                            $dem=$dem+$dem2;
	                          }
                    	}?> 
                    	<?php echo '( '.$dem.' )'; ?>
					</a>
					 
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- menu cố định -->
<script >
        jQuery(document).ready(function($) {
        	//scoll top
        	$("#scrollTop").click(function(event){
        		$("#html,body").animate({scrollTop:0},"slow");
        	});
        	var temHeight = 0;
        	$(".thumbnail").each(function(){
        		current - $(this).height();
        		if(parseInt(temHeight) <parseInt(current)){
        			temHeight = current;
        		}
        	});

        	$(".bor-bot").css("height",temHeight+"px");

            pos=$("#menu").position();
            $(window).scroll(function(){
            	var posScroll = $(document).scrollTop();
            	if (parseInt(posScroll)>parseInt(pos.top)) {
            		$("#menu").addClass("fixed");

            	}
            	else{
            		$("#menu").removeClass("fixed");
            	}
            });
        });
    </script>