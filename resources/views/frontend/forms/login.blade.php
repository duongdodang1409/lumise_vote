<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <h3 class="modal-title">Sign In</h3>

                <form method="post" id="loginFrom">
                    @csrf
                    @if(session('message'))
                        <p class="register_success">{{session('message')}}</p>
                    @endif
                    @if(session('error'))
                        <p class="login_error">{{session('error')}}</p>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" id="user_email_lg" name="user_email" placeholder="Your Email *" value="" />
                        <span class="error">

                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="user_password_lg" name="user_password" placeholder="Your Password *" value="" autocomplete="off"/>
                        <span class="error">

                        </span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Remember me
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <span class="error">


                        </span>
                        <button type="submit" id="login_form" class="btn-submit" name="login_user" value="Login" >Log in</button>
                        <div class="forgot">
                            <p class="note">Already have an account?<span><a href="{{URL('register')}}" class="part_lg" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sign_up">Sign Up</a></span></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#login_form").click(function(e){
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{URL('login')}}",
                type:'POST',
                dataType: "json",
                data: $('#loginFrom').serialize(),

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        console.log(data);
                        location.reload();
                    }else{
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[0] + '</div>');
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[1] + '</div>');
                    }
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[0] + '</div>');
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[1] + '</div>');




                }
            });

        });
        // function printErrorMsg (msg) {
        //     $(".error-lg").find("ul").html('');
        //     $(".error-lg").css('display','block');
        //     $.each( msg, function( key, value ) {
        //         $(".error-lg").find("ul").append('<li>'+value+'</li>');
        //     });
        // }
    });


</script>
