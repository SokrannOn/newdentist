@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Doctor
            </div>
            <div class="panel-body">
                {{--create--}}
                <div id="editDoctor">
                    {!! Form::open(['action'=>'DoctorController@store','method'=>'POST','files'=>true]) !!}
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('name','Doctor Name',['class'=>'edit-label required']) !!}
                                    {!! Form::text('name',null,['class'=>'edit-form-control text-blue','placeholder'=>'Doctor name','required'=>'true']) !!}
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
                                            <input type="radio" name="gender" id="female" value="F">
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
                                    {!! Form::label('grade','Grade',['class'=>'edit-label required']) !!}
                                    {!! Form::text('grade',null,['class'=>'edit-form-control text-blue','placeholder'=>'Grade','required'=>'true']) !!}
                                    @if($errors->has('grade'))
                                        <span class="text-danger">{{$errors->first('grade')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('section_id','&nbsp;Section',['class'=>'edit-label required']) !!}
                                    <div class="input-group">
                                        {!! Form::select('section_id',$section,null,['class'=>'form-control  text-blue','placeholder'=>'---Please select one---', 'id'=>'section_id','required'=>'true','style'=>'border-bottom-left-radius: 5px; border-top-left-radius: 5px;']) !!}
                                        <span class="input-group-btn">
                                                <button class="btn btn-secondary" data-toggle="modal" data-target="#section" onclick="addSec()" type="button"><i class="fa fa-plus fa-fw" style="color: #0b93d5"></i></button>
                                        </span>
                                    </div>
                                    @if($errors->has('section_id'))
                                        <span class="text-danger">{{$errors->first('section_id')}}</span>
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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('baseSalary','Base Salary',['class'=>'edit-label required']) !!}
                                    {!! Form::text('baseSalary',null,['class'=>'edit-form-control text-blue','placeholder'=>'Base salary','required'=>'true']) !!}
                                    @if($errors->has('baseSalary'))
                                        <span class="text-danger">{{$errors->first('baseSalary')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('branch_id','Branch Name',['class'=>'edit-label']) !!}
                                    {!! Form::select('branch_id',$branch,null,['class'=>'edit-form-control height-35px text-blue','placeholder'=>'Please select one' ]) !!}
                                    @if($errors->has('branch_id'))
                                        <span class="text-danger">{{$errors->first('branch_id')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('effectDate','Effect Date',['class'=>'edit-label required']) !!}
                                    {!! Form::date('effectDate',null,['class'=>'edit-form-control text-blue','required'=>'true']) !!}
                                    @if($errors->has('effectDate'))
                                        <span class="text-danger">{{$errors->first('effectDate')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('endDate','End Date',['class'=>'edit-label required']) !!}
                                    {!! Form::date('endDate',null,['class'=>'edit-form-control text-blue','required'=>'true']) !!}
                                    @if($errors->has('endDate'))
                                        <span class="text-danger">{{$errors->first('endDate')}}</span>
                                    @endif
                                </div>
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
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Doctor Views</div>
                    <div class="panel-body">
                        <div id="listViews">
                            <div id="loading" class="center">
                                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            </div>
                        </div>
                        <div id="viewDoctor" class="modal fade" role="dialog">
                            <div id="viewDoctor">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--End User Views--}}
            {{--section popup--}}

            <div id="section" class="modal fade bs-province-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div style="margin: 15%">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Section
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>
                            <div class="panel-body">
                                {!! Form::label('Section Name') !!}
                                {!! Form::text('name',null,['class'=>'edit-form-control','id'=>'sectionname','autocomplete'=>'off','required'=>true]) !!}
                            </div>
                            <div class="panel-footer">
                                <div id="createSec">
                                    <input type="button" value="Create" class="btn btn-success btn-sm" onclick="addSection()">
                                    <input type="button" value="Close" data-dismiss="modal" class="btn btn-danger btn-sm">
                                </div>
                                <div hidden id="createSecClose">
                                    <input type="button" value="Create Close" data-dismiss="modal" class="btn btn-success btn-sm" onclick="addSection()">
                                    <input type="button" value="Close" data-dismiss="modal" class="btn btn-danger btn-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end section--}}
            </div>
            <div class="panel-footer">

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
            getTableViewDoctor();
        });
        function getTableViewDoctor() {
            $.ajax({
                type : 'get',
                url : "{{route('doctor.index')}}",
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#listViews').html(data);
                    $('#doctorList').DataTable();
                }, error:function (error) {
                    console.log(error);
                }
            });
        }
        function editDoctor(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/doctor/edit/')}}"+"/"+id,
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#editDoctor').html(data);
                }, error:function (error) {
                    console.log(error);
                }
            });
        }
        function cancel() {
            window.location.reload();
        }
        function deleteDoctor(id) {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this doctor ?",
                type: "warning",
                showCancelButton:true,
                confirmButtonText: "Yes",
                cancelButtonText : "No",
                cancelButtonColor:"#d33",
                confirmButtonColor: "#dd4b39"
            }, function() {
                $.ajax({
                    url : "{{url('/doctor/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");

                        $(document).ready(function () {
                            getTableViewDoctor();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

        function viewDoctor(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/doctor/view/')}}"+"/"+id,
                dataType : 'html'
                ,success:function (data) {
                    $('#viewDoctor').html(data);
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

//        section

        function addSec() {
            $('#createSecClose').hide();
            $('#createSec').show();
            $('#sectionname').focus();
            $('#sectionname').css('border' ,'1px solid lightblue');
        }
        $('#sectionname').keyup(function() {
            var n = $('#sectionname').val();
            var name = n.trim();
            if(name==''){
                $('#createSecClose').hide();
                $('#createSec').show();
            }else{
                $('#createSec').hide();
                $('#createSecClose').show();
            }
        });
        function addSection(){
            var n = $('#sectionname').val();
            var name = n.trim();
            if(name!=''){
                $('#sectionname').css('border' ,'1px solid lightblue');
                $.ajax({
                    type: 'get',
                    url:"{{url('/section/create')}}"+"/"+name,
                    dataType: 'json',
                    success:function (data) {
                        $('#sectionname').val('');
                        getSelectSection();
                    },
                    error:function (error) {
                        console.log(error);
                    }

                });
            }else{

                $('#sectionname').css('border' ,'1px solid red');
                document.getElementById("sectionname").placeholder = "Type section name here..";
            }
        }

        function getSelectSection() {
            $.ajax({
                type: 'get',
                url: "{{url('/get/select/section')}}",
                dataType: 'json',
                success: function (response) {
                    if(Array.isArray(response)){
                        $(section_id).empty();
                        var serialnumber="<option value=''>---Please select one---</option>";
                        $(section_id).append(serialnumber);
                        response.map(function(item){
                            serialnumber="<option selected value=" + item.id + ">" + item.name + "</option>";
                            $(section_id).append(serialnumber);
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@stop