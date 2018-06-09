@extends('admin.master')
@section('content')
    <div class="container-fluid"><br>
        <div class="panel panel-default">
            <div class="panel-heading">
                PAYMENTS FORM
            </div>
            <div class="panel panel-body">
                <div class="container-fluid table-responsive">
                    {!! Form::open(['method'=>'post', 'action'=>'ClientpaymentController@submit'])!!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-gruop">
                                {!! Form::label('paymentDate','Payment Date',[]) !!}
                                {!! Form::date('paymentDate',null,['class'=>'edit-form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('invN') ? ' has-error' : '' }}">
                                {!!Form::label('invN','Invoice Number : ',[])!!}
                                <select required name="invN" id="invN" class="edit-form-control height-35px" onchange="InvoiceView()">
                                    <option value="">Please select</option>
                                    @foreach( $invoice as $invN)
                                        <option value="{{$invN->id}}">{!! "CAM-IN-" . sprintf('%06d',$invN->id) !!}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('invN'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invN') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div hidden id="textbox">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('cradit') ? ' has-error' : '' }}">
                                    {!!Form::label('cradit','Credit : ',[])!!}
                                    <div class="input-group">
                                        {!!Form::text('cradit',null,['class'=>'form-control cradit','readonly'=>'readonly'])!!}
                                        <span class="input-group-btn">
                                            <a href="#" class="btn btn-warning" onclick="paidAll()"><i class="fa fa-caret-right" aria-hidden="true"></i> </a>
                                        </span>
                                    </div>
                                    @if ($errors->has('cradit'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cradit') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('paid') ? ' has-error' : '' }}">
                                    {!!Form::label('paid',' Paid  ',[])!!}
                                    <input type="text" class="form-control paids" required name="paid" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    @if ($errors->has('paid'))
                                        <span class="help-block">
                      <strong>{{ $errors->first('paid') }}</strong>

                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-sm btn-success submit"> Submit </button>
                            <a href="{{url('/')}}" class="btn btn-sm btn-danger"> Close </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.example').DataTable({
                responsive: true
            });
        });
        function InvoiceView() {
            $('.paids').val('');
            $('#currency').val(0);
            $('.exchangerate').val('');
            $('.postAmount').val('');
            var InvId = $('#invN').val();
            if(InvId!=''){
                $("#textbox").fadeIn('slow');
                $.ajax({
                    type:'get',
                    url:"{{url('/entry/payment')}}"+"/"+InvId,
                    dataType: 'json',
                    success:function (response) {
                        $('.cradit').val(response);

                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else{
                $('.cradit').val('');
                $('.paids').val('');
                $("#textbox").fadeOut('slow');
                $('.currency').fadeOut('slow');
            }
        }

        function paidAll() {
            var payall = $('.cradit').val();
            $('.paids').val(payall);
            $(".currency").fadeIn('slow');
        }

        $( ".paids" ).keyup(function() {
            var paid = $(this).val();
            var cradit = $('.cradit').val();
            paids = parseFloat(paid);
            var cradits = parseFloat(cradit);
            if(paids>cradits || paids<0 ||paids==NaN)
            {
                $('.paids').css('border','1px solid red');
                $('.submit').attr('disabled','true');
            }else{
                $('.paids').css('border','1px solid lightblue');
                $('.submit').removeAttr('disabled','true');
            }
        });
    </script>
@stop