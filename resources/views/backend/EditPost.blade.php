@extends('backend.layouts.master')
@section('Content')

<div class="container">
	<div class="adminEditPost">
		<div class="contentContainer">
			<div class="contentInnerContainer">
				<div class="editPostContainer card">
					<div class="heading">Edit Post</div>
					<form class="imageForm createPostForm" action="{{URL::to('/admin/post/update_post/'.$detail_post->post_id)}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="textInput">
							<div class="inset">Title</div>
							<div class="inputContainer">
								<input placeholder="Short, descriptive title" type="text" value="{!! $detail_post->post_title !!}" name="post_title">
							</div>
						</div>
						<div class="textInput">
							<div class="inset">Details</div>
							<div class="inputContainer">
								<input placeholder="Any additional details…" type="text" value="{!! $detail_post->post_content !!}" name="post_detail">
							</div>
						</div>
						


						<div id="uploaded_images">
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
                        		<span class="label">Save</span>

                        	</button>
                        </div>
													
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection