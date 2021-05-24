<footer>
    <div class="container">
        <p>Powered by Datpv</p>
    </div>

</footer>
@if(Session::has('user_id') == "")
@include('Frontend/forms.register')
@include('Frontend/forms.login')
@endif


<script src='https://kit.fontawesome.com/a076d05399.js'></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src='{{asset('frontend/js/main.js')}}'></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>




</script>


</body>

</html>
