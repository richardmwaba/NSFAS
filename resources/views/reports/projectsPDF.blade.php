
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

        <strong>THE UNIVERSITY OF ZAMBIA <br> School Of Natural Science<br> Financial Accounting System<br> Project Report</strong>

    </h3>

</head>

<body>

<div>
    <!--foreach($projects as $project)-->

    <p>Project Name: {{$project->projectName}}</p><br>
    <p>Project Co-Ordinator: {{$project->projectCoordinator}}</p><br>
    <p>Project Department: {{$project->departments->departmentName}}</p><br>
    <p>Project Start Date: {{$project->startDate}}</p><br>
    <p>Project End Date: {{$project->endingDate}}</p><br>
    <p>Total Project Budget Amount: {{"K ".number_format($project->budget->actualProjectBudget, "2", ".", ",")}}</p><br>
    <p>Total Received Income: {{"K ".number_format($totalIn, "2", ".", ",")}}</p><br>
    <p>Amount Used: {{"K ".number_format($totalEx, "2", ".", ",")}} </p><br>
    <p>Available Amount:
        {{--@if($balance == 0)--}}
            {{--K {{$project->budget->actualProjectBudget}}.00--}}
        {{--@else--}}
        {{"K ".number_format($balance = $totalIn - $totalEx, "2", ".", ",")}}
        {{--@endif--}}

    </p><br>

    <!-- A list of the budget items-->

        <table>
            @if(isset($budgetItems))
            <tr>
                <th >Item Name</th>
                <th>Quantity</th>
                <th>Price Per Unit(K)</th>
                <th>Cost(K)</th>
            </tr>
            @endif

                @foreach($budgetItems as $budgetItem)
                <tr>
                    <td style="text-align: left">{{$budgetItem->description}} </td>
                    <td>{{$budgetItem->quantity}} </td>
                    <td>{{"K ".number_format($budgetItem->pricePerUnit, "2", ".", ",")}} </td>
                    <td>{{"K ".number_format($budgetItem->cost, "2", ".", ",")}} </td>
                </tr>
                @endforeach

       </table>

    <pre>
    <p>Report Printed By:<Strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>  Date Printed: <strong>{{date('d-m-Y')}}</strong></p>
        </pre>



</div>





</body>

</html>