<!DOCTYPE html>
<html>
<head>
</head>
<body>

	<div class="login">
    </div>
    <div class="login2">
      <center>
		<div class="container-fluid"> 
 <div class="row-fluid"> 
  <div class="col-md-offset-4 col-md-4 nenbac" id="box" > 
   <h2>Đăng Ký</h2> 
   <hr> 
   <form class="form-horizontal" action="" method="post" id="login_form"> 
    <fieldset> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
        <input name="tenkh" placeholder=" Họ và Tên" class="form-control" type="text" required autofocus> 
       </div> 
      </div> 
     </div> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
        <input name="email" placeholder="Email" class="form-control" type="email" required autofocus> 
       </div> 
      </div> 
     </div> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
        <input name="SDT" placeholder="Số Điện Thoại" class="form-control" type="text" required autofocus> 
       </div> 
      </div> 
     </div> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
        <input name="diachi" placeholder=" Địa Chỉ" class="form-control" type="text" required autofocus> 
       </div> 
      </div> 
     </div> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> 
        <input name="pass" placeholder="Password" class="form-control" type="password" required> 
       </div> 
      </div> 
     </div> 
     <div class="form-group"> 
      <div class="col-md-12"> 
        <hr><p> <a href="index.php?view=login"> Đã có tài khoản. Đăng Nhập</a></p>
       <button type="submit" name="dangky" class="btn btn-md btn-danger pull-right">Đăng Ký </button> 
      </div> 
     </div> 
    </fieldset> 
   </form> 
  </div> 
 </div>
</div>
  </center>
</div>

<?php


  if(isset($_POST['dangky'])){
      $tenkh=$_POST['tenkh'];
      $email=$_POST['email'];
      $sdt=$_POST['SDT'];
      $diachi=$_POST['diachi'];
      $matkhau=$_POST['pass'];
      $sql_dangnhap="INSERT INTO `khachhang`( `TenKH`, `Email`, `SDT`, `DiaChi`, `MatKhau`) VALUES ('$tenkh','$email','$sdt','$diachi','$matkhau')";
      $run_dangky=mysqli_query($conn,$sql_dangnhap);
      
      if($run_dangky){
              header('location:index.php?view=login');
      }else{
      header('location:index.php?view=login');
      
    }
                
  }
?>
</body>
</html>