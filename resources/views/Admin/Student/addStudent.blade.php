@extends("Admin.adminMaster")
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" style="margin-top: 3rem;">
                <a href="/student-list" class="btn btn-secondary">Go Back to The Student List </a>
                <div class="card-header">Add Photo Form</div>
                <div class="card-body">
                    <form action="/addStudent" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="background-color:green;">
                            @if(Session::get('success'))
                                <div style="color:black; margin: 1rem; ">
                                    {{Session::get('success')}}
                                </div>
                            @endif

                            @if(Session::get('Fail'))
                                <div style="color: red;">
                                    {{Session::get('Fail')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Name</label>
                                <input style=" background-color: white; color: #0a0a0a;" type="text" class="form-control" name="name" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Birth Date</label>
                                <input style="" type="date" class="form-control" name="birthDate" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Father's Name</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="fatherName" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Mother's Name</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="motherName" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Phone Number</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="phoneNo" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Email</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Password</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="password" />
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Sex</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="sex" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Roll Number</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="rollNo" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Registration</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="regNo" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Class</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="class" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Section</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="section" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Address</label>
                            <div class="col-md-8">
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="address" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Image</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="image" />
                            </div>
                        </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label"></label>
                    <div class="col-md-8">
                        <input type="submit" class="btn btn-success" value="Save" />
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
