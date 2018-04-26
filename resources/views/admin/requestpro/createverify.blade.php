@extends('admin.master')
@section('content')

<br>
    <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-footer">
            <div class="panel-heading"><i class="fa fa-check-circle" aria-hidden="true"></i> Verify Request Product</div>
              <div class="panel panel-body">
        {!!Form::open(['action'=>'RequestproController@confirm','method'=>'POST'])!!}
          {{csrf_field()}}
              <div class="row">
                <div class="col-lg-12">
                   <div class="form-group">
                        <select class="edit-form-control" name="id" id="poid" onchange="getRequestProduct()">
                        <option value="0">Please Select Request Number</option>
                          @foreach($request as $r)
                            <option value="{{$r->id}}">{!! "CAM-REQ-" . sprintf('%06d',$r->id) !!}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div id="viewRequested">
                  <!-- table -->
              </div>
              <div hidden class="verify">
                <button hidden type="submit" class="btn btn-primary btn-sm"> Confirm </button>
                <a href="{{url('/')}}" class="btn btn-danger btn-sm">Close</a>
              </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
  <script type="text/javascript">
function getRequestProduct(){
        var id=$('#poid').val();
        $('.verify').fadeIn('slow');
        $('#viewRequested').fadeIn('slow');
        if(id!=0){
              $.ajax({
              type:'get',
              url:"{{url('/get/view/requested/product')}}"+"/"+id,
              dataType:'html',
              success:function(data){
                  $("#viewRequested").html(data);
              },
              error:function(e){

              }
          });
        }else{
          $('.verify').fadeOut('slow');
          $('#viewRequested').fadeOut('slow');
        }
    }
//----------------------------------
  </script>
@stop
