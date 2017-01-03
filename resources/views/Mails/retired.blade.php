<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hi,</title>
</head>
<body>

<p>
    {{$message}}
    <a href="{{url('/imprests/edit/'.$imprest->imprestId)}}">Click here to view it</a>
</p>

</body>
</html>