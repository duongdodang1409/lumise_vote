<form action="{{url('/login')}}" method="post">
	<?php  
	$test = session()->get('user_nickname');
	var_dump($test);
	$user_permission = session()->get('user_permission');
	var_dump($user_permission);
	$user_id = session()->get('user_id');
	var_dump($user_id);
	?>
	<label for="">Email: </label>
	<input type="text" name="user_email">
	<label for="">Password: </label>
	<input type="text" name="user_password">
	<button class="btn btn-success" type="submit">Login</button>

</form>