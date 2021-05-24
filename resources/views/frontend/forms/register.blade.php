<div class="modal fade" id="sign_up" tabindex="-1" role="dialog" aria-labelledby="sign_up" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger error-rg" style="display:none">

                </div>
                <div class="success-rg">

                </div>
                <h3 class="modal-title">Sign Up</h3>
                <form method="post" id="registerForm">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" name="user_nickname" id="user_nickname" placeholder="Nick Name *" value="" />
                        <span class="error">

                        </span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email *" name="user_email" id="user_email" value="" />
                        <span class="error">

                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" name="user_password" id="user_password" value="" />
                        <span class="error">

                        </span>

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password Confirmation *" name="user_password_confirmation" id="confirm_password" value="" />
                        <span class="error">

                        </span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            I agree to all <span><a href="#">Terms</a> </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha g_recaptcha_response" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <span class="error">
                        </span>
                        <div class="form-group">
                            <button type="submit" class="btn-submit" id="send_form" name="register_user" value="register" >Sign Up</button>
                        </div>
                        <p class="note">Already have an account?<span><a href="{{URL('login')}}" class="part_lg" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#login">Sign In</a></span></p>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#send_form").click(function(e){
            e.preventDefault();
            // var user_nickname = $("input[name='user_nickname']").val();
            // var user_email = $("input[name='user_email']").val();
            // var user_password = $("input[name='user_password']").val();
            // var user_password_confirmation = $("input[name='user_password_confirmation']").val();
            // var g_recaptcha_response = $("textarea[id='g-recaptcha-response']").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{URL('register')}}",
                type:'POST',
                dataType: "json",
                data: $('#registerForm').serialize(),
                success: function(data) {
                    if(data.success != undefined){
                        $('.success-rg').html('<div class="text-success" >' + data.success + '</div>');

                    }
                    if($.isEmptyObject(data.error)){
                        // location.reload();
                    }else{
                        console.log(data.error);
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[0] + '</div>');
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[1] + '</div>');
                        $('.error').html('<div class="alert alert-danger col-sm-12" >' + data.error[2] + '</div>');
                    }
                    if(data.error_now != undefined){
                        $(".error-rg").find("ul").html('');
                        $(".error-rg").css('display','block');
                        $('.error-rg').html('<div class="text-danger" >' + data.error_now + '</div>');
                    }
                },
                // success: function(response) {
                //     console.log(response);
                // },
                error: function(data) {
                    $('.modal-title').html('<div class="text-danger" >' + data.error_now + '</div>');
                }


            });

        });

    });


</script>
