<DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Hi {{$data['name']}} {{$data['surname']}}, we’re glad you’re here! Following are your account details:</h2><br>
	<h3>Email: </h3><p>{{$data['email']}}</p>
	<h3>Username: </h3><p>{{$data['username']}}</p>
</body>
</html>