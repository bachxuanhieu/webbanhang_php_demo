<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Quên mật khẩu</h3>
                    </div>
                    <form id="forgotPasswordForm" method="POST">
                        <div class="form-group">
                            <input  class="input" type="email" name="email" id="email" placeholder="Nhập Email của bạn">
                        </div>
                        <button type="button" class="btn btn-info" id="forgotPasswordButton">Gửi</button>
                    </form>
                    <div id="message" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#forgotPasswordButton').on('click',function(e)
        {
            e.preventDefault();
            var email = $('#email').val();

            // alert(email);
            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>/user/resetPassword',
                data: {
                    email:email
                },
                success:function(response){
                    console.log(response);
                    if(response.status === 'success'){
                        $('#message').html(response.message)
                    }else{
                        $('#message').html('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                    }
                },
                error: function() {
                $('#message').html('Có lỗi xảy ra khi gửi yêu cầu đặt lại mật khẩu.');
                }
            })
        })
    })
</script>