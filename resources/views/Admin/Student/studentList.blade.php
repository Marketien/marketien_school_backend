@extends('Admin.adminMaster')
@section('content')
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <style>
        @media only screen and (min-width: 1100px){
            .addBtn{
                margin-left: 20rem;
            }
        }

    </style>
    <div class="row">
        <div class="col-lg-12 bg-white mx-auto mt-5">
                            <h4 class="text-success">{{ Session::get('message') }}</h4>
            <div class="card bg-white">
                <h4 class="card-header">All Students</h4>

                <div class="card-body bg-white">
                    <div class="bg-white">
                        <form action="/student-search" method="GET">
                            <div class="form-group row" >
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="query" value="Search"/>
                                </label>
                                <div class="col-md-6 ml-0" >
                                    <button type="submit" class="btn btn-behance"><i class="fa fa-search"></i></button>
                                    <span class="float-right col-md-6 addBtn" ><a href="/student-form" class="btn btn-success float-right">+Add</a></span>
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
                                <th>Roll</th>
                                <th>Reg No:</th>
                                <th>Class </th>
                                <th>Picture </th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)

                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->rollNo}}</td>
                                    <td>{{$student->regNo}}</td>
                                    <td>{{$student->class}}</td>
                                    <td><img src="{{asset('image/upload/'.$student->image)}}" width="70px" height="70px" alt="image"></td>
                                    <td>
                                        <a href="/student-edit/{{$student->id}}" class="btn btn-success btn-sm" title="Update">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="/student-payment-detail/{{$student->id}}"  class="btn btn-primary btn-sm"  title="Detail" >
                                            <i class="fa fa-eye"></i>
                                        </a>
{{--                                        <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('studentInfo', $student->id) }}" >--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
                                        <a href="/student-delete/{{$student->id}}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    @include('Admin.Student.studentDetail')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex">{{$students->onEachSide(5)->links()}}</div> --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<!-- Delete Modal -->
{{----}}<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title text-danger">Delete Student</h5>--}}

{{--            </div>--}}
{{--            <div class="modal-body">--}}

{{--                <span class="text-dark">Are you sure to delete this student?</span>--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <form action="{{ route('deleteStudent') }}" class="form-group" method="post" enctype="multipart/form-data">--}}
{{--                    {{csrf_field()}}--}}
{{--                    <input type="hidden" id="user-id" name="id">--}}
{{--                    <input type="submit" class="btn btn-danger" id="yes" value="Yes">--}}
{{--                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--    End delete Modal--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<script>--}}
{{--    //-----------cancel ride-----------------}}
{{--    $(document).ready(function () {--}}

{{--        $('body').on('click', '#delete', function () {--}}
{{--            var userURL = $(this).data('url');--}}
{{--            $.get(userURL, function (data) {--}}
{{--                $('#deleteModal').modal('show');--}}
{{--                $('#user-id').val(data.id);--}}

{{--            })--}}
{{--        });--}}
{{--    });--}}
{{--</script>

@endsection
