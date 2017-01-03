<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

use App\Departments;

$q = intval($_GET['q']);
$dep = Departments::where('id', $q)->first();
$name = $dep->departmentName;

while($row = mysqli_fetch_array($dep)) {

    echo " " . $row['departmentName'] . " ";

}

?>
</body>
</html>
