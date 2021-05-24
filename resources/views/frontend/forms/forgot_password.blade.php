@include('Frontend/layouts.head')
<div class="login-container">
    <div class="container form_main">

        <div class="row justify-content-center">

            <div class="col-md-6 login-form-2">
                <h3>Forgot Password</h3>
                @if(session('message'))
                    <div class="show_hide">
                        <p class="login_error">New password : {{session('message')}}</p>
                        @endif
                        <form method="post" action="{{URL('forget_password')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" class="form-control" name="user_email" placeholder="Your Email *" value="" />
                                <span class="error">
                                 @if($errors->has('user_email'))
                                        <p>{{$errors->first('user_email')}}</p>
                                    @endif
                            </span>
                            </div>
                            <div class="form-group justify-content-center align-items-center d-flex">
                                <input type="submit" class="btnSubmit" name="forgot_pass" value="Submit" />
                                <a href="{{URL('login')}}" class="link_register">Login</a>
                            </div>
                        </form>
                        @if(session('message'))
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
