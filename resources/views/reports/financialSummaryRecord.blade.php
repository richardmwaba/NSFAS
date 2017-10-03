<!DOCTYPE>
<html>
<head>
    <title>Summary Financial Report</title>
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

        <strong>THE UNIVERSITY OF ZAMBIA <br> School Of {{ $schoolName }}<br> Financial Accounting System<br>  Financial Reecord Summary for {{ '$departments->departmentName}} </strong>

    </h3>

</head>
<body>
<div>
    <p>Department Account Name: @if(isset($account))
                                    {{ $account->accountName }}
                                    @endif </p>
		

    <p>BudgetLine: @if(isset($budget))
                                    {{ $budget->budgetName }}
                                    @endif </p>

        <br>

    <p>School Main Account: @if(isset($budget))
                                    k {{ $budget->schoolIncome }}.00
                                    @endif</p>

        <br>

    <p> Department Income(Received from School main account):  @if(isset($budget))
                                    K {{ $budget->departmentIncome }}.00
                                    @endif</p>

        <br>

    <p>Department Total Income:  @if(isset($account))
                                    K {{ $account->calculatedTotal->incomeAcquired }}.00
                                    @endif </p>

        <br>

    <p> Department Total Expenditure:  @if(isset($account))
                                    K {{ $account->calculatedTotal->expenditureAcquired }}.00
                                    @endif</p>

        <br>

    <p>Department Balance(As of today):  isset($account))
                                    K {{ $account->calculatedTotal->incomeAcquired - $account->calculatedTotal->expenditureAcquired }}.00
                                    @endif </p>

        <br>
   
    <pre>
         <p>Report Printed By:<Strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>  Date Printed: <strong>{{Date('d-m-Y')}}</strong></p>
    </pre>

</div>
</body>
</html>

