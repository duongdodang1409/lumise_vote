<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{{ csrf_token() }}">
	<title>Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

	<link rel="stylesheet" href="{{asset('backend/css/subdomainBundle.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/ChangelogWidgetBundle.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
</head>
<body>
    
	@include('backend.layouts.header')
	
	@yield('Content')


	@include('backend.layouts.footer')


	<script type="text/javascript" src="{{asset('backend/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/popper.js')}}"></script>
	<!-- <script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
	<script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
	<script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/jquery.fileupload.js')}}"></script> -->

    @yield('list_post_script')
    @yield('comment_script')

	<script type="text/javascript" src="{{asset('backend/js/main.js')}}"></script>

	

<script type="text/javascript">
    

    $('.detail_requests #edit_post').click(function(){
        $("#detail_postTitle").toggle();
        $("#detail_postContent").toggle();
        $("#list_post_image").toggle();
    });

    $('#comment_content').click(function(){
        $('.commentComposer .form-group-bottom').toggle();
    });



    var url = $('#get_url').val(); 
    var tag_id = $('#get_tag_id').val(); 

    var post_id = $('#post_id').val();
    var dem= 0; var dem2=0;
    function loadPreview(input){
       
        dem++;
        var id= dem+1;
        var data = $(input)[0].files;
        $.each(data, function(index, file){
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                var fRead = new FileReader();
                fRead.onload = (function(file){
                    return function(e) {
                        

                        $('#uploaded_images').append('<div class="uploaded_image"> <img class="thumb" src="'+e.target.result+'" /> <a href="#" class="img_rmv btn " data-image-id="'+dem+'" onclick="remove_image(this)"><span class="icon icon-x"></span></a> </div>');
                        $('#upload_image_button input').hide();
                        $('#upload_image_button').append('<input type="file" id="file-input_'+id+'" onchange="loadPreview(this)" name="image[]" />');

                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });

    }
   
    function image_previewComment(input){
        dem++;
        var id = dem+1;
        var data = $(input)[0].files;
        $.each(data, function(index, file){
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                var fRead = new FileReader();
                fRead.onload = (function(file){
                    return function(e) {
                        

                        $('#comment_upload_images').append('<div class="uploaded_image"> <img class="thumb" src="'+e.target.result+'" /> <a href="#" class="img_rmv btn " data-image-id="'+dem+'" onclick="remove_image(this)"><span class="icon icon-x"></span></a> </div>');
                        $('#comment_image_preview_btn input').hide();
                        $('#comment_image_preview_btn').append('<input type="file" id="file-comment_'+id+'" onchange="image_previewComment(this)" name="comment_image[]" />');

                    };
                })(file);
                fRead.readAsDataURL(file);
               
            }
        });
        
    }

    function image_previewReply(input){
        dem2++;
        var id = dem2+1;
        var data = $(input)[0].files;
        $.each(data, function(index, file){
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                var fRead = new FileReader();
                fRead.onload = (function(file){
                    return function(e) {
                        

                        $('#reply_upload_images').append('<div class="uploaded_image"> <img class="thumb" src="'+e.target.result+'" /> <a href="#" class="img_rmv btn " data-image-id="'+dem2+'" onclick="remove_image(this)"><span class="icon icon-x"></span></a> </div>');
                        $('#reply_image_preview_btn input').hide();
                        $('#reply_image_preview_btn').append('<input type="file" id="file-reply_'+id+'" onchange="image_previewReply(this)" data-image-reply="" name="comment_image[]" />');

                    };
                })(file);
                fRead.readAsDataURL(file);
               
            }
        });
        
    }

    function image_preview(input){
        dem++;
        var id = dem+1;
        var data = $(input)[0].files;
        var vi_tri = post_id;
        console.log(vi_tri);
        $.each(data, function(index, file){
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                var fRead = new FileReader();
                fRead.onload = (function(file){
                    return function(e) {
                        

                        $('#uploaded_images_'+vi_tri).append('<div class="uploaded_image"> <img class="thumb" src="'+e.target.result+'" /> <a href="#" class="img_rmv btn " data-image-id="'+dem+'" onclick="remove_image(this)"><span class="icon icon-x"></span></a> </div>');

                        $('#upload_image_button_'+vi_tri+ ' input').hide();
                        $('#upload_image_button_'+vi_tri).append('<input type="file" id="file-input_'+id+'" onchange="image_preview(this)" name="image[]" />');

                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    }

    $( "#uploaded_images" ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
    });
    $( "#uploaded_images_"+post_id ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
    });
    $( "#comment_upload_images" ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
    });
    $( "#reply_upload_images" ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
    });

    function remove_image(caller) {
        image_id = $(caller).attr('data-image-id');
        var id = 'file-input_'+image_id;
        var myobj = document.getElementById(id);
        myobj.remove();
    }

    var start_comment = 100;

    // $('#see_more_comment').click(function(){
    //    start_comment += 100;
    //    $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //         }
    //     });

    //        $.ajax({
    //         type : "POST",
    //         url : '{{URL::to('admin/comment/list_comment')}}',
    //         data:{'limit':start_comment},
    //         dataType: "json",

    //          success:function(response){
    //             if(response.status == 1){
                    
    //                 load_comment(response.message);
    //             }
              
              
    //         }
    //        })
    // });


    $('#form_edit_post').on('submit', function(e){
        e.preventDefault();
        var route = $('#form_edit_post').data('route');
        console.log(route);

        $.ajax({
            type: "POST",
            url: route,
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,

            success: function(data){
                if(data.status == 0){
                    alert(data.message);
                }
                
                if(data.status == 1){
                    window.location = data.route;
                }
            }
        })
    });
    
    function reply(caller){
        commentID = $(caller).attr('data-commentID');
        $(".form-reply").insertAfter($('.comment_body_'+commentID));
        var el = document.querySelector('#form_reply_comment input[name="parent_comment_id"]');
        el.setAttribute('value', commentID);

        // $('.content_post').each(function(){
        //     console.log('dung');
        // });

        $('.form-reply').toggle();
    }
    
        
    
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.postImages');
    baguetteBox.run('.comment_image');
</script>

</body>
</html>