$(document).ready(function() {
	var url = $('#get_url').val();
	var commentID = 0;


	$('#form_add_comment').on('submit', function(event){
		event.preventDefault();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: url+"/admin/comment/add_comment",
			data: new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,


			success: function(data){
				if(data.status == 1){
					$('#list_comment').prepend(data.output);
					$('.commentComposer .form-group-bottom').hide();
					$('#comment_content').val("");
					$("#comment_upload_images").html("");

					document.querySelectorAll('#comment_image_preview_btn input[type="file"]').forEach(el => el.remove());
					$('#comment_image_preview_btn').prepend('<input type="file" id="file-comment_1" onchange="image_previewComment(this)" name="comment_image[]">');

				}
			}
		})

	});

	$('#form_reply_comment').on('submit', function(event){
		event.preventDefault();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: url+"/admin/comment/add_comment",
			data: new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,


			success: function(data){
				if(data.status == 1){
					$("#reply_upload_images").html("");
					$("#reply-content").val("");
					// var myobj = document.querySelector('#reply_image_preview_btn input[name="comment_image[]"]');
					// myobj.remove();
					document.querySelectorAll('#reply_image_preview_btn input[type="file"]').forEach(el => el.remove());
					$('#reply_image_preview_btn').prepend('<input type="file" id="file-reply_1" onchange="image_previewReply(this)" name="comment_image[]">');

					$(".form-reply").hide();
					
					$('.form-reply').next().prepend(data.output);
				}
			}
		})

	});

	getAllComment(post_id);
	var c = $('#com_parent').val();
	var com_parent = JSON.parse(c);
	for(var i=0; i< com_parent.length; i++){
		reply_comment(post_id,com_parent[i]);
	}

});


function reply_comment(post_id,com_parent){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$.ajax({
		type: "POST",
		url: url+"/admin/comment/get_reply",
		data: {'post_id': post_id, 'url': url, 'com_parent': com_parent},
		dataType:'JSON',

		success: function(data){
			if(data.status == 1){
				$('#replies_'+com_parent).html(data.output);
			}
		}
	})

}

function getAllComment(post_id){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$.ajax({
		type: "POST",
		url: url+"/admin/comment/get_comment",
		data: {'post_id': post_id, 'url': url},
		dataType:'JSON',

		success: function(data){
			if(data.status == 1){
				$('#list_comment').html(data.output);
			}
		}
	})
}

