<!DOCTYPE>
<html>
<head>
    <title>Imprest Report</title>

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
            padding:10px;
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


    <h3 style="text-align: center"><img src="../public/frontend/img/logo.png"  width="120" height="132"><br><u><strong>Imprest Report</strong></u></h3>

</head>
<body>

<div>

    <p>Name Of Applicant:{{$imprest}}</p><br>
    <p>Applicants Department:{{$imprest->}}</p><br>
    <p>Amount Requested:{{$imprest->amountRequested}}</p><br>
    <p>Purpose:{{$imprest->}}</p><br>
    <p>Budget Line:{{$imprest->budgetLine}}</p><br>
    <p>Name Of Authorizing H.O.D:{{$imprest->}}</p><br>
    <p>Name Of Authorizing Dean:{{$imprest->}}</p><br>
    <p>Name Of Authorizing Bursar:{{$imprest->}}</p><br>
    <p>Authorized Amount:{{$imprest->authorizedAmount}}</p><br>
    <p>Date Obtained:{{$imprest->}}</p><br>
    <p>Date Request Was Made:{{$imprest->}}</p>
    <pre> Imprest History</pre>
    <!-- We could have a for each here to show the history of all the previous imprest requests, authorized only?? -->
    <p>
        <!-- Those values come here-->

    </p>

    <pre>
    <p>Report Printed By:          Date Printed: </p>
        </pre>


</div>





</body>

</html>