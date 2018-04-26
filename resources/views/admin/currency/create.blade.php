@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Currency
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'currency']) !!}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('English Name') !!}
                                {!! Form::text('engname',null,['class'=>'edit-form-control','placeholder'=>'Please enter english name','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Khmer Name') !!}
                                {!! Form::text('khname',null,['class'=>'edit-form-control','placeholder'=>'Please enter khmer name','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Start Date') !!}
                                {!! Form::date('startdate',null,['class'=>'edit-form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('End Date') !!}
                                {!! Form::date('enddate',null,['class'=>'edit-form-control','required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Rounding') !!}
                                {!! Form::number('rounding',null,['class'=>'edit-form-control','placeholder'=>'Rounding','required','step'=>'any']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Decimal Place') !!}
                                {!! Form::number('decimalplace',null,['class'=>'edit-form-control','placeholder'=>'Decimal place','required']) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Sell Rate') !!}
                                {!! Form::number('sellrate',null,['class'=>'edit-form-control','placeholder'=>'Sell Rate','step'=>'any','required']) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Buy Rate') !!}
                                {!! Form::number('buyrate',null,['class'=>'edit-form-control','placeholder'=>'Buy Rate','step'=>'any','required']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-3">

                            <div class="checkbox checkbox-primary">
                                <input id="lc" type="checkbox" name="lc">
                                <label for="lc">
                                    Locale Currency
                                </label>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('Locale Currency') !!}--}}
                                {{--{!! Form::text('lc',null,['class'=>'edit-form-control','placeholder'=>'Locale Currency','required']) !!}--}}
                            {{--</div>--}}
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox checkbox-primary">
                                <input id="default" type="checkbox" name="default">
                                    <label for="default">
                                        Default
                                    </label>
                            </div>
                        </div>
                    </div>
                <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {!! Form::submit('Create',['class'=>'btn btn-success btn-sm']) !!}
                                {!! Form::reset('Clear',['class'=>'btn btn-danger btn-sm']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer">
                <div id="currencyView">

                </div>
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div id="editCurrency"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getContent();
        });
        function getContent() {
            $.ajax({
                type : 'get',
                url : "{{route('currency.index')}}",
                dataType: 'html',
                success:function (data) {
                    $('#currencyView').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        };

        $('#currency').submit(function (e) {
            e.preventDefault();
            var data = $('#currency').serialize();
            $.ajax({
               type : 'post',
                url : "{{route('currency.store')}}",
                data :  data,
                dataType: 'html',
                success:function () {
                    getContent();
                    $('#currency')[0].reset();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });

        function deleteCurrency(id) {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this ?",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: false,
                confirmButtonText: "Yes",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    type : 'get',
                    url : "{{url('/currency/delete/')}}"+"/"+id,
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");
                        $(document).ready(function () {
                            getContent();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

        function editCurrency(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/currency/edit/')}}"+"/"+id,
                dataType: 'html',
                success:function (data) {
                    $('#editCurrency').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

    </script>
@endsection
