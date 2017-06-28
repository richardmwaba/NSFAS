<!DOCTYPE>
<html>
<head>
    <title>Accounts Summary</title>
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

        <strong>THE UNIVERSITY OF ZAMBIA <br> School Of Natural Science<br> Financial Accounting System<br>Accounts Summary</strong>

    </h3>

</head>
<body>
<div>
    <p>
        @if(isset($account)) {{ $account->accountName }} @endif
    </p>
    <p>Budget Line:
        @if(isset($budget ))  {{ $budget->budgetName }} @endif
    </p>
    <p>School Main Account:
        @if(isset($budget )) K{{ $budget->schoolIncome }} @endif
    </p>
    <p>Department Income(Received from School main account):
        @if(isset($budget ))  K{{ $budget->departmentIncome }} @endif
    </p>
    <p>Department Total Income:
        @if(isset($account ))  K{{ $account->calculatedTotal->incomeAcquired }} @endif
    </p>
    <p>Department Total Expenditure:
        @if(isset($account ))  K{{ $account->calculatedTotal->expenditureAcquired }} @endif
    </p>
    <p>Department Balance(As of today):
        @if(isset($account ))  K{{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }} @endif
    </p>
    <br>
    <pre>
    <p>Report Printed By:<Strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>  Date Printed: <strong>{{date('d-m-Y')}}</strong></p>
        </pre>

</div>
</body>
</html>