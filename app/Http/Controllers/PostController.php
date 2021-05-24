<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
use App\Models\Comment;
use App\User;
use App\Models\Tag;


class PostController extends Controller
{
	public function get_post($post_id){
		// $get_post = Post::where('post_id', $post_id)->get();
    $all_tag = Tag::all();
    $count = DB::table('tbl_tags')
        ->leftJoin('tbl_post', 'tbl_tags.tag_id', 'tbl_post.tag_id')
        ->select(DB::raw('tbl_tags.tag_id, count(tbl_post.tag_id) as post_count'))
        ->groupBy('tbl_tags.tag_id')
        ->where('tbl_post.post_status_int', 1)
        ->get();
    
		$get_post = Post::find($post_id);
    $tag_id = $get_post->tag_id;
    $get_tag = DB::table('tbl_tags')->where('tag_id', $tag_id)->get();

    $get_comment = Comment::where('post_id', $post_id)->orderBy('comment_id', 'desc')->get();
		

		return view('backend.DetailPost')->with('count_post', $count)
                                     ->with('detail_post', $get_post)
	                                   ->with('list_comment', $get_comment)
                                     ->with('all_tag', $all_tag)
                                     ->with('get_tag', $get_tag);
	}
   public function add_post(Request $request){
   	    $this->validate($request,[
           'post_title' =>'required',

       ]);

        // $post = new Post();
        
       //   $user_id = $request->session()->get('user_id');

       //   $get_user = User::find($user_id);
       // if($get_user->user_permission == 1){
       //  $post->user_create = $user_id;
       // }

        $user_id = $request->session()->get('user_id');
        $get_user = DB::table('tbl_users')->where('user_id', $user_id)->get();
        
        foreach($get_user as $key => $value){
          $user_status = $value->user_status;
          $user_actived = $value->user_actived;
        }
        

        if(($user_status == 1) && ($user_actived == 0)){
          
            if ($request->hasFile('image')) {
              $time =1;
              $image = $request->file('image');

              foreach ($image as $files) {
               $t = time()+$time;
               $destinationPath = 'uploads';
               $file_name = $t . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $file_name);
               $data[] = $file_name;
               $time ++;
               
             }

             $file=json_encode($data);

           }
           else{
            $file = null;
          }

            $post = new Post();
            $post->tag_id = $request->get_tag_id;
          $post->user_create = $user_id;
          $post->post_vote_ids = 1;
          $title = strip_tags($request->post_title);
          $content = strip_tags($request->post_detail);

          $post->post_title = $title;
          $post->post_content = $content;
          $post->post_status = $request->post_status_default;
          $post->post_image = $file;
          $post->save();
          
      }
      return back();
   }

    public function edit_post($post_id){
    	$get_post = Post::find($post_id);
    	return view('backend.EditPost')->with('detail_post', $get_post);
    }

    public function update_post(Request $request, $post_id){
    	$this->validate($request,[
           'post_title' =>'required',

       ]);
    	
      $user_create = $request->user_create;

      $user_id = $request->session()->get('user_id');
      $get_user = DB::table('tbl_users')->where('user_id', $user_id)->get();


      if(($user_create == $user_id)||($get_user[0]->user_permission == 1)){
        
          if($request->hasFile('image')){
            $time =1;
            $image = $request->file('image');

            foreach($image as $files){
              $t = time() + $time;
              $destinationPath = 'uploads';
              $file_name = $t . "." .$files->getClientOriginalExtension();
              $files->move($destinationPath, $file_name);
              $data[] = $file_name;
              $time ++;
            }
          }

          if($request->has('uploaded_image_name')){
            $image = $request->uploaded_image_name;
            foreach($image as $files){
              $data[] =$files;
            }
          }

          if(isset($data)){
            $file = json_encode($data);
          }else{
            $file = null;
          }
          

          $post = Post::find($post_id);

          $post->post_title = $request->post_title;
          $post->post_content = $request->post_detail;
          $post->post_image = $file;
          $post->save();

          $route = $request->route;
          return response()->json([
            'status' => 1,
            'route' => $route,
          ]);
        
       
      }else{
        return response()->json([
          'status' => 0,
          'message' => "You can't edit this post",
        ]);
      }
    }

    

    public function delete_post(Request $request,$post_id){
      
    	$post = Post::find($post_id);
      
      $text_delete = $request->text_delete;
      if($text_delete == 'DELETE'){
        $post->post_status_int = 0;
        $post->save();
      }

      $tag_id = $post->tag_id;
      $get_tag = DB::table('tbl_tags')->where('tag_id', $tag_id)->get();
      
      $tag_url = $get_tag[0]->tag_url;
      
    	return redirect('/admin/board/'.$tag_url);
    }

    public function upload_post(Request $request, $post_id){

      $post_status = $request->post_status_default;
      if($request->has('post_status')){
        $upload_status = $request->post_status;
      }
      $user_create = $request->user_create;

      $user_id = $request->session()->get('user_id');
      $get_user = DB::table('tbl_users')->where('user_id', $user_id)->get();

      if( ($upload_status != $post_status)){
        $post = Post::find($post_id);
        $post->post_status = $upload_status;

        $post->save();

          if($request->hasFile('image')){
            $time = 1;
            $image = $request->file('image');
            foreach($image as $files){
              $t = time()+$time;
              $destinationPath = 'uploads';
              $file_name = $t . ".". $files->getClientOriginalExtension();
              $files->move($destinationPath, $file_name);
              $data[] = $file_name;
              $time++;
            }
            $file = json_encode($data);
          }
          else{
            $file = null;
          }

          $comment = new Comment();
          $comment->post_id = $post_id;
          $comment->user_id = $user_create;
          $comment->comment_status = $upload_status;
          $comment->comment_content = $request->comment_content;

          $comment->comment_images = $file;
          $comment->save();
        
      
       
      }
      return redirect()->action(
          'PostController@get_post', ['post_id' => $post_id]
        );
    }
}
?>
