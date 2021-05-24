@include('Frontend/layouts.head')
@include('Frontend/layouts.header')

<?php
$test = $getuser;

?>
<div class="settings-account">
    <div class="container">
        <div class="content-setting">

            <div class="titlesetting">
                <h3>Account Settings</h3>
            </div>

            @foreach ($test as $item)
                <form action="{{URL('dash')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(session('success'))
                        <p class="register_success">{{session('success')}}</p>
                    @endif
                    @if(session('error'))
                        <p class="login_error">{{session('error')}}</p>
                    @endif
                    <div class="form-group group-file">
                        <div class="avtar">
                            <image id="blah" src="{{ asset("frontend/images/$item->user_avatar") }}"/>
                        </div>
                        <div class="infile">
                            <input type="hidden"  id="old"  name="old"  value="{{$item->user_avatar}}">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="user_avatar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <span>Upload image</span>
                        </div>
                        <span class="error">
                            @if($errors->has('user_avatar'))
                                <p>{{$errors->first('user_avatar')}}</p>
                            @endif
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="email">nickname</label>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$item->user_id}}">
                        <input type="text" class="form-control" id="user_nickname" name="user_nickname" placeholder="Nick name" value="{{$item->user_nickname}}"/>
                        <span class="error">
                            @if($errors->has('user_nickname'))
                                <p>{{$errors->first('user_nickname')}}</p>
                            @endif
                        </span>
                    </div>

                    <div class="form-group-bottom">
                        <button type="submit" class="form-control chang_data_user" id="chang_data" name="chang_data" value="Update">Update</button>
                    </div>

                </form>

            @endforeach
        </div>

    </div>
</div>

@include('Frontend/layouts.footer')




