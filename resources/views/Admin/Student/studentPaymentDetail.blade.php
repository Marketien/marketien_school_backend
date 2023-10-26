{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body> --}}
@extends('Admin.adminMaster')
@section('content')
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

    </div>
    {{-- Paymet Details --}}
    <div class="row">
        <div class="col-lg-12 bg-white mx-auto mt-5">
            <h4 class="text-success">{{ Session::get('message') }}</h4>
            <div class="card bg-white">
                <h4 class="card-header">Payment Details</h4>

                <div class="card-body bg-white">
                    <div class="bg-white">
                        <form action="/payment-search" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="query" value="Search" />
                                </label>
                                <div class="col-md-6 ml-0">
                                    <button type="submit" class="btn btn-behance"><i class="fa fa-search"></i></button>
                                    <span class="float-right col-md-6 addBtn"><a href="/student-form"
                                            class="btn btn-success float-right">+Add</a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Reg No:</th>
                                    <th>months </th>
                                    <th>Amount</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <?php
                                    $month = implode(',', $payment->months);
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->class }}</td>
                                        <td>{{ $payment->regNo }}</td>
                                        <td>{{ $month }}</td>
                                        <td>{{ $payment->amount }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- End --}}
{{-- </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html> --}}
