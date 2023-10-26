<div class="modal fade" id="detailModal{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Student Detail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-element" >
                    <div class="row" style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Student Name:</label>
                        <label class="col-md-6 col-form-label">{{$student->name}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Father Name:</label>
                        <label class="col-md-6 col-form-label">{{$student->fatherName}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Mother Name:</label>
                        <label class="col-md-6 col-form-label">{{$student->motherName}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Phone Number:</label>
                        <label class="col-md-6 col-form-label">{{$student->phoneNo}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Date of Birth:</label>
                        <label class="col-md-6 col-form-label">{{$student->birthDate}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Email:</label>
                        <label class="col-md-6 col-form-label">{{$student->email}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Address:</label>
                        <label class="col-md-6 col-form-label">{{$student->address}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Class:</label>
                        <label class="col-md-6 col-form-label">{{$student->class}}</label>
                    </div>
                    <div class="row"style="background-color: orange;" >
                        <label class="col-md-6 col-form-label">Section:</label>
                        <label class="col-md-6 col-form-label">{{$student->section}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Roll Number:</label>
                        <label class="col-md-6 col-form-label">{{$student->rollNo}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Registration Number:</label>
                        <label class="col-md-6 col-form-label">{{$student->regNo}}</label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
