
$(document).ready(function(){
   // ============================================================================ Nút Cộng trừ ==============================================================================================
   $('.update-quantity').on('click',function(e){
      e.preventDefault();
      var productId = $(this).attr('data-product-id');
      var productColorId = $('#product_color_id').val();
      var action = $(this).attr('data-action');
      var quantityElement = $(this).closest('td').find('.quantity');
      var subTotalElement = $(this).closest('tr').find('.subtotal');
      var orderTotalElement = $('.order-total'); // Tìm phần tử tổng thành tiền

      $.ajax({
         type: 'POST',
         url: '<?php echo BASE_URL ?>/cart/updateQuanlity',
         data: {
            productId: productId,
            action: action,
            productColorId: productColorId
         },
         dataType: 'json',
         success: function(data){
            if (data.status === 'success') {
               // Cập nhật số lượng sản phẩm trên giao diện
               quantityElement.text(data.new_quantity);
               // Cập nhật tổng thành tiền của sản phẩm
               subTotalElement.text(data.newTotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

               // Tính lại tổng giá trị thành tiền cho tất cả sản phẩm
               var newTotal = 0;
               $('.subtotal').each(function() {
                  newTotal += parseFloat($(this).text().replace(/[đ,.]/g, '').replace('₫', '').replace(',', '.'));
                  
               });

               // Cập nhật tổng thành tiền trên giao diện
               orderTotalElement.text(newTotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

            } else {
               alert(data.message);
            }
         },
         error: function(){
            alert('Có lỗi xảy ra khi cập nhật');
         }
      });
   });
   // ====================================================================== Nút xóa =========================================================================
   $('.deleteItemCart_button').on('click', function () {
      var productId = $(this).attr('data-product-id');
      var rowToRemove = $(this).closest('tr'); // Lưu trữ hàng sản phẩm để loại bỏ sau khi xóa
      var subTotalElement = $(this).closest('tr').find('.subtotal');
      var orderTotalElement = $('.order-total'); // Tìm phần tử tổng thành tiền
  
      $.ajax({
          type: 'POST',
          url: '<?php echo BASE_URL ?>/cart/deletecart/',
          data: {
              productId: productId,
          },
          dataType: 'json',
          success: function (data) {
              if (data.status === 'true') {
                  // Loại bỏ hàng sản phẩm khỏi bảng
                  rowToRemove.remove();
  
                  // Tính lại tổng giá trị thành tiền cho tất cả sản phẩm
                  var newTotal = 0;
                  $('.subtotal').each(function() {
                      // Loại bỏ ký tự không cần thiết và định dạng số tiền Việt Nam
                      newTotal += parseFloat($(this).text().replace(/[đ,.]/g, '').replace('₫', '').replace(',', '.'));
                  });
  
                  // Cập nhật tổng thành tiền trên giao diện với định dạng tiền tệ Việt Nam
                  orderTotalElement.text(newTotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
              } else {
                  alert(data.message);
              }
          },
          error: function () {
              alert('Có lỗi xảy ra khi xóa sản phẩm');
          }
      });
  });
  


   // LẤY ĐỊA CHỈ QUẬN HUYỆN==================================================
   $('#province').on('change', function(){
      var province_id = $(this).val();
      // alert(province_id);
      $.ajax({
         url:'<?php echo BASE_URL ?>/cart/getDistrict',
         method: 'GET',
         dataType: 'json',
         data:{
            province_id: province_id
         },
         success: function(data){
            $('#district').empty();
            // console.log(data);
            $.each(data, function(i, district){
               $('#district').append($('<option>',{
                  value: district.district_id,
                  text: district.name
               }));
            });
         },error: function(){
            alert('Lỗi rồi');
         }
      })
   });

   // LẤY ĐỊA CHỈ PHƯỜNG XÂ===================================================

   $('#district').on('change',function(){
      var district_id = $(this).val();
      // alert(district_id);
      if(district_id){
         $.ajax({
            url:'<?php echo BASE_URL ?>/cart/getWards',
            type: 'GET',
            dataType: 'json',
            data: {
               district_id: district_id
            },
            success: function(data){
               $('wards').empty();
               // console.log(data);
               $.each(data, function(i, wards){
                  $('#wards').append($('<option>',{
                     value: wards.wards_id,
                     text: wards.name
                  }));
               });
            },error: function(){
               alert('lỗi rồi');
            }
         })
      }
   })

   $('.buy_checked').change(function(){
      var id_cart = $(this).val();
      // alert(id_cart)
      if($(this).is(':checked')){
         var cart_status = 1;
         $.ajax({
            url: '<?php echo BASE_URL ?>/cart/update_status',
            type: 'POST',
            data:{
               id_cart: id_cart,
               status: cart_status
            },
            success: function(){
               console.log('check mua hàng');
            }
         });
      }else{
         var cart_status = 0;
         $.ajax({
            url: '<?php echo BASE_URL ?>/cart/update_status',
            type: 'POST',
            data:{
               id_cart: id_cart,
               status: cart_status
            },
            success: function(){
               console.log('check bỏ mua hàng');
            }
         });
      }
   });
   // =========================================================================đặt hàng==============================================================
   $('#submitOrderBtn').on('click', function (e) {
      e.preventDefault();
      // var productId = $(this).attr('data-product-id');
      // var productColorId = $('#product_color_id').val();
      var province = document.getElementById("province").value;
      var district = document.getElementById("district").value;
      var wards = document.getElementById("wards").value;
      var name = document.querySelector('input[name="name"]').value;
      var email = document.querySelector('input[name="email"]').value;
      var phone = document.querySelector('input[name="phone"]').value;
      var address = document.querySelector('input[name="address"]').value;

      // Kiểm tra xem có ít nhất một sản phẩm đã được chọn
      var atLeastOneProductChecked = $('.buy_checked').is(':checked');

      if (atLeastOneProductChecked) {
          if (province === "" || district === "" || wards === "") {
              alert("Vui lòng chọn đầy đủ thông tin địa chỉ Thành phố, Quận huyện, Phường xã.");
              return; // Ngăn chặn việc gửi biểu mẫu nếu thông tin chưa đầy đủ.
          }
          $.ajax({
              url: '<?php echo BASE_URL ?>/cart/addOrder',
              type: 'POST',
              data: {
             
                  name: name,
                  phone: phone,
                  email: email,
                  province: province,
                  district: district,
                  wards: wards,
                  address: address
              },
              success: function (response) {
                  console.log(response);
                  if (response.status === "success") {
                      alert('Đặt hàng thành công');
                      location.reload();
                  } else {
                      alert('Lỗi');
                  }
              },
              error: function () {
                  alert('Đặt hàng thành công');
                      location.reload();
              }
          });
      } else {
          alert('Bạn chưa chọn sản phẩm');
      }
  });
   
});


