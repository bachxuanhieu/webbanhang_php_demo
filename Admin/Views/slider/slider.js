    $(document).ready(function(){

        // phương thức ẩn =================================================================
        $('tbody').on('click','.toggle-show-status',function(){
            var sliderId = $(this).attr('data-slider-id');
            // alert(sliderId);
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/slider/toggleStatus/'+ sliderId,
                success: function(responre){
                    if(responre.success){   
                        // alert('hieu dep trai');
                        
                        updateSliderTable(responre.sliders);
                    }else{
                        alert('hiếu vẫn đẹp trai thôi')
                    }
                },
                error: function(){
                    alert('Lỗi r hiếu đẹp trai')
                }
            });
        });



        // phương thức hiện thị =================================================================
        $('tbody').on('click','.toggle-hidden-status',function(){
            var sliderId = $(this).attr('data-slider-id');
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/slider/toggleStatus/'+ sliderId,
                success: function(responre){
                    if(responre.success){   
                        // alert('hieu dep trai');
                        updateSliderTable(responre.sliders);
                    }else{
                        alert('hiếu vẫn đẹp trai thôi')
                    }
                },
                error: function(){
                    alert('Lỗi r hiếu đẹp trai')
                }
            });
        });
        // phương thức xóa=======================================================================
        $('tbody').on('click','.delete-slider',function(){
            var sliderId = $(this).attr('data-slider-id');
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/slider/deleteSlider/'+ sliderId,
                success: function(responre){
                    if(responre.success){   
                        $('.deleteslider').modal('hide');

                        // alert("hieu dep trai");
                        updateSliderTable(responre.sliders);
                    }else{
                        alert('hiếu vẫn đẹp trai thôi')
                    }
                },
                error: function(){
                    alert('Lỗi r hiếu đẹp trai')
                }
            });
        });

        // Phương thức sửa======================================================================
        // $('tbody').on('click','.edit-slider',function(){
        //     var sliderId = $(this).attr('data-slider-id');
        //     $.ajax({
        //         type: 'POST',
        //         url: '<?php echo BASE_URL ?>/admin/slider/deleteSlider/'+ sliderId,
        //         success: function(responre){
        //             if(responre.success){   
        //                 $('.deleteslider').modal('hide');

        //                 // alert("hieu dep trai");
        //                 updateSliderTable(responre.sliders);
        //             }else{
        //                 alert('hiếu vẫn đẹp trai thôi')
        //             }
        //         },
        //         error: function(){
        //             alert('Lỗi r hiếu đẹp trai')
        //         }
        //     });
        // });







        // phương thức cập nhật lại bảng =======================================================

        function updateSliderTable(sliders) {
            var tbody = $('tbody');
            tbody.empty();
        
            $.each(sliders, function (index, slider) {
                var statusText = slider.status_slider == 1 ? "Không" : "Có";
        
                var row = '<tr>' +
                    '<td>' + slider.id_slider + '</td>' +
                    '<td><img src="<?php echo BASE_URL ?>/public/uploads/slider/' + slider.image_slider + '" height="100" width="100" alt=""></td>' +
                    '<td>' + slider.title_slider + '</td>' +
                    '<td>' + statusText + '</td>' +
                    '<td>' +




                    '<button data-bs-toggle="modal" data-bs-target="#deleteslider'+slider.id_slider+'" class="btn btn-danger btn-sm m-1">Xóa</button>' +
                    '<div class="modal fade deleteslider" id="deleteslider'+slider.id_slider+'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">' +
                    '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header">' +
                    '<h5 class="modal-title" id="deleteslider'+slider.id_slider+'">Xóa bài viết</h5>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    'Dữ liệu bài viết sẽ bị xóa. Bạn có muốn xóa?' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-info m-1" data-bs-dismiss="modal">No</button>' +
                    '<button data-slider-id="'+slider.id_slider+'" type="button" class="btn btn-danger delete-slider">Yes</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +









                    '<a href="<?php echo BASE_URL ?>/admin/slider/editslider/' + slider.id_slider + '" class="btn btn-info btn-sm m-1 edit-slider">Sửa</a>';
        
                if (slider.status_slider == 1) {
                    row += '<button class="btn btn-success btn-sm toggle-show-status" data-slider-id="' + slider.id_slider + '">Hiển thị</button>';
                } else {
                    row += '<button class="btn btn-warning btn-sm toggle-hidden-status" data-slider-id="' + slider.id_slider + '">Ẩn</button>';
                }
        
                row += '</td></tr>';
        
                tbody.append(row);
            });
        }
        
    })