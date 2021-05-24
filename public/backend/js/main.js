$(document).ready(function() {

		$(".userProfile").click(function(){

			$(".accountMenu").slideToggle();

		});
		$('.boardDropdown #select_board').click(function(){
			$('.boardDropdown .dropdown').slideToggle();
		});


		// $(".selection").click(function(){

		// 	$(".dropdown").slideToggle();

		// });

		$(window).click(function() {

			$(".accountMenu").hide();

			$(".accountMenu, .userProfile").click(function (event) {
				event.stopPropagation();
			});

		});
		$(window).click(function() {

			$(".dropdown").hide();

			$(".dropdown, .selection").click(function (event) {
				event.stopPropagation();
			});

		});

		
		$('#box').click(function(){
			$(this).toggleClass('on');
		});

		$('.autoResizeTextarea .inputContainer textarea').click(function(){
			$('.commentComposer .composerForm .buttonBar').toggleClass('show_form');
		});
		// $('.commentMenu .menu .reply').click(function(){
		// 	$('.commentMenu .reply_composer').toggleClass('show_reply');
		// });

		// $(".mentionsTextarea #form_leave_comment").click(function () {
		// 	$(".buttonBar").slideToggle();

		// });
		// $('.commentComposer #comment_content').click(function () {
		// 	$('.commentComposer').find('.form-group-bottom').toggleClass("show_form");

		// });
	

		// $('.detail_requests #select').click(function () {
			
		// 	$('.detail_requests #status_upload_form').toggleClass("show_form");
		// });

		$('.detail_requests #edit_post').click(function(){
			$('.detail_requests .textInput').toggleClass("show_input");
			// $("#detail_postTitle").hide();
			// var myobj = document.getElementById('detail_postTitle');
   //          var mys = document.getElementById('detail_postContent');
   //          myobj.remove(); mys.remove();
            $('.detail_requests .edit_upload_image').toggleClass("show_upload_image");
            $('.detail_requests .edit_form_button').toggleClass("show_formButton");
		});

		$('.createPostForm #post_title').click(function () {
			$('.mainContainer #search_post').toggleClass("hide_search");
			$('.mainContainer #suggest_post').toggleClass("show_suggest");
		});
		

		$("#deletePostMOdal").on('click', function () {
            
        });

    

});

    function reply(caller) {
        $(caller).find('form-reply').toggleClass("show_reply");
        // $(".replyRow").insertAfter($(caller));
        // $('.replyRow').show();

    }

	
	$(".icon_create_post").click(function() {
		$(".createPostForm").slideUp(200);
		if (
			$(this)
			.parent()
			.hasClass("active")
			) {
			$(".icon_create_post").removeClass("active");
		$(this)
		.parent()
		.removeClass("active");
	} else {
		$(".icon_create_post").removeClass("active");
		$(".createPostForm").slideDown(200);
		// $(this)
		// .next(".createPostForm")
		// .slideDown(200);
		$(this)
		.parent()
		.addClass("active");
	}
    });

  //   $("#select_all").change(function(){  
  //      $(".checkbox").prop('checked', $(this).prop("checked")); 
  //   });

  //   $('.checkbox').change(function(){ 
  //   if(false == $(this).prop("checked")){ 
  //       $("#select_all").prop('checked', $(this).prop("checked"));
  //       $(this)
		// .parent()
		// .addClass("checked"); 
		// $(this).prop("checked") = true;
  //   }
   
  //   if ($('.checkbox:checked').length == $('.checkbox').length ){
  //       $("#select_all").prop('checked', true);
  //   } 
  //   });

   