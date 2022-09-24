<!DOCTYPE html>
<!-- Style Sheets -->
<link rel="stylesheet" href="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css')}}">
<link href="{{ asset('../resources/css/dataTables/jquery.dataTables.min.css') }}" rel="stylesheet">

<!-- Scripts -->

<script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}"></script>
<script src="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js')}}"></script>
<script src="{{ asset('../resources/js/dataTables/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset('../resources/js/historical-data.js')}}"></script>

<html>
<head>
    <title>Historical Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
{{--    email status alert--}}
    @if ($data['email-status'])
        <div class="alert alert-success">
            Email Sent Successfully.
        </div>
    @else
        <div class="alert alert-danger">
            Sending Email Failed.
        </div>
    @endif
{{--    Graphical Data Representation--}}
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Graphical Data For <span class="strong">{{$data['companyname']}}</span> With date-range {{$data['startdate']}} - {{$data['enddate']}}
        </div>
        <div class="card-body">
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>
    </div>
{{--    Tabular Data Representation--}}
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Historical Data For <span class="strong">{{$data['companyname']}}</span>
        </div>
        <div class="card-body">
            <table class="dataTable table table-striped table-hover" id="historical_data">
                <thead>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
                </thead>
                <tbody>
                @foreach($data['$historical_data'] as $record)
                    <tr>
                        @foreach($record as $key => $value)
                            @if($key=='date')
                                <td data-sort="{{$value}}">{{date("Y-m-d",$value)}}</td>
                            @elseif ($key != 'adjclose')
                                <td>{{$value}}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
