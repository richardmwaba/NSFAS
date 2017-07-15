
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

        table {
            width:100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
        table tr:nth-child(even) {
            background-color: #eee;
        }
        table tr:nth-child(odd) {
            background-color:#fff;
        }
        table th {
            background-color: #222222;
            color: white;
        }

    </style>

    <h3 style="text-align: center"><img src="../public/frontend/img/logo.png"
                                        width="120" height="135"><br>

        <strong>THE UNIVERSITY OF ZAMBIA <br> School Of Natural Science<br> Financial Accounting System<br> Imprest Summary Report</strong>

    </h3>

</head>

<body>

<div>
    <!--foreach($projects as $project)-->

    <p>Account: {{$request->accountName}}</p><br>
    <p>Total Balance In Account: {{"K ".number_format($request->initialBalance, "2", ".", ",")}}</p><br>
    <p>Balance After Withdraw: {{"K ".number_format($request->currentBalance, "2", ".", ",")}}</p><br>
    <p>Purpose: {{$request->description}}</p><br>
    <p>Budget Line: {{$request->budgetName}}</p><br>
    <p>Beneficiary: {{$request->applicantNames}}</p><br>
    <p>Department: {{$request->department}}</p><br>

    <pre>
    <p>Report Printed By:<Strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>  Date Printed: <strong>{{date('d-m-Y')}}</strong></p>
        </pre>



</div>





</body>

</html>