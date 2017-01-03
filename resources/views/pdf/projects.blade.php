<!DOCTYPE>
<html>
<head>
    <title>Project Report</title>

    <style type="text/css">

        p{
            padding-left: 30px;
        }

        section {
            width: 50%;
            float: left;
            padding:10px;
            height: 270px;
            border-style: groove;
        }


        span{
            width: 38%;
            height: 270px;
            padding: 10px;
            float: right;
            border-style: groove;
        }

        article{
            width: 40%;
            height: 270px;
            padding:10px;

            border-style: groove;

        }

    </style>

    <h3 style="text-align: center"><img src="../public/frontend/img/logo.png" width="120" height="135"><br><u><strong>Project Report</strong></u></h3>

</head>

<body>

<div>
    <!--foreach($projects as $project)-->

    <p>Project Name:{{--$projects->--}}</p><br>
    <p>Project Co-Ordinator:</p><br>
    <p>Project Department:</p><br>
    <p>Project Start Date:</p><br>
    <p>Project End Date:</p><br>
    <p>Total Project Budget Amount:</p><br>
    <p>Available Amount:</p><br>
    <p>Amount Used:</p>
    <pre>
    <p>Report Printed By:          Date Printed: </p>
        </pre>

        <!--endforeach -->
</div>





</body>

</html>