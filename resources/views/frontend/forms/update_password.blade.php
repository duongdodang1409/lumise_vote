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
                <form action="{{ url('dash/update_password') }}" method="post" >
                    @csrf
                    @if(session('success'))
                        <p class="register_success">{{session('success')}}</p>
                    @endif
                    @if(session('error'))
                        <p class="login_error">{{session('error')}}</p>
                    @endif


                    <div class="form-group">
                        <label for="password">password old</label>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="" value="{{$item->user_id}}"/>
                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter password old" value=""/>
                        <span class="error">
                        @if($errors->has('user_password'))
                            <p>{{$errors->first('user_password')}}</p>
                        @endif
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">password new</label>
                        <input type="password" class="form-control" id="password_new" name="password_new" placeholder="Enter password new" value=""/>
                        <span class="error">
                        @if($errors->has('password_new'))
                            <p>{{$errors->first('password_new')}}</p>
                        @endif
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">password confirm</label>
                        <input type="password" class="form-control" id="password_new_confirmation" name="password_new_confirmation" placeholder="Enter password new confirm" value=""/>
                        <span class="error">
                        @if($errors->has('password_new_confirmation'))
                            <p>{{$errors->first('password_new_confirmation')}}</p>
                        @endif
                        </span>
                    </div>
                    <div class="form-group-bottom">
                        <button type="submit" class="form-control chang_data_user" id="chang_data" name="chang_data" value="Update">Update password</button>
                    </div>

                </form>

            @endforeach
        </div>

    </div>
</div>

@include('Frontend/layouts.footer')




