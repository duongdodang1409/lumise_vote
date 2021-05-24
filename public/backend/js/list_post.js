$(document).ready(function() {
	var url = $('#get_url').val(); 
    var tag_id = $('#get_tag_id').val();
    var query = $('#search').val();

    var user = $('.ownerSection input[type="radio"]').val();
    
    var str= [];
    var dem=0;
    $('.checkboxLabel:checked').each(function(){
    	str[dem] = $(this).val();
    	dem ++;
    });
    var status = JSON.stringify(str);
    var sort = $('.sortSection input[type="radio"]').val();
    var start_post = 50;

    console.log(tag_id); console.log(query); console.log(user); console.log(status); console.log(sort);

    load_data(query,status,tag_id,user,sort,start_post);
	
    function load_data(query,status,tag_id,user,sort,limit){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type : "POST",
            url : url+"/admin/search",
            data:{'search':query, 'tag_id': tag_id, 'status': status, 'user': user, 'sort': sort, 'limit': limit},
            dataType: "json",
            success:function(response){
                if(response.status == 0){
                    list_post(response.post);
                    No_post(response.message);
                }
                if(response.status == 1){
                    list_post(response.post);
                    No_post(response.message);
                    //console.log(response.message);
                }
              
              
            }
        });
    }

    $('.checkboxLabel').click(function(){
        var str= [];
        var dem=0;
        $('.checkboxLabel:checked').each(function(){
            str[dem] = $(this).val();
            dem ++;
        });
        status = JSON.stringify(str);

        load_data(query,status,tag_id,user,sort,start_post);
    });

    function No_post(message){
        var output = '';
        if(message != ""){
            output += message;
        }
        $('.adminBoardPosts .noPosts').html(output);
    }

    function list_post(data){
        var output = '';
        for (var i = 0; i < data.length; i++) {
            output += '<div class="postListItem">';
            output += '<div class="postVotes"><div class="upvote voted" style="border-bottom-color: rgb(82, 93, 249);"></div><span>1</span></div>';
            output += '<a class="postLink" href="'+url+"/admin/post/detail_post/"+data[i].post_id+'">';
            output += '<div class="body"><div class="postTitle"><span>'+data[i].post_title+'</span></div><div class="statusStale"><div class="uppercaseHeader postStatus">'+data[i].post_status+'</div></div><div class="postDetails"><div class="truncate"><div class="line">'+data[i].post_content+'</div></div></div></div>';
            output += '<div class="postCommentCount"><span class="icon icon-comment"></span><span>1</span></div>'
            output += '</a>';
            output += '</div>';
        }
        if((data.length % 50 ==0)&&(data.length != 0) ){
            $('.postList #load_more').toggleClass('show_load');
        }else{
            $('.postList #load_more').toggleClass('hide_load');
        }
        $('#list_post').html(output);
    }
    
    $('#search, #post_title').on('keyup',function(){
        var value=$(this).val();
        query = value;

        load_data(query,status,tag_id,user,sort,start_post);
    });


    $('.ownerSection input[type="radio"]').click(function() {
        var load_user = $(this).val();
        
        user = load_user;
        load_data(query,status,tag_id,user,sort,start_post);
        
    });

    $('.sortSection input[type="radio"]').click(function() {
    	sort = $(this).val();

    	load_data(query,status,tag_id,user,sort,start_post);
    });

    $('#see_more_post').click(function(){
    	start_post += 50;

    	load_data(query,status,tag_id,user,sort,start_post);
    });

    
});