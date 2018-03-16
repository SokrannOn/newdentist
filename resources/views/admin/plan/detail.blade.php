@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <input type="hidden" value="{{$plan->id}}" id="plan_id">
        <div class="panel panel-default">
            <div class="panel-heading">
                Plan View
            </div>
            <div class="panel-body">
                <div id="contentDetail">
                    <table class="table table-hover" id="planCurrentView">
                        <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Doctor Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Treatment Name</th>
                            <th class="center">Teeth Number</th>
                            <th class="center">Quantities</th>
                            <th class="center">Unit Price</th>
                            <th class="center">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$plan->client->engname}}</td>
                            {{--@foreach($plan->client->appointments as $d)--}}
                            {{--<td>{{$d->name}}</td>--}}
                            {{--@endforeach--}}
                        </tr>
                        @foreach( $plan->treatments as $p)
                            <tr>
                                <td colspan="1"></td>
                                <td>{{\App\Appointment::find($p->pivot->appointment_id)->doctor()->value('name')}}</td>
                                <td>{{\Carbon\Carbon::parse(\App\Appointment::where('id',$p->pivot->appointment_id)->value('date'))->format('d-M-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse(\App\Appointment::where('id',$p->pivot->appointment_id)->value('time'))->format('g:i A')}}</td>
                                <td>{{$p->engname}}</td>
                                <td class="center">{{$p->pivot->teeNo}}</td>
                                <td class="center">{{$p->pivot->qty}}</td>
                                <td class="center">{{"$ ".$p->pivot->price}}</td>
                                <td class="center">{{"$ ".$p->pivot->amount}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <div class="pull-right">
                        <a href="{{route('plan.index')}}" class="cursor-pointer btn btn-xs btn-danger">Close</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function getContentViewDetail() {
            var id = $('#plan_id').val();
            $.ajax({
                type : 'get',
                url  : "{{url('/plan/detail/content')}}"+"/"+id,
                dataType:'html',
                success:function (data) {
                    $('#contentDetail').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        function completed(id) {
            $.ajax({
                type : 'get',
                url  : "{{url('/plan/detail/update/complete/')}}"+"/"+id,
                success:function (data) {
                    getContentViewDetail();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection