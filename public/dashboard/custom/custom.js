$(document).ready(function () {

    // Confirm Delete

    $('.confirm').on('click', function (e) {
        e.preventDefault();
        var deleteBtn = $(this);
        swal({
            title: "هل انت متأكد ؟",
            text: "",
            icon: "warning",
            buttons: ['لا','نعم'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    deleteBtn.closest('form').submit();

                } else {
                    swal("لم يتم الحذف");
                }
            });

        console.log('done!');
    });

    // Image Previw 

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-file').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }

    }

    $("#image-input").change(function () {

        readURL(this);

    });

    // Make notification read


    $('.notification-bell').on('click',function(){
        var link  = $(this).attr('data-link'),
            span  = $(this).find('.label');  
        $.ajax({
            url:link,
            success:(data) => {
                if ( data.readed )
                {
                    span.text('0');
                }
            }
        })
    });

    // Ajax Change Shipping Status


    $('.change_status_btn').on('click',function(e){
        e.preventDefault();
        var form             = $(this).parent().parent(),
            url              = form.attr('action'),
            data             = form.serialize(),
            modal            = $("#" + $(this).attr('data-id')),
            modalBtn         = $('#btn-' + form.attr('data-id')),
            shippingStatusTd = modalBtn.parent().next().next(); 

        $.ajax({
            url:url,
            type:'POST',
            data,
            success:function(data){
                
                console.log(modalBtn);
                shippingStatusTd.text(data.status);
                modal.modal('hide');
                

            },

            error:function(err){
                console.log(err);
            }
        })
       
    })





});