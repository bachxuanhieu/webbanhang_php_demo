
    $(document).ready(function(){
        $('.delete-new').on('click', function(){
            var newId = $(this).attr('data-new-id');
            // alert(newId);
            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>/admin/new/deletenew/'+newId,
                success:function(response){
                    if(response.success){
                        alert(response.message);
                        location.reload();
                    }else{
                        alert(response.message);
                    }
                },
                error:function(){
                    alert('Lỗi kết nối máy chủ');
                }
            });
        });
        $('.toggle-hidden-status').on('click', function(){
            var newId = $(this).attr('data-new-id');
            // alert(newId);
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/new/toggleStatus/'+newId,
                success:function(response){
                    if(response.success){
                        location.reload();
                        alert("Đã ẩn danh mục thành công, quya lại!")
                    }
                },
                error: function(){
                    alert("Lỗi kết nối máy chủ");
                }
            });
        });
        $('.toggle-show-status').on('click',function(){
            var newId = $(this).attr('data-new-id');
            // alert(newId);
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/new/toggleStatus2/'+newId,
                
                success: function(response) {
                    if (response.success) {
                        // Thay đổi văn bản của nút và cột "Trạng thái" dựa trên trạng thái mới
                        
                            location.reload();
                    } else {
                        alert('Lỗi khi thay đổi trạng thái');
                    }
                },
                error: function() {
                    alert('Lỗi kết nối máy chủ');
                }
            });
        });
    })
