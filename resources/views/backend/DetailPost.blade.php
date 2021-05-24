@extends('backend.layouts.master')
@section('Content')

<div class="detail_requests">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <div class="adminPostSidebar" data-test="Dung">
                    <div class="adminSidebarSection postDetails">
                      
                            
                        
                        <div class="header">
                            <div class="title">Details</div>
                            <div class="action"></div>
                        </div>
                        <div class="postDetail">
                            <div class="detailLabel">Public link</div>
                            <a class="publicLink" href="/feedbackboard/p/new-new">https://lazy-company.canny.io/feedbackboard/p/new-new</a>
                            <div class="copyButton active">Copy</div>
                        </div>
                        <div class="postDetail">
                            <div class="postStatusDropdown">
                              <form action="{{URL::to('/admin/post/upload_post/'.$detail_post->post_id)}}" method="post" enctype="multipart/form-data">

                                {!! csrf_field() !!}
                                <div class="topContainer">
                                   <div class="detailLabel">Status</div>
                                   
                                    <select id="select" name="post_status">
                                        <option>{!! $detail_post->post_status !!}</option>
                                        <option value="open" class="open">Open</option>
                                        <option value="under_review" class="under_review">Under Review</option>
                                        <option value="planned" class="planned">Planned</option>
                                        <option value="in_progress" class="in_progress">In Progress</option>
                                        <option value="complete" class="complete">Complete</option>
                                        <option value="closed" class="closed">Closed</option>


                                    </select>
                                    <input type="hidden" name="post_status_default" value="{!! $detail_post->post_status !!}">
                                    <input type="hidden" value="{!! $detail_post->user_create !!}" name="user_create">
                                    <input type="hidden" id="get_url" value="{{url('')}}">
                                   
                                </div>

                                <div class="status_upload" id="status_upload_form">
                                    <div class="autoResizeTextarea" style="">
                                        <span class="inputContainer">
                                            <textarea placeholder="Add an update comment (optional)" rows="1" style="" name="comment_content"></textarea>

                                        </span>
                                        <span class="text-danger">{{ $errors->first('comment_content') }}</span>
                                    </div>


                                    <div id="uploaded_images" style="margin: 20px 0 0 10px;">

                                    </div>


                                    <div class="formButton" style="padding: 10px;">
                                        <div id="select_file">

                                            <div class="form-group" style="margin-bottom: 0;">
                                                <div class="btn_upload" id="upload_image_button">
                                                    <input type="file" id="file-input" onchange="loadPreview(this)" name="image[]"   multiple/>
                                                    <span class="icon icon-image" style="font-size: 20px;"></span>
                                                </div>

                                               


                                            </div>
                                        </div>

                                        <button id="upload_status" name="submit" class="button cannyButton" style="background: rgb(82, 93, 249);">
                                            <span class="label">save</span>

                                        </button>

                                    </div>
                                </div>
                                

                             </form>
                                

                            </div>
                        </div>
                        <div class="postDetail">
                            <div class="postOwnerInput">
                                <div class="label">Owner</div>
                                <div class="ownerContainer">
                                    <div class="toggleButton">
                                        <div class="buttonValue">Add</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="postDetail">
                            <div class="postETA">
                                <div class="input">
                                    <div class="label">Estimated</div>
                                    <div class="value">
                                        <div class="label unset">Add</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <div class="adminSidebarSection postActions">
                        <div class="header">
                            <div class="title">Actions</div>
                            <div class="action"></div>
                        </div>
                        <div class="mergePost">
                            <div class="mergePostDropdown">
                                <div class="searchContainer">
                                    <div class="textInput searchInput">
                                        <div class="inputContainer">
                                            <input placeholder="Merge into another post" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="adminSidebarSection voters">
                        <div class="header">
                            <div class="title">1 Voter</div>
                            <div class="action">
                                <div>Add voter</div>
                            </div>
                        </div>
                        <div class="videoNUX">
                            <div class="videoNUXContent">
                                <div class="thumbnail">
                                    <div class="videoPlayButton">
                                        <div class="triangle"></div>
                                    </div>
                                </div>
                                <div class="text">
                                    <div class="pill">
                                        <div class="uppercaseHeader">tip</div>
                                    </div>
                                    <div class="title">Vote on behalf of your&nbsp;users</div>
                                </div>
                            </div>
                            <div class="icon-x"></div>
                        </div>
                        <div class="adminPostVoters">
                            <div class="users sidebar">
                                <div class="voter">
                                    <div class="left">
                                        <div class="userLockupContainer">
                                            <a class="userLockup tappable" href="/admin/user/jaovdi">
                                                <div class="userAvatarContainer">
                                                    <div class="userAvatar">
                                                        <img src="" alt="">
                                                    </div>
                                                </div>
                                                <div class="userInfo">
                                                    <span class="name admin" style="color: rgb(82, 93, 249);">jaovdi</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="conversationLink"></div>
                                    <div class="remove"></div>
                                </div>
                            </div>
                            <a class="more" href="/admin/board/feedbackboard/p/new-new/voters" style="color: rgb(82, 93, 249);">See more</a>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-8">
                <div class="content-detail-post">
                    <div class="list_item">
                        <form id="form_edit_post" class="item" data-route="{{URL::to('/admin/post/update_post/'.$detail_post->post_id)}}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="info-top">
                                <div class="votepost">
                                    <div class="icon"></div>
                                    <span class="nummbervots">1</span>
                                </div>
                                <div class="text-hede">
                                    <h3 id="detail_postTitle">{!! $detail_post->post_title !!}</h3>

                                    <div class="textInput" id="textInput" style="display: none;">

                                        <div class="inputContainer">
                                            
                                            
                                            <input type="text" value="{!! $detail_post->post_title !!}" name="post_title" id="post_title">
                                            <input type="hidden" value="{!! $detail_post->user_create !!}" name="user_create">
                                            <input type="hidden" name="route" value="{{URL::to('/admin/post/detail_post/'.$detail_post->post_id)}}">
                                        </div>
                                        <span class="text-danger">{!! $errors->first('post_title') !!}</span>


                                    </div>

                                    <h4 class="status_post planned">{!! $detail_post->post_status !!}</h4>
                                </div>
                            </div>
                            <div class="content_post" style="width: 100%;">
                                <div class="info">
                                    <div class="avatar_name">
                                        <div class="avart-ur"></div>
                                        <div class="name admin" style="color: rgb(82, 93, 249); font-weight: 700;">User</div>
                                    </div>
                                    <div class="text-post">
                                        <div class="markdown">
                                            <div class="line" id="detail_postContent">{!! $detail_post->post_content !!}</div>
                                            <div class="textInput" id="textInput" style="display: none;">

                                                <div class="inputContainer">
                                                    <textarea rows="3" style="" name="post_detail">{!! $detail_post->post_content !!}</textarea>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postImages" id="list_post_image">
                                          <?php 
                                          if($detail_post->post_image != null){
                                          $post_images = json_decode($detail_post->post_image);
                                          foreach($post_images as $value){
                                            ?>
                                            <div class="thumbnail">
                                                <a class="lightbox" href="{{asset('uploads')}}/<?php echo $value; ?>">
                                                    <img src="{{asset('uploads')}}/<?php echo $value; ?>" alt="Rails">
                                                </a>
                                            </div>
                                            
                                            <?php
                                          }
                                         }
                                          ?>
                                        </div>

                                        <div id="uploaded_images_{!! $detail_post->post_id !!}" class="edit_upload_image" style="display: none;">
                                            <?php  
                                            if($detail_post->post_image != null){
                                                $post_images = json_decode($detail_post->post_image);
                                                foreach($post_images as $value){
                                                    ?>
                                                    <div class="uploaded_image">
                                                      <input type="text" value="<?php echo $value; ?>" name="uploaded_image_name[]" id="uploaded_image_name" hidden>
                                                      <img src="{{asset('uploads')}}/<?php echo $value; ?>" alt="">
                                                      <a href="#" class="img_rmv btn "><span class="icon icon-x"></span></a> 
                                                  </div>
                                                  <?php
                                              }                              

                                          }

                                          ?>

                                      </div>
                                      <div class="formButton edit_form_button" id="edit_formButton" style="display: none;">
                                        <div id="select_file">

                                            <div class="form-group" style="margin-bottom: 0;">
                                                <div class="btn_upload" id="upload_image_button_{!! $detail_post->post_id !!}">
                                                    <input type="file" id="file-input_1" onchange="image_preview(this)" name="image[]" />
                                                    <input type="hidden" id="post_id" value="{!! $detail_post->post_id !!}">
                                                    <span class="icon icon-image" style="font-size: 20px;"></span>
                                                </div>



                                            </div>
                                        </div>

                                        <button name="submit" class="button cannyButton" style="background: rgb(82, 93, 249);">
                                            <span class="label">Save</span>

                                        </button>
                                    </div>



                                        <div class="postMenu">
                                            <a class="postLink timestampLink" href="/admin/board/feedbackboard/p/new-new">
                                                <div class="timestamp">
                                                    {!! $detail_post->post_create !!}
                                                </div>
                                            </a>
                                            <div class="editLink" id="edit_post">Edit&nbsp;Post</div>
                                            <a href=""><div class="deleteLink">Mark&nbsp;Spam</div></a>
                                            
                                            <a href="#" data-toggle="modal" data-target="#deletePostModal">
                                                <div class="deleteLink">Delete&nbsp;Post</div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                            <div class="commentComposer">
                                <form id="form_add_comment" action="{{url('/admin/comment/add_comment')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment_content" id="comment_content" rows="1" placeholder="Leave a comment"></textarea>

                                    </div>
                                    <span class="text-danger">{{ $errors->first('comment_content') }}</span>
                                    <input type="hidden" name="post_id" value="{!! $detail_post->post_id !!}">
                                    <input type="hidden" name="get_url" value="url('')">
                                    <input type="hidden" name="parent_comment_id" value="0">

                                    <div class="form-group-bottom" style="display: none">
                                        <div id="comment_upload_images" style="margin: 20px 0 0 10px;">

                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="formButton" style="padding: 10px; width: 100%;">
                                                <div id="select_file">

                                                    <div class="form-group" style="margin-bottom: 0;">
                                                        <div class="btn_upload" id="comment_image_preview_btn">
                                                          <input type="file" id="file-comment_1" onchange="image_previewComment(this)" name="comment_image[]">
                                                          <span class="icon icon-image" style="font-size: 20px;"></span>
                                                        </div>

                                                        


                                                    </div>
                                                </div>

                                                <button name="submit" id="add_comment" class="button cannyButton" style="background: rgb(82, 93, 249);">
                                                    <span class="label">Submit</span>

                                                </button>

                                            </div>
                                        </div>
                                        
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                   
                    <div class="sort_comment" data-test="duashjn">
                        <div class="left">ACTIVITY
                        </div>
                        <!-- <div class="right">
                            <div class="new">NEWEST</div>
                            <div class="old">OLDEST
                            </div>
                        </div> -->
                    </div>
                    <?php  
                   
                    $comparent = [];
                    $dem = 0;
                    foreach($list_comment as $key => $value){
                        if($value->comment_parent == 0){
                            $comparent[$dem] = $value->comment_id;
                            $dem ++;
                        }
                    }
                    
                    $com_parent = json_encode($comparent);
                    ?>  
                    <input type="hidden" id="com_parent" value="<?php echo $com_parent; ?>">
                    <div class="list_comment" id="list_comment">
                      

                    </div>
                    <div class="load_more" id="load_more" style="display: none;">
                        <button class="btn btn-success" id="see_more_comment">See More</button>
                    </div>   
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-reply" style="display: none;">
    <form id="form_reply_comment" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea class="form-control" id="reply-content" name="comment_content" rows="1" placeholder="Leave a comment"></textarea>
            <input type="hidden" name="post_id" value="{!! $detail_post->post_id !!}">
            <input type="hidden" name="parent_comment_id" >

        </div>
        <div class="form-group-bottom">
            <div id="reply_upload_images" style="margin: 20px 0 0 10px;">

            </div>
            <div class="form-group">

                <div class="formButton" style="padding: 10px; width: 100%;">
                    <div id="select_file">

                        <div class="form-group" style="margin-bottom: 0;">
                            <div class="btn_upload" id="reply_image_preview_btn">
                              <input type="file" id="file-reply_1" onchange="image_previewReply(this)" name="comment_image[]">
                              <span class="icon icon-image" style="font-size: 20px;"></span>
                          </div>




                      </div>
                  </div>

                  <button name="submit" class="button cannyButton" style="background: rgb(82, 93, 249);">
                    <span class="label">Submit</span>

                  </button>

                </div>
            </div>

        </div>

    </form>
</div>

<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModal" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{URL::to('admin/post/delete_post',$detail_post->post_id)}}" method="post">
            @csrf
            <div class="modal-body">
                <label for="">Are you sure you'd like to delete this post?</label>
                <input type="text" id="text_delete" name="text_delete" style="width: 100%;">
            </div>
            <div class="modal-footer">
                
              
                 <button type="submit" class="btn btn-primary" id="deleteBtn" >Delete</button>
             
             <button class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>

        </form>
    </div>
</div>

@endsection


@section('comment_script')

<script type="text/javascript" src="{{asset('backend/js/comment.js')}}"></script>
@endsection
