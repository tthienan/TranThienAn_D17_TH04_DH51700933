
<!DOCTYPE html>
<html>
<head>

</head>
<body>

	
      <center>
		<div class="container-fluid"> 
 <div class="row-fluid"> 
  <div class="col-md-offset-4 col-md-4 " id="box" > 
   <h2>ĐĂNG NHẬP</h2> 
   <hr> 
   <form class="form-horizontal" action="" method="post" id="login_form"> 
    <fieldset> 
     <div class="form-group"> 
      <div class="col-md-12"> 
       <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
        <input name="email" placeholder="Email" class="form-control" type="email" required autofocus> 
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
        <hr><p > <a style="color: #333; text-decoration: none" href="index.php?view=dangky"> Chưa có tài khoản. Đăng ký</a></p>
       <button type="submit" name="login" class="btn btn-md btn-dark pull-right">Đăng nhập </button> 
      </div> 
     </div> 
    </fieldset> 
   </form> 
  </div> 
 </div>
</div>
  </center>

<?php
 
   // check đăng nhập
  if (isset($_SESSION['login'])) {
     header('location:index.php');
  }
  if(isset($_POST['login'])){
    $email=$_POST['email'];
    $matkhau=$_POST['pass'];
    $sql_dangnhap="select * from KhachHang where Email='$email' and MatKhau='$matkhau'";
    $run_dangnhap=mysqli_query($conn,$sql_dangnhap);
    $dangnhap=mysqli_fetch_array($run_dangnhap);
    $count_dangnhap=mysqli_num_rows($run_dangnhap);
    if($count_dangnhap==0){
      echo '<script>alert("Sai tài khoản hoặc mật khẩu ! Xin mời nhập lại .")</script>';
    }else{
      $_SESSION['login']=$dangnhap;
      
                      
      header('location:index.php');
      
    }
                
  }
?>
</body>
</html>