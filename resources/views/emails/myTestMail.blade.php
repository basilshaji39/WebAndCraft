<!DOCTYPE html>
<html>
<head>
    <title>Email From WebandCraft</title>
    <style>
        body{
            background-color: #4682b4;
            font-family: Arial, Helvetica, sans-serif;
        }
        #header{
            color: #f46f46;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1 id="header">Welcome to {{$details['title'] }}</h1>
    <h5>Your Account has been created with user id {{$details['to-email'] }}</h5>
    <h5>Your password is {{ $details['rand-pass'] }}</h5>
    <p>Thank You</p>
</body>
</html>