@extends("Admin.adminMaster")
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" style="margin-top: 3rem;">
                <a href="{{route('teacher-list')}}" class="btn btn-secondary">Go Back to The Teacher List </a>
                <div class="card-header">Add Teacher</div>
                <div class="card-body">
                    <form action="{{route('add-teacher')}}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-md-4 col-form-label">Designation</label>
                                <input style="background-color: white; color: #0a0a0a;" type="text" class="form-control" name="designation" />
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
                                <label class="col-md-4 col-form-label">Subject</label>
                                <input style="background-color: white;color: #0a0a0a;" type="text" class="form-control" name="subject" />
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-4 col-form-label">Image</label>
                                <input style="background-color: white;color: #0a0a0a;" type="file" class="form-control" name="image" />
                            </div>
                        </div>
                        
                        {{-- <div class="form-group row">
                            <label class="col-md-4 col-form-label">Image</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="image" />
                            </div>
                        </div> --}}
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
