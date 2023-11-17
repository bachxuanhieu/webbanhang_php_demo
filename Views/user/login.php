


<div class="section">
<!-- container -->
<div class="container">
   <!-- row -->
   <div class="row">
      <div class="col-md-12">
         <!-- Billing Details -->
         <div class="billing-details">
            <div class="section-title">
               <h3 class="title">Đăng nhập</h3> <br/>
               <?php
               if(!empty($_GET['msg'])){
                  $msg=unserialize(urldecode($_GET['msg']));
                  foreach($msg as $key => $value){
                  echo '<span style="color:blue;">'.$value.'</span>';
                  }
                  }
               ?>
            </div>
            <!-- <div class="form-group">
               <input class="input" type="text" name="name" placeholder="Họ và tên">
               </div> -->
            <!-- <div class="form-group">
               <input class="input" type="text" name="phone" placeholder="Điện thoại">
               </div> -->
            <form autocomplete="off" action="<?php echo BASE_URL ?>/user/login_user" method="POST">
               <div class="form-group">
                  <input class="input" type="email" name="email" placeholder="Nhập email">
               </div>
               <div class="form-group">
                  <input class="input" type="password" name="password" placeholder="Nhập Password">
                  <a class="" href="<?php echo BASE_URL ?>/user/forgetPassword">Quên mật khẩu?</a>
               </div>
               <!-- <div class="form-group">
                  <input class="input" type="text" name="address" placeholder="Địa chỉ">
                  </div> -->
               <div class="form-group">
                  Bạn chưa có tài khoản? <a href="<?php echo BASE_URL ?>/user/register" style="color:red;"> Đăng ký ngay</a> 
                 
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-sm">Đăng nhập</button>
               </div>
            </form>
         </div>
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>