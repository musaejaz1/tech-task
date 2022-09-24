<!DOCTYPE html>
<!-- Style Sheets -->

<link rel="stylesheet" href="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css')}}">
<link href="{{ asset('../resources/css/jquery-ui.min.css') }}" rel="stylesheet">

<!-- Scripts -->

<script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}"></script>
<script src="{{url('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js')}}"></script>
<script src="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('../resources/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('../resources/js/historical-data-form.js')}}"></script>
<html>
<head>
    <title>Historical Data Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
{{--    Error alert field if any--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
{{--    Form for data input--}}
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Enter Information to Retrieve Historical Data
        </div>
        <div class="card-body">
            <form name="historical-data-form" id="historical-data-form" method="post" action="{{url('process-form')}}">
                @csrf
                <div class="form-group">
                    <label>Company Symbol</label>
                    <input type="text" id="company_symbol" name="company_symbol" class="form-control">
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="text" id="end_date" name="end_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
