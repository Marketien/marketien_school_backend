<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">
        
        <div class="row">
            <div class="col">
                Name:
            </div>
            <div class="col">
                {{ $stdn->name }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                Roll:
            </div>
            <div class="col">
                {{ $stdn->rollNo }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                Registration No:
            </div>
            <div class="col">
                {{ $stdn->regNo }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                class:
            </div>
            <div class="col">
                {{ $stdn->class }}
            </div>
        </div>
        <div>
            <a href="{{route('otp-login')}}" class="btn btn-success">Payment</a>
       </div>
       <br>
       <div>
        <a href="/logout-student" class="btn btn-success">Logout</a>
   </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
