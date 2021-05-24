@extends('backend.layouts.tag_board')
@section('Content')

<div class="adminBoards">
  <div class="contentContainer">
    <div class="contentInnerContainer">
      <div class="yourBoards">
        <div class="header">
          <div class="bigHeader">@lang('admin_permission.Boards')</div>
          <a class="cannyButton" href="/admin/create-board">
            <button type="button" class="button cannyButton cannyButton">
              <span class="label">@lang('admin_permission.Create_Board')</span>
              <span class="loader"> </span>
            </button>
          </a>
        </div>
        
        <div class="adminBoardList card linkToBoards">
          <?php if(count($all_tag) != 0 ){ ?>
          <div class="columnLabels">
            <div class="uppercaseHeader name">@lang('admin_permission.Name')</div>
            <div class="uppercaseHeader posts">@lang('admin_permission.Posts')</div>
            <div class="uppercaseHeader actions"></div>
          </div>
        
          <?php  
          
           // echo "<pre>";
           // $count = [];
           // $dem2 =0;
           // foreach($all_tag as $key => $value){
           //  foreach($count_post as $key => $row){
           //    if($value->tag_id == $row->tag_id){
           //      $count[$dem]
           //      echo $row->post_count;
           //    }
           //  }
           //  $dem++;
           // }
          ?>
          
          @foreach($all_tag as $key => $value)
            
          
          <div class="adminBoardListItem">
            <div class="listItemContainer" style="top: 0px;">
              <div class="icon icon-drag"></div>
              <a class="linkContainer" href="{{URL::to('/admin/board/'.$value->tag_url)}}">
                <div class="name">{!! $value->tag_name !!}</div>
                <div class="count">
                 <?php  
                  foreach($count_post as $key => $row){
                    if($value->tag_id == $row->tag_id){
                      echo $row->post_count;
                    }else{
                      echo "0";
                    }
                  }
                 ?>
                </div>
              </a>
              <div class="icons">
                <a href="/feature" target="_blank" rel="noopener">
                  <div class="icon icon-link"></div>
                </a>
                <a class="" href="/admin/settings/boards/feature/privacy">
                  <div class="tooltipContainer">
                    <div class="icon icon-eye"></div>
                  </div>
                </a>
                <a class="" href="/admin/settings/boards/feature/general">
                  <div class="icon icon-gear"></div>
                </a>
              </div>
            </div>
          </div>
          
          
          @endforeach

        <?php } else{ ?>
          <div class="noBoards">
            <div>Your boards will show up here. <a class="" href="/admin/create-board">Click here to create one.</a></div>
          </div>
        <?php } ?>

        </div>
        
      </div>
      <div class="stalePosts">
        <div class="adminStalePostList">
          <div class="stalePostTooltip">
            <div class="tooltipContainer">
              <span class="info">?</span>
            </div>
          </div>
          <div class="adminStalePostHeader">@lang('admin_permission.Stale_posts')</div>
          <div class="noStalePosts">
            <img src="">
            <div class="message">@lang('admin_permission.None_stale')</div>
            <div class="affirmation">@lang('admin_permission.Great_work')</div>
          </div>
        </div>
      </div>
      <div class="roadmapView">
        <div class="header">@lang('admin_permission.Roadmap')</div>
        <?php if((count($all_tag) != 0) ){ ?>
        <div class="roadmapColumns">
          <div class="roadmapColumn">
            <div class="columnHeader">
              <div class="dot planned"></div>
              <div>@lang('admin_permission.Planned')</div>
            </div>
            <div class="scrollContainer">
              <div class="postList">
                <div class="topContainer"></div>
                <div class="posts">
                  @foreach($post_planned_order as $key => $value)
                    <?php  
                       foreach($all_tag as $key => $tag){
                        if($tag->tag_id == $value->tag_id){
                          $tag_name = $tag->tag_name;
                        }
                       }
                    ?>
                  <div class="postListItem">
                    <div class="postVotes">
                      <div class="upvote voted" style="border-bottom-color: rgb(82, 93, 249);"></div>
                      <span>{!! $value->post_vote_count !!}</span>
                    </div>
                    <a class="postLink" href="/admin/board/feature/p/post-2">
                      <div class="body">
                        <div class="postTitle">
                          <span>{!! $value->post_title !!}</span>
                        </div>
                        <div class="statusStale"></div>
                        <div class="uppercaseHeader boardName"><?php echo $tag_name; ?></div>
                      </div>
                    </a>
                  </div>
                  @endforeach


                </div>
              </div>
            </div>
          </div>
          <div class="roadmapColumn">
            <div class="columnHeader">
              <div class="dot inProgress"></div>
              <div>@lang('admin_permission.In_progress')</div>
            </div>
            <div class="scrollContainer">
              <div class="postList">
                
                
                <div class="topContainer"></div>
                <div class="posts">
                  @foreach($post_inprogress as $key => $value)
                    <?php  
                       foreach($all_tag as $key => $tag){
                        if($tag->tag_id == $value->tag_id){
                          $tag_name = $tag->tag_name;
                        }
                       }
                    ?>
                  <div class="postListItem">
                    <div class="postVotes">
                      <div class="upvote voted" style="border-bottom-color: rgb(82, 93, 249);"></div>
                      <span>{!! $value->post_vote_count !!}</span>
                    </div>
                    <a class="postLink" href="/admin/board/feature/p/post-2">
                      <div class="body">
                        <div class="postTitle">
                          <span>{!! $value->post_title !!}</span>
                        </div>
                        <div class="statusStale"></div>
                        <div class="uppercaseHeader boardName"><?php echo $tag_name; ?></div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                </div>
                <!-- <div class="noPosts">Coming soon!</div> -->
               
              </div>
            </div>
          </div>
          <div class="roadmapColumn">
            <div class="columnHeader">
              <div class="dot complete"></div>
              <div>@lang('admin_permission.Complete')</div>
            </div>
            <div class="scrollContainer">
              <div class="postList">
                <div class="topContainer"></div>
                <div class="posts">
                  @foreach($post_complete as $key => $value)
                    <?php  
                       foreach($all_tag as $key => $tag){
                        if($tag->tag_id == $value->tag_id){
                          $tag_name = $tag->tag_name;
                        }
                       }
                    ?>
                  <div class="postListItem">
                    <div class="postVotes">
                      <div class="upvote voted" style="border-bottom-color: rgb(82, 93, 249);"></div>
                      <span>{!! $value->post_vote_count !!}</span>
                    </div>
                    <a class="postLink" href="/admin/board/feature/p/post-2">
                      <div class="body">
                        <div class="postTitle">
                          <span>{!! $value->post_title !!}</span>
                        </div>
                        <div class="statusStale"></div>
                        <div class="uppercaseHeader boardName"><?php echo $tag_name; ?></div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                </div>
                <!-- <div class="noPosts">Check back soon!</div> -->
              </div>
            </div>
          </div>
        </div>
        <?php } else{ ?>
          <div class="noBoards">
            <div>Your roadmap will appear here when you <a class="" href="">change the status</a> of a post</div>
          </div>
        <?php } ?>
      </div>
      
    </div>
  </div>
</div>
@endsection