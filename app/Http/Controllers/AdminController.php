<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Post;
use App\Models\Tag;

class AdminController extends Controller
{
    // public function __construct(){
        // session(['user_email' => "admin@gmail.com"]);
        // session(['user_password' => md5('abc@123')]);
        // session(['user_permission' => 1]);
        // session(['user_id' => 1]);
    // }

    public function login(){
        session(['user_nickname' => "admin"]);
        session(['user_email' => "admin@gmail.com"]);
        session(['user_password' => md5('abc@123')]);
        session(['user_permission' => 1]);
        session(['user_id' => 1]);
       //  $this->validate($request,[
       //     'user_email' =>'required',
       //     'user_password' => 'required',
       // ]);

        
    }

    public function index(){

    	
        $post_planned_order = DB::table('tbl_post')
        ->leftJoin('tbl_comment', 'tbl_comment.post_id', 'tbl_post.post_id')
        ->select( DB::raw('DISTINCT post_title, tag_id, post_vote_count'))
        ->where('post_status', 'planned')
        ->where('tbl_post.post_status_int', 1)
        ->orderBy('post_create', 'DESC')
        ->orderBy('comment_create', 'DESC')
        ->skip(0)->take(100)
        ->get();

        // $post_planned_order = DB::table('tbl_post')
        // ->leftJoin('tbl_comment', 'tbl_comment.post_id', 'tbl_post.post_id')
        // ->select('post_create', 'comment_create')
        // ->groupBy('tbl_post.post_create')
        // ->orderBy('post_create', 'DESC')
        // ->get();


       

        // echo "<pre>";
        // print_r($post_planned_order);


    	$post_inprogress =  DB::table('tbl_post')
        ->leftJoin('tbl_comment', 'tbl_comment.post_id', 'tbl_post.post_id')
        ->select( DB::raw('DISTINCT post_title, tag_id, post_vote_count'))
        ->where('post_status', 'in_progress')
        ->where('tbl_post.post_status_int', 1)
        ->orderBy('post_create', 'DESC')
        ->orderBy('comment_create', 'DESC')
        ->skip(0)->take(100)
        ->get();


    	$post_complete = DB::table('tbl_post')
        ->leftJoin('tbl_comment', 'tbl_comment.post_id', 'tbl_post.post_id')
        ->select( DB::raw('DISTINCT post_title, tag_id, post_vote_count'))
        ->where('post_status', 'complete')
        ->where('tbl_post.post_status_int', 1)
        ->orderBy('post_create', 'DESC')
        ->orderBy('comment_create', 'DESC')
        ->skip(0)->take(100)
        ->get();




    	// echo "<pre>";
    	// print_r($post_planned);


         // $dem = 0;
         // foreach($post_planned as $value){
         // 	$tag_planned[$dem] = DB::table('tbl_tags')->where('tag_id',$value->tag_id)->get()->toArray();
         // 	$dem++;
         // }
         
        $data = DB::table('tbl_tags')->get()->all();

        $count = DB::table('tbl_tags')
        ->leftJoin('tbl_post', 'tbl_tags.tag_id', 'tbl_post.tag_id')
        ->select(DB::raw('tbl_tags.tag_id, count(tbl_post.tag_id) as post_count'))
        ->groupBy('tbl_tags.tag_id')
        ->where('tbl_post.post_status_int', 1)
        ->get();

        // $count = DB::table('tbl_post')
        // ->leftJoin('tbl_tags', 'tbl_post.tag_id', 'tbl_tags.tag_id')
        // ->select(DB::raw('tbl_tags.tag_id, count(tbl_post.tag_id) as post_count'))
        // ->groupBy('tbl_tags.tag_id')
        // ->get();

       

         // echo "<pre>";
         // print_r($data);

        // $data = DB::table('tbl_tags')->get()->all();
        // $cout_post = [];
        // foreach($data as $v){
        // 	// $v->orders = DB::table('tbl_post')->where('tag_id', $v->tag_id)->get()->toArray();

        // 	$count_post[] = Post::where('tag_id', $v->tag_id)->count();
        // }
        
        return view('backend.Tagboard')->with('all_tag', $data)->with('count_post', $count)
                                       ->with('post_planned_order', $post_planned_order)
                                       ->with('post_inprogress', $post_inprogress)
                                       ->with('post_complete', $post_complete);
      
    		// $all_post = Post::all();
    	
    	 //    return view('backend.Mainboard')->with('all_post', $all_post);
    	
    }


    // public function create_board{
    // 	return view('backend.Createboard');
    // }
    public function tag_board($tag_url){
        $all_post = DB::table('tbl_tags')
        ->join('tbl_post', 'tbl_tags.tag_id', 'tbl_post.tag_id')
        ->where('tag_url', $tag_url)
        ->get();

        $get_owner = DB::table('tbl_tags')
        ->join('tbl_post', 'tbl_tags.tag_id', 'tbl_post.tag_id')
        ->select(DB::raw('tbl_post.user_create'))
        ->where('tag_url', $tag_url)
        ->groupBy('tbl_post.user_create')
        ->get();


        $count = DB::table('tbl_tags')
        ->leftJoin('tbl_post', 'tbl_tags.tag_id', 'tbl_post.tag_id')
        ->select(DB::raw('tbl_tags.tag_id, count(tbl_post.tag_id) as post_count'))
        ->groupBy('tbl_tags.tag_id')
        ->where('tbl_post.post_status_int', 1)
        ->get();

        $get_tag = DB::table('tbl_tags')->where('tag_url', $tag_url)->get();

        $all_tag = DB::table('tbl_tags')->get()->all();

         
        // echo "<pre>";
        // print_r($get_tag);
        
        return view('backend.Mainboard')->with('count_post', $count)
                                        ->with('get_owner', $get_owner)
                                        ->with('all_post', $all_post)
                                        ->with('all_tag', $all_tag)
                                        ->with('get_tag', $get_tag);

        
    }

    public function ajax_search(Request $request){
    	if($request->ajax()){
			
				$load_status = $request->status;
			    $status = json_decode($load_status, true);
                


			
				$tag_id = $request->tag_id;
			


            
                $limit = $request->limit;
                

			
				$sort = $request->sort;

                $load_user = $request->user;
                $user = json_decode($load_user, true);
              

            $post =DB::table('tbl_post')
                ->where('post_title','LIKE','%'.$request->search."%")
                ->whereIn('post_status', $status)
                ->where('tag_id', $tag_id)
                ->whereIn('user_create', $user)
                ->where('post_status_int', 1)
                ->orderBy('post_id', $sort)
                ->skip(0)->take($limit)            
                ->get();
            
            

            if(sizeof($post) != 0){

            	echo json_encode(array(
            		'status' => 1,
            		'post' => $post,
                    'message' => '',
            	));
            	
            }else{

            	echo json_encode(array(
            		'status' => 0,
                    'post' => $post,
            		'message' => "We couldn't find anything. Try a new search or create a new post!",
            	));
            	
            }
		}	

		
    }

    
}
