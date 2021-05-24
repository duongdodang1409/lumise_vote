<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
  public function get_comment(Request $request){
    $post_id = $request->post_id;
    session(['get_url' => $request->url]);
    
    $url = $request->session()->get('get_url');

    $comment = DB::table('tbl_comment')
    ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
    ->where('post_id', $post_id)
    ->where('comment_parent', 0)
    ->orderBy('comment_id', 'DESC')
    ->get();
    
    $response = "";
    if(sizeof($comment) != 0){
      foreach($comment as $key => $value){
        $response .= createCommentRow($value,$url);
      }
    }else{
      $response = "";
    }

    return response()->json([
        'status' => 1,
        'output' => $response,
       ]);
  }

  public function get_reply(Request $request){
    $url = $request->session()->get('get_url');
    $com_parent = $request->com_parent;
    $post_id = $request->post_id;

    $comment = DB::table('tbl_comment')
    ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
    ->where('post_id', $post_id)
    ->where('comment_parent', $com_parent)
    ->orderBy('comment_id', 'DESC')
    ->get();

    $response = "";
    if(sizeof($comment) != 0){
      foreach($comment as $key => $value){
        $response .= createReplyRow($value,$url);
      }
    }else{
      $response = "";
    }

    return response()->json([
        'status' => 1,
        'output' => $response,
       ]);
  }


  public function add_comment(Request $request){
    if ($request->hasFile('comment_image')) {
      $time =1;
      $image = $request->file('comment_image');

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


    $user_id = $request->session()->get('user_id');

    $comment_content = $request->comment_content;
    $post_id = $request->post_id;

    if(($comment_content == null) && ($file == null) ){
      return response()->json([
        'status' => 0,
        'output' => '',
       ]);
    }else{

      $comment = new Comment();
        $comment->comment_content = $request->comment_content;
        $comment->post_id = $post_id;
        $comment->comment_parent = $request->parent_comment_id;
        $comment->user_id = $user_id;
        $comment->comment_images = $file;

        $comment->save();

      $get_comment = DB::table('tbl_comment')
      ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
      ->where('post_id', $post_id)
      ->orderBy('comment_id', 'DESC')
      ->skip(0)->take(1)
      ->get();
      $response = "";
      $url = $request->session()->get('get_url');

      foreach($get_comment as $key => $value){
        $response .= createReplyRow($value, $url);
      }

      return response()->json([
        'status' => 1,
        'output' => $response,
       ]);
    }

  }
}

function createReplyRow($data,$url){
  $response = 
    '<div class="content_post">
      <div class="info-user">';

  $response .= 
    '<div class="avatar_name">
      <div class="avart-ur"></div>
      <div class="name admin" style="color: rgb(82, 93, 249); font-weight: 700;">'.$data->user_nickname.'</div>
    </div>';

    $response .= '<div class="text-post">';

    $response .= 
    '<div class="commentMenu">
        <div class="menu">
          <div>
            <div class="menuLike">
              <div class="like"></div>
              <div class="count">0</div>
            </div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="menuTimestamp">
              <a class="postLink" href="/admin/board/feedbackboard/p/new-new">
                <div class="timestamp">'.$data->comment_create.'</div>
              </a>
            </div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="edit">Edit Comment</div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="reply click_reply" data-commentID="'.$data->comment_id.'" onclick="reply(this)"><span>Reply</span></div>
          </div>
        </div>
      </div>';

    $response .= '<div class="comment_body_'.$data->comment_id.'" style="margin: 20px 0;">';
    if($data->comment_content != null){
      $response .= '<div class="commnet_content" style="margin: 20px 0;">
          <div class="line">'.$data->comment_content.'</div>
        </div>';
    }

    $response .= '<div class="comment_image">';
    if($data->comment_images != null){
      $image = json_decode($data->comment_images);
      foreach($image as $value){
        $response .= '<div class="thumbnail"><a class="lightbox" href="'.$url."/uploads/".$value.'"><img src="'.$url."/uploads/".$value.'" alt="Rails"></a></div>';
      }
    }

    
    $response .= '</div>';
    $response .= '</div>';

    $response .= '</div>';

    $response .= 
    '  </div>
    </div>';

      $get_reply = DB::table('tbl_comment')
      ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
      ->where('post_id', $data->post_id)
      ->where('comment_parent', $data->comment_id)
      ->orderBy('comment_id', 'DESC')
      ->get();

     
      foreach($get_reply as $key => $value){
        $response .= createReplyRow($value, $url);
      }

    return $response;
}

function createCommentRow($data, $url){
    
    if($data->comment_parent == 0){
      $response = 
      '<div class="content_post" data-comParent="'.$data->comment_parent.'">
        <div class="info-user">';
    }else{
    $response = 
    '<div class="content_post">
      <div class="info-user">';
    }

    $response .= 
    '<div class="avatar_name">
      <div class="avart-ur"></div>
      <div class="name admin" style="color: rgb(82, 93, 249); font-weight: 700;">'.$data->user_nickname.'</div>
    </div>';

    $response .= '<div class="text-post">';

    $response .= 
    '<div class="commentMenu">
        <div class="menu">
          <div>
            <div class="menuLike">
              <div class="like"></div>
              <div class="count">0</div>
            </div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="menuTimestamp">
              <a class="postLink" href="/admin/board/feedbackboard/p/new-new">
                <div class="timestamp">'.$data->comment_create.'</div>
              </a>
            </div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="edit">Edit Comment</div>
          </div>
          <div class="menuLink">
            <div class="middot">·</div>
            <div class="reply click_reply" data-commentID="'.$data->comment_id.'" onclick="reply(this)"><span>Reply</span></div>
          </div>
        </div>
      </div>';

    $response .= '<div class="comment_body_'.$data->comment_id.'" style="margin: 20px 0;">';
    if($data->comment_content != null){
      $response .= '<div class="commnet_content" style="margin: 20px 0;">
          <div class="line">'.$data->comment_content.'</div>
        </div>';
    }

    $response .= '<div class="comment_image">';
    if($data->comment_images != null){
      $image = json_decode($data->comment_images);
      foreach($image as $value){
        $response .= '<div class="thumbnail"><a class="lightbox" href="'.$url."/uploads/".$value.'"><img src="'.$url."/uploads/".$value.'" alt="Rails"></a></div>';
      }
    }

    
    $response .= '</div>';
    $response .= '</div>';

    $response .= '<div id="replies_'.$data->comment_id.'">';
    
    
      $get_reply = DB::table('tbl_comment')
      ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
      ->where('post_id', $data->post_id)
      ->where('comment_parent', $data->comment_id)
      ->orderBy('comment_id', 'DESC')
      ->get();

     
      foreach($get_reply as $key => $value){
        $response .= createCommentRow($value, $url);
      }
    
   

    $response .= '</div>';
    $response .= '</div>';
    // if($data->comment_parent == 0){
    //   $response .= '<div id="replies_'.$data->comment_id.'">';

    //   $response .= '<p>DUNG</p>';

    //   $response .= '</div>';

    //   $response .= '</div>';
    // }
   


    $response .= 
    '  </div>
    </div>';


    return $response;
    
  }



function show_reply($parent_id, $url){
  // $get_reply = DB::table('tbl_comment')
  //     ->join('tbl_users', 'tbl_users.user_id', 'tbl_comment.user_id')
  //     ->where('post_id', $parent_id)
  //     ->where('comment_parent', $data->comment_id)
  //     ->orderBy('comment_id', 'DESC')
  //     ->get();
}
