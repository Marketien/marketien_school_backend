<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 @vite(['resources/js/app.js','resources/css/app.css'])
    </head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <div class="card">
                    <div class="card-header">Payment Form </div>
                    <div class="card-body">
                        <div id="app">
                    <div :student = "{{$stdn->where('id',session('loggedStudent'))->first();}}"></div>
                        
                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" style="margin-top: 3rem;">

                <div class="card-header">Payment Form</div>
                <div class="card-body">
                    <form action="/reg-Student" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="background-color:green;">
                            @if (Session::get('success'))
                                <div style="color:black; margin: 1rem; ">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::get('Fail'))
                                <div style="color: red;">
                                    {{ Session::get('Fail') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Name</label>
                                <input style=" background-color: white; color: #0a0a0a;" type="text"
                                    class="form-control" name="name" value="{{$stdn->name}}" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Roll</label>
                                <input style="" type="text" class="form-control" name="rollNo" value="{{$stdn->rollNo}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Registration</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text"
                                    class="form-control" name="regNo" value="{{$stdn->regNo}}" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Class</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text"
                                    class="form-control" name="class" value="{{$stdn->class}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Payment For</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text"
                                    class="form-control" name="paymentFor" value="TutionFees" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Month</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text"
                                    class="form-control" name="email" />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-success" value="Payment By Bkash" />
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-success" value="Payment By OtherMethod" />
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
{{-- <script>
    function checkAll(main) {

all = document.getElementsByName('month[]');
for (var a = 0; a < all.length; a++) {
    all[a].checked = main.checked;
}
}
</script> --}}
{{-- <script>

    // import Payment from "../../js/components/payment";
    import Payment from '../../js/components/payment';
    export default {
        components: {Payment}
    }
</script> --}}


</html>
