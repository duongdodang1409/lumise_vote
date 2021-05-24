@extends('backend.layouts.master')
@section('Content')

<?php 

	// $test = session()->get('users');
	// var_dump($test);
	// $user_id = session()->get('user_id');
	// var_dump($user_id);
	?>
<div class="container">
	<div class="contentContainer">
		<!-- <script>alert("DUNG");</script> -->
		<div class="contentInnerContainer">
			<div class="adminBoard">
				<div class="adminBoardSidebar">
					<a class="mobileCreateButton" href="/admin/board/feedbackboard/create">
						<button type="button" class="button cannyButton">
							<span class="label">Create&nbsp;Post</span>
							<span class="loader"> </span>
						</button>
					</a>
					<div class="createPostFormContainer">
						<div class="createPostToggle">Create a Post
							<div class="icon-chevron-down icon_create_post">

							</div>
						</div>

						<form class="imageForm createPostForm" action="{{url('/admin/post/add_post')}}" method="post" enctype="multipart/form-data">

							{!! csrf_field() !!}
							<div class="textInput">
								<div class="inset">Title</div>
								<div class="inputContainer">
									<input placeholder="Short, descriptive title" type="text" value="" name="post_title" id="post_title">
								</div>
								<span class="text-danger">{!! $errors->first('post_title') !!}</span>


							</div>

							<div class="autoResizeTextarea" style="">
								<div class="inset">Details</div>
								<span class="inputContainer">
									<textarea placeholder="Any additional details…" rows="3" style="" name="post_detail"></textarea>
								</span>
							</div>
							<input type="hidden" name="post_status_default" value="open">
							<input type="hidden" id="get_url" value="{{url('')}}">
							<input type="hidden" name="get_tag_id" value="<?php echo $get_tag[0]->tag_id ?>">
							<div id="uploaded_images">
								
							</div>

							<div class="formButton">
								<div id="select_file">

									<div class="form-group" style="margin-bottom: 0;">
										<div class="btn_upload" id="upload_image_button">
											<input type="file" id="file-input_1" onchange="loadPreview(this)" name="image[]" />
											<span class="icon icon-image" style="font-size: 20px;"></span>
										</div>

										

									</div>
								</div>

								<button type="submit" name="create" class="button cannyButton" style="background: rgb(82, 93, 249);">
									<span class="label">Create&nbsp;Post</span>

								</button>
							</div>
						</form>
					</div>
					<div class="adminSidebarSection segmentSection">
						<div class="header">
							<div class="title">Segment</div>
							<div class="action">
								<div>Manage segments</div>
							</div>
						</div>
						<div class="dropdownContainer segmentDropdown">
							<div class="selection">
								<div class="left">Everyone (default)</div>
								<div class="icon-chevron-down"></div>
							</div>
						</div>
					</div>
					<div class="adminSidebarSection statusSection">
						<div class="header">
							<div class="title">Status</div>
							<div class="action"></div>
						</div>

						<ul>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="open" checked name="open">Open
							</li>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="under_review" checked name="under_review">Under Review
							</li>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="planned" checked name="planned">Planned
							</li>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="in_progress" checked name="in_progress">In Progress
							</li>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="complete" name="complete">Complete
							</li>
							<li class="checkboxInput">
								<input class="checkbox checkboxLabel" type="checkbox" value="closed" name="closed">Closed 
							</li>
						</ul>


					</div>
					<div class="adminSidebarSection ownerSection">
						<div class="header">
							<div class="title">Owner</div>
							<!-- <div class="action">
								<div class="ownerAction">
									<div class="search">Search</div>
								</div>
							</div> -->
						</div>
						<div class="radioButtonGroup">
							<div class="radioButtonInput">
								<?php  
								  $owner = [];
								  foreach($get_owner as $key => $value){
								  	$owner[] = $value->user_create;
								  }
								  $user = json_encode($owner);

								?>
								<input name="all" type="radio" checked id="all_owner" value="<?php echo $user;?>">
								<label for="all_owner" class="radio-label">All</label>
							</div>
							<!-- <div class="radioButtonInput">
								<input name="all" type="radio">
								<label class="radio-label">No owner</label>
							</div> -->
							<div class="radioButtonInput">
								<?php  
								$owner = [];
								$owner[0] = session()->get('user_id');
								$user = json_encode($owner);
								?>
								<input name="all" type="radio" id="me" value="<?php echo $user; ?>">
								<label for="me" class="radio-label">Me</label>
							</div>
						
					</div>
				</div>
				<div class="adminSidebarSection sortSection">
					<div class="header">
						<div class="title">Sort</div>
						<div class="action"></div>
					</div>
					<div class="radioButtonGroup">
						<!-- <div class="radioButtonInput">
							<input name="sort" type="radio" id="trending" checked value="desc">
							<label for="trending" class="radio-label">Trending</label>
						</div> -->

						<div class="radioButtonInput">
							<input name="sort" type="radio" id="newest" checked value="desc">

							<label for="newest" class="radio-label">Newest</label>
						</div>
						<div class="radioButtonInput">
							<input name="sort" type="radio" id="oldest" value="asc">

							<label for="oldest" class="radio-label">Oldest</label>
						</div>
					</div>
				</div>
			</div>
			<div class="mainContainer">
                <?php if(count($all_post) !=0 ) : ?>
				<div class="adminBoardPosts card">
					<div class="postList">
						<div class="topContainer">
							<div class="postListMenu">
								<div class="searchContainer active">
									<div class="searchBar">
										<div class="textInput searchInput">
											<div class="inset">
												<div class="icon icon-search"></div>
											</div>
											<div class="inputContainer">
												<input type="text" name="search_text" id="search" placeholder="Search ... " class="form-control" />
												
											</div>
										</div>
									</div>
									<div class="icon icon-x"></div>
								</div>
							</div>
						</div>
						<div class="posts" id="list_post">
							<!-- @foreach($all_post as $key => $value)
							  <div class="postListItem">
								<div class="postVotes">
									<div class="upvote voted" style="border-bottom-color: rgb(82, 93, 249);"></div>
									<span>1</span>
								</div>
								<a class="postLink" href="{{URL::to('admin/post/detail_post',$value->post_id)}}">
									<div class="body">
										<div class="postTitle">
											<span>{!! $value->post_title !!}</span>
										</div>
										<div class="statusStale">
											<div class="uppercaseHeader postStatus">{!! $value->post_status !!}</div>
										</div>
										<div class="postDetails">
											<div class="truncate">
												<div class="line">{!! $value->post_content !!}</div>
											</div>
										</div>
									</div>
									<div class="postCommentCount">
										<span class="icon icon-comment"></span>
										<span>1</span>
									</div>
								</a>
							</div>
							@endforeach  -->
							
						</div>
						<div class="noPosts">
							
						</div>
						
						<div class="load_more" id="load_more" style="display: none;">
							<button class="btn btn-success" id="see_more_post">See More</button>
						</div>
					</div>
				</div>
			    <?php endif; ?>
			</div>
		</div>
	</div>
	



	@endsection

@section('list_post_script')
<script type="text/javascript" src="{{asset('backend/js/list_post.js')}}"></script>
@endsection