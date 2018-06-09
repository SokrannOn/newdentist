@extends('admin.master')
@section('content')
@if(!count($setvariables))
<div class="container-fluid"><br>
  <div id="form">
    <div class="panel panel-default">
    <div class="panel-heading">
      SET VALUE FORM GANERATE INVOICES
    </div>
      <div class="panel panel-body">
        <div class="container-fluid table-responsive">
          <div class="row">
            <div class="col-lg-12">
              {!!Form::open(['action'=>'SetvariableController@save','method'=>'POST'])!!}
                {{csrf_field()}}

                          <div class="row">
                            <div class="col-lg-4">
                            <div class="form-group {{ $errors->has('ar') ? ' has-error' : '' }}">
                                {!!Form::label('ar','Account Recieveable',[])!!}
                                {!!Form::select('ar',$chartaccounts,null,['class'=>'form-control','required'=>'true','placeholder'=>'--Select one--'])!!}
                              @if ($errors->has('ar'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ar') }}</strong>
                                  </span>
                              @endif
                            </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group {{ $errors->has('saleIncome') ? ' has-error' : '' }}">
                                {!!Form::label('saleIncome','Sale Income ',[])!!}
                                {!!Form::select('saleIncome',$chartaccounts,null,['class'=>'form-control','required'=>'true','placeholder'=>'--Select one--'])!!}
                              @if ($errors->has('saleIncome'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('saleIncome') }}</strong>
                                  </span>
                              @endif
                            </div>
                            </div>
                            <div class="col-lg-4">
                            <div class="form-group {{ $errors->has('cogs') ? ' has-error' : '' }}">
                                {!!Form::label('cogs','Cost of Goods Sold',[])!!}
                                {!!Form::select('cogs',$chartaccounts,null,['class'=>'form-control','required'=>'true','placeholder'=>'--Select one--'])!!}
                              @if ($errors->has('cogs'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('cogs') }}</strong>
                                  </span>
                              @endif
                            </div>
                            </div>
                          </div>

                           <div class="row">
                            <div class="col-lg-6">
                             <div class="form-group {{ $errors->has('inventory') ? ' has-error' : '' }}">
                                {!!Form::label('inventory','Inventory ',[])!!}
                                {!!Form::select('inventory',$chartaccounts,null,['class'=>'form-control','required'=>'true','placeholder'=>'--Select one--'])!!}
                              @if ($errors->has('inventory'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('inventory') }}</strong>
                                  </span>
                              @endif
                            </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group {{ $errors->has('vatoutput') ? ' has-error' : '' }}">
                                {!!Form::label('vatoutput','VAT Output ',[])!!}
                                {!!Form::select('vatoutput',$chartaccounts,null,['class'=>'form-control','required'=>'true','placeholder'=>'--Select one--'])!!}
                              @if ($errors->has('vatoutput'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('vatoutput') }}</strong>
                                  </span>
                              @endif
                            </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                              <button type="submit" class="btn btn-sm btn-success submit"> Save </button>
                            </div>
                            </div>
                          </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>
@else
          <div class="container-fluid" id="table"><br>
            <div class="panel panel-default">
            <div class="panel-heading">
              VALUES FORM GENERATE INVOICE
            </div>
            <div class="panel-body">
              <div class="container-fluid table-responsive">
                <div class="row space">
                  <div class="col-lg-12">
                    <table with="100%" id="example" class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                              <th style="text-align: center;">No</th>
                              <th style="text-align: center;">Chart of Account Name</th>
                              <th style="text-align: center;">Dr Sign</th>
                              <th style="text-align: center;">Cr Sign</th>
                          </tr>
                      </thead>
                      <?php $no=1;?>
                      <tbody>
                        @foreach($setvariables as $set)
                          @foreach($set as $s)
                          <tr>
                              <td style="text-align: center;">{{$no++}}</td>
                              <td style="font-size: 12px; font-family: 'Khmer OS System';">
                                  {!!\App\Chartaccount::where('id',$s['id'])->value('description') !!}
                              </td>
                              <td style="font-size: 12px; text-align: center; font-family: 'Khmer OS System';">{{$s['Dr']."00,000"}}</td>
                              <td style="font-size: 12px; text-align: center; font-family: 'Khmer OS System';">
                                {{$s['Cr']."00,000"}}
                              </td>
                          </tr>
                          @endforeach
                        @endforeach
                            <script type="text/javascript">
                                RemoveSpace();
                                function RemoveSpace(){
                                    var el = document.querySelector('.space');
                                    var doc = el.innerHTML;
                                    //alert('Message : ' + doc);
                                    el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
                              }
                            </script>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                       <a href="{{url('/admin/reset/variable')}}" class="btn btn-danger btn-sm">Reset</a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endif
@stop