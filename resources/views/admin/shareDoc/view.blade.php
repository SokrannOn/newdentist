@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Share
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    @if(count($shareDoc))
                        <table class="table table-hover table-responsive" id="shareDoc">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Branch</th>
                                <th>Plan</th>
                                <th>Treatment</th>
                                <th>Doctor Name</th>
                                <th>Amount</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($shareDoc as $s)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{\Carbon\Carbon::parse($s->date)->format('d-M-Y')}}</td>
                                    <td>{{$s->branch->name}}</td>
                                    <td>{{sprintf('%09d',$s->plan->id)}}</td>
                                    <td>{{$s->treatment->engname}}</td>
                                    <td>{{$s->doctor->name}}</td>
                                    <td>{{"$ ".number_format($s->amount,3)}}</td>
                                    <td>{{"$ ".number_format($s->balance,3)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5 class="center">No Record view</h5>
                    @endif
                </div>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#shareDoc').dataTable();
        })
    </script>
@endsection