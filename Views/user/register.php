<div class="section">
<!-- container -->
<div class="container">
   <!-- row -->
   <div class="row">
      <div class="col-md-12">
         <!-- Billing Details -->
         <div class="billing-details">
            <div class="section-title">
               <h3 class="title">Đăng ký</h3>
            </div>
            <form autocomplete="off" action="<?php echo BASE_URL ?>/user/insert_user" method="POST">
            <div class="form-group">
               <input class="input" type="text" name="txtname" placeholder="Họ và tên">
               </div>
            <div class="form-group">
               <input class="input" type="number" name="txtphone" placeholder="Điện thoại">
               </div>
            
               <div class="form-group">
                  <input class="input" type="email" name="txtemail" placeholder="email">
                  <?php
                     if(!empty($_GET['msg'])){
                     $msg=unserialize(urldecode($_GET['msg']));
                     foreach($msg as $key => $value){
                     echo '<span style="color:red;">'.$value.'</span>';
                     }
                     }
                  ?>

               </div>
               <div class="form-group">
                  <input class="input" type="password" name="txtpassword" placeholder="Password">
               </div>
               <div class="form-group">
                  <input class="input" type="text" name="txtaddress" placeholder="Địa chỉ">
                  </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-sm">Đăng ký</button>
               </div>
            </form>
         </div>
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>