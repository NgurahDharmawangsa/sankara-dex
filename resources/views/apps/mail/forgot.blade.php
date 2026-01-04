<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    Hallo {{ ucwords(strtolower($user->name)) }}, <br>
    We received a password reset request email. please enter the verification code to continue resetting your password
    <br>
    Verification Code : <b> {{ $code }} </b> <br>
    Please enter this verification code immediately to verify your email.
    <br> <br>
    Thank You. <br>
    {{ config('name') }}
</body>

</html>
