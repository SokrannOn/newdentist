@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Staff
            </div>
            <div class="panel-body">
                {{--create--}}
                <div id="editStaff">
                    {!! Form::open(['action'=>'StaffController@store','method'=>'POST','files'=>true]) !!}
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('name','Staff Name',['class'=>'edit-label required']) !!}
                                    {!! Form::text('name',null,['class'=>'edit-form-control text-blue','placeholder'=>'Staff name','required'=>'true']) !!}
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('contact','Contact',['class'=>'edit-label required']) !!}
                                    {!! Form::text('contact',null,['class'=>'edit-form-control text-blue','placeholder'=>'Phone number','required'=>'true']) !!}
                                    @if($errors->has('contact'))
                                        <span class="text-danger">{{$errors->first('contact')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                {!! Form::label('gender','Gender',['class'=>'edit-label required']) !!}
                                <div class="form-group" style="margin-top: 2%">
                                        <div class="radio-inline radio radio-primary">
                                            <input type="radio" name="gender" id="male" value="M" required>
                                            <label for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-inline radio radio-success">
                                            <input type="radio" name="gender" id="female" value="F" required>
                                            <label for="female">
                                                Female
                                            </label>
                                        </div>
                                    @if($errors->has('gender'))
                                        <span class="text-danger">{{$errors->first('gender')}}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('level','Level',['class'=>'edit-label required']) !!}
                                    {!! Form::text('level',null,['class'=>'edit-form-control text-blue','placeholder'=>'Level','required'=>'true']) !!}
                                    @if($errors->has('level'))
                                        <span class="text-danger">{{$errors->first('level')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('email','Email',['class'=>'edit-label required']) !!}
                                    {!! Form::email('email',null,['class'=>'edit-form-control text-blue','placeholder'=>'example@email.com','required'=>'true']) !!}
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('commission','Commission',['class'=>'edit-label required']) !!}
                                    {!! Form::text('commission',null,['class'=>'edit-form-control text-blue','placeholder'=>'Commission','required'=>'true']) !!}
                                    @if($errors->has('commission'))
                                        <span class="text-danger">{{$errors->first('commission')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 col-xs-5 col-sm-2">
                                <div class="form-group">
                                    <img src="{{asset('/photo/default_user.png')}}" alt="" id="preView" style="height: 80px; width: 80px; border-radius: 50px; border: 2px solid #346895; padding: 2px;">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="image" class="btn btn-primary" style="padding: 4px 16px;">Browse</label>
                                    <input type="file" class="edit-form-control" id="image" onchange="loadFile(event)" accept="image/*" name="image" style="display: none;">
                                    @if($errors->has('image'))
                                        <span class="text-danger">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('baseSalary','Base Salary',['class'=>'edit-label required']) !!}
                                    {!! Form::text('baseSalary',null,['class'=>'edit-form-control text-blue','placeholder'=>'Base salary','required'=>'true']) !!}
                                    @if($errors->has('baseSalary'))
                                        <span class="text-danger">{{$errors->first('baseSalary')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('branch_id','Branch Name',['class'=>'edit-label']) !!}
                                    {!! Form::select('branch_id',$branch,null,['class'=>'edit-form-control height-35px text-blue','placeholder'=>'Please select one' ]) !!}
                                    @if($errors->has('branch_id'))
                                        <span class="text-danger">{{$errors->first('branch_id')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('effectDate','Effect Date',['class'=>'edit-label required']) !!}
                                    {!! Form::date('effectDate',null,['class'=>'edit-form-control text-blue','required'=>'true']) !!}
                                    @if($errors->has('effectDate'))
                                        <span class="text-danger">{{$errors->first('effectDate')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('endDate','End Date',['class'=>'edit-label required']) !!}
                                    {!! Form::date('endDate',null,['class'=>'edit-form-control text-blue','required'=>'true']) !!}
                                    @if($errors->has('endDate'))
                                        <span class="text-danger">{{$errors->first('endDate')}}</span>
                                    @endif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('address','Address',['class'=>'edit-label']) !!}
                                    {!! Form::textarea('address',null,['class'=>'edit-form-control text-blue','rows'=>'2','placeholder'=>'Address']) !!}
                                    @if($errors->has('address'))
                                        <span class="text-danger">{{$errors->first('address')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::submit('Create',['class'=>'btn btn-success btn-sm' ]) !!}
                                    {!! Form::reset('Clear',['class'=>'btn btn-warning btn-sm' ]) !!}
                                    <a href="{{URL::to('/')}}" class="btn btn-default btn-sm">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                {{--create--}}
            </div>
            <div class="panel-footer">
                <div id="listViews">
                    <div id="loading" class="center">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    </div>
                </div>
            </div>
            {{--End User Views--}}
            </div>

            <div id="viewStaff" class="modal fade" role="dialog">
                <div id="viewStaff">

                </div>
            </div>
        </div>
    </div>
@stop
@section('script')

    <script type="text/javascript">
        var loadFile = function(event) {
            var output = document.getElementById('preView');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileEdit = function(event) {
            var output = document.getElementById('preViewEdit');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        $(document).ready(function () {
            getTableViewStaff();
        });
        function getTableViewStaff() {
            $.ajax({
                type : 'get',
                url : "{{route('staff.index')}}",
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#listViews').html(data);
                    $('#staffList').DataTable();
                }, error:function (error) {
                    console.log(error);
                }
            });
        }
        function editStaff(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/staff/edit/')}}"+"/"+id,
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#editStaff').html(data);
                }, error:function (error) {
                    console.log(error);
                }
            });
        }
        function cancel() {
            window.location.reload();
        }
        function deleteStaff(id) {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this staff ?",
                type: "warning",
                showCancelButton:true,
                confirmButtonText: "Yes",
                cancelButtonText : "No",
                cancelButtonColor:"#d33",
                confirmButtonColor: "#dd4b39"
            }, function() {
                $.ajax({
                    url : "{{url('/staff/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");

                        $(document).ready(function () {
                            getTableViewStaff();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

        function viewStaff(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/staff/view/')}}"+"/"+id,
                dataType : 'html'
                ,success:function (data) {
                    $('#viewStaff').html(data);
//                    $.sweetModal({
//                        width: 'auto',
//                        content: data,
//                        type: $.sweetModal.TYPE_ALERT,
//                        theme: $.sweetModal.THEME_MIXED
//                    });
                }, error:function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@stop