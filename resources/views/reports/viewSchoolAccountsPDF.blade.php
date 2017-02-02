<!DOCTYPE>
<html>
<head>
    <title>Actual Budget Report</title>
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

        <strong>THE UNIVERSITY OF ZAMBIA <br> School Of {{ $schoolName }}<br> Financial Accounting System<br>School Actual Budget Report</strong>

    </h3>

</head>
<body>
<div>
    <p>School:
        @if(isset($schoolName)) The School Of {{ $schoolName }} @endif
    </p>
    {{--<p>Total A.C Budget Amount:--}}
        {{--@if(isset($totalBudget ))  k {{ $totalBudget }}.00 @endif--}}
    {{--</p>--}}
    <br>
    <table>
        @if(isset($accounts))
            <tr>
                <th>Account Name</th>
                <th>Total Income</th>
                <th>Total Expenditure</th>
                <th>Total Balance( as of Today)</th>
            </tr>
        @endif
        @foreach( $accounts as $rcd)
            <tr>

                <td> @if(isset($rcd)) {{ $rcd->accountName   }} @endif </td>
                <td> @if(isset($rcd)) K {{ $rcd->calculatedTotal->incomeAcquired }}.00 @endif </td>
                <td> @if(isset($rcd)) K {{ $rcd->calculatedTotal->expenditureAcquired  }}.00 @endif </td>
                <td> @if(isset($rcd))  K {{ $rcd->calculatedTotal->incomeAcquired - $rcd->calculatedTotal->expenditureAcquired }}.0 @endif </td>
            </tr>
        @endforeach
    </table>
    <pre>
    <p>Report Printed By:<Strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>  Date Printed: <strong>{{date('d-m-Y')}}</strong></p>
        </pre>

</div>
</body>
</html>