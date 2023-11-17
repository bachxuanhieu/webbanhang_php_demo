$(document).ready(function(){
    // xóa đơn hàng===============================================================
    $('tbody').on('click', '.delete-order', function () {
        var order_code = $(this).attr('data-order-code');
        var rowToRemove = $(this).closest('tr');
        // alert(order_code);
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL ?>/admin/order/deleteOrder",
            data: {
                order_code: order_code
            },
            dataType: 'json',
            success: function(responre){
                console.log(responre);
                if(responre.status === 'true'){
                    alert(responre.message);
                    $('#deleteOrderModal_'+order_code).modal('hide');
                    rowToRemove.remove();
                }else{
                    alert("Xóa đơn hàng thất bại");
                }
            }
        })
   })
//    xác nhân đơn hàng =========================================================
   $('.orderSubmit').on('click', function(){
        var orderCode = $(this).attr('data-code-id');
        // alert(orderCode);
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/order/order_confirm/'+orderCode,
            success:function(response){
                if(response.success){
                    alert("Đã xác nhận đơn hàng");
                    
                }else{
                    alert("Xác nhận đơn hàng thất bại")
                }
            },error: function(){
                alert("Kết nối máy chủ thất bại");
            }
        })
   });
// ==================================tìm kiếm sản phẩm theo code ========================================================================
    $('#searchForm').submit(function(e){
        e.preventDefault();
        var keyword = $('#searchInput').val();
        //  alert(keyword);
        $.ajax({
            type:'GET',
            url: '<?php echo BASE_URL ?>/admin/order/searchOrder',
            data: { keyword: keyword },
            success: function(responre){
                if(responre.success){
                    updateOrderTable(responre.orders);
                }else{
                    alert("Không tìm thấy đơn hàng")
                }
            }, error:function(){
                alert("Lỗi kết nối máy chủ!!!")
            }
        })
   });


// ========================================================== lọc đơn hàng theo ngày =====================================================
    $('#filterByDate').on('click', function () {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo  BASE_URL ?>/admin/order/filterOrdersByDate',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status === "true") {
                    updateOrderTable(response.orders);
                } else {
                    // updateOrderTable(response.orders);
                    alert('Không tìm thấy đơn hàng');
                }
            },
            error: function () {
                alert('Lỗi kết nối máy chủ!!!');
            }
        });
    });



   function updateOrderTable(orders){
    var tbody= $('tbody');
    tbody.empty();
        $.each(orders, function(index, order) {
            var statusColor = order.order_status == 0 ? 'red' : 'green';
            var statusText = order.order_status == 0 ? 'Đơn hàng mới' : 'Đơn hàng đã xử lý';

            var row = '<tr>' +
                '<td>' + order.order_id + '</td>' +
                '<td>' + order.order_code + '</td>' +
                '<td>' + order.order_date + '</td>' +
                '<td>' + '<span style="color:' + statusColor + '">' + statusText + '</span>' + '</td>' +
                '<td>' +
                '<a href="' + "<?php echo BASE_URL ?>/admin/order/order_details/" + order.order_code + '" class="btn btn-success btn-sm">Xem chi tiết</a>' +


                '<button data-bs-toggle="modal" data-bs-target="#deleteOrderModal_'+ order.order_code+'" class="btn btn-danger btn-sm m-1">Xóa đơn hàng</button>' +
                        '<div class="modal fade" id="deleteOrderModal_' +order.order_code+'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">' +
                        '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header">' +
                        '<h5 class="modal-title" id="exampleModalLabel">Xóa đơn hàng viết</h5>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        'Dữ liệu đơn hàng sẽ bị xóa. Bạn có muốn xóa?' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-info m-1" data-bs-dismiss="modal">No</button>' +
                        '<button data-order-code="'+ order.order_code+'" type="button" class="btn btn-danger delete-order">Yes</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                '</td>' +
                '</tr>';

            tbody.append(row);
        });
     }
})