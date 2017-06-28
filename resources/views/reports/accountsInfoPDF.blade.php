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
        @if(isset($budget )) <b><i> {{ $budget->budgetName }}</i></b> @endif
    </p>
    <p>School Main Account:
        @if(isset($budget ))<b><i> K{{ $budget->schoolIncome }}</i></b> @endif
    </p>
    <p>Department Income(Received from School main account):
        @if(isset($budget )) <b><i> K{{ $budget->departmentIncome }}</i></b> @endif
    </p>
    <p>Department Total Income:
        @if(isset($account )) <b><i> K{{ $account->calculatedTotal->incomeAcquired }}</i></b> @endif
    </p>
    <p>Department Total Expenditure:
        @if(isset($account )) <b><i> K{{ $account->calculatedTotal->expenditureAcquired }}</i></b> @endif
    </p>
    <p>Department Balance(As of today):
        @if(isset($account )) <b><i> K{{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }}</i></b> @endif
    </p>
    <br>
    <pre>
        <p><b>Report Printed By:</b>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}  <b>Date Printed:</b> {{date('d-m-Y')}}</p>
        </pre>

</div>
</body>
</html>