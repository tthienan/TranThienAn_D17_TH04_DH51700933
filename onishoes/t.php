<?php   
			if(isset($_GET['sx'])){
				$sx=$_GET['sx'];
				switch ($sx) {
					case 'price-ascending':
						$sx1=" ORDER BY DonGia ASC ";
						break;
					case 'price-descending':
						$sx1=" ORDER BY DonGia DESC ";
						break;
					default:
						$sx1=" ";
						break;
				}
				
			}
            // lấy danh mục sản phẩm nổi bật			
            $spnb="SELECT * FROM `danhmuc` WHERE `TenDM`=N'Sản Phẩm Nổi Bật' ";
            $query_spnb=mysqli_query($conn,$spnb);
            $kq_dm=mysqli_fetch_array($query_spnb);
            // lấy danh sách sản phẩm của sản phẩm nổi bật theo phân trang.
            if(isset($_GET['trang'])){
                $trang=$_GET['trang'];
                $sx1=$_GET['sx'];
            }
            else{ $trang=1;}

            $from =($trang-1)*12;

            $ds_spnb="SELECT * FROM `sanpham` WHERE `MaDM`=".$kq_dm['MaDM']." ".$sx1." LIMIT $from,12 ";
            $query_dssp=mysqli_query($conn,$ds_spnb);
            
        
   
?>
<div class="container-fluid ">
	<div class="container">
		<div class="row boderbot" >
			<h3 class="col-md-10 ft"> <?php echo mb_strtoupper($kq_dm['TenDM']); ?> </h3>
			<select name="SortBy" id="SortBy" onchange="validateSelectBox(this)" class="form-control form-control-sm col-2 form-horizontal">
			    <option value="default">Tùy chọn</option>
			    <option <?php if ($sx=='price-ascending') {echo 'selected';}?>
			     value="price-ascending">Giá từ thấp tới cao</option>
			    <option <?php if ($sx==='price-descending') {echo ' selected="selected"';}?>
			     value="price-descending">Giá từ cao tới thấp</option>
			</select>
		</div>

		<div class="row boderbot ">
			<?php while ($kq_dssp=mysqli_fetch_array($query_dssp)) {
	             // lấy tên nhà sản xuất sản phẩm nổi bật
	            $ncc="SELECT * FROM `nhacc` WHERE `MaNCC`=".$kq_dssp['MaNCC'];
	            $query_ncc=mysqli_query($conn,$ncc);
	            $kq_ncc=mysqli_fetch_array($query_ncc);
	         ?>
	         <div class="col-3 item">
	         	<div class="item2">
	         		<a  href="index.php?view=chitietsanpham&masp=<?php echo $kq_dssp['MaSP']; ?>" >
						<div><img src="./webroot/img/sanpham/<?php echo $kq_dssp['AnhNen'] ; ?>"  class="img-circle img-thumbnail item-img"></div>
						<div class="item-text ft text-center">
							<h6 ><?php echo $kq_dssp['TenSP']?></h6> 

				         	<p class="ft2 "><mark class="badge-danger "><?php echo number_format($kq_dssp['DonGia'], 0 , $b = "," , $a = "." ).' '.' VND' ; ?></mark></p>
				         	<p ><?php echo ($kq_ncc['TenNCC']) ; ?></p>
						</div>	 
					</a>
	         	</div>
	         		
	         
	         	
	         </div>
	        
		<?php } ?>
		</div>
	</div>
</div>
</div>  
    <!-- Phân trang -->
  
    <?php  
            $ds_spn1b="SELECT MaSP FROM `sanpham` WHERE `MaDM`=".$kq_dm['MaDM'];
            $query_dssp2=mysqli_query($conn,$ds_spn1b);
            $sosp=mysqli_num_rows($query_dssp2);
            $sotrang = ceil($sosp/12); ?> </div>
      <hr>
      <ul class="pagination justify-content-center">
         <?php for($x=1;$x<=$sotrang;$x++){ ?>
          <li class="page-item"><a class="page-link" href="?trang=<?php echo $x ?>&sx=<?php echo $sx1 ?>"><?php echo $x ;?></a></li>
          <?php } ?>
      </ul>

<!-- sắp xếp sản phẩm  -->
		<form action="" method="get" accept-charset="utf-8">
			 <input type="submit" name="sx" id="result" hidden>
		</form>    
        <script language="javascript">
            function validateSelectBox(obj){
                var options = obj.children;
                var html = '';
                for (var i = 0; i < options.length; i++){
                    if (options[i].selected){
                       document.getElementById('result').value =options[i].value;
                       jQuery('#result').click();
                    }
                }      
               
            }
        </script>
 <!-- end sắp xếp sản phẩm  -->

 <?php while ($kq_km=mysqli_fetch_array($query_km)) {
			        $km1="SELECT * FROM `khuyenmai` WHERE `MaKM`=".$kq_km['MaKM']." and NgayBD <='".$ngay."' and NgayKT >='".$ngay."'";
		            $query_km1=mysqli_query($conn,$km1);
		            while ($kq_km=mysqli_fetch_array($query_km1)) { ?>
		            	<div class="sale">
		            		<p ><?php if(isset($kq_km['KM_PT'])){echo ($kq_km['KM_PT']).'%';} ?></p>
		            		<p ><?php  if(isset($kq_km['TienKM'])){echo ($kq_km['TienKM']).'đ' ;} ?></p>
		            	</div>
		            	
			<?php	}
				 } ?>