<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hi,</title>
</head>
<body>

<p>
    Your imprest has exceeded the 48 hour limit. Charges may now be performed from your account.
    <a href="{{url('/imprests/edit/'.$imprest->imprestId)}}">Click here to view it</a>
</p>

</body>
</html>