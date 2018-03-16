@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Treatment Procedure
            </div>
            <div class="panel-body">
                @if(count($treat))
                    <div class="table-responsive">
                        <table class="table table-hover" id="treatmentProcedure">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Branch</th>
                                    <th>Doctor</th>
                                    <th>Plan</th>
                                    <th>Treatment</th>
                                    <th class="center">Completed</th>
                                    <th>Completed Date</th>
                                    <th>Client</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>hours</th>
                                </tr>
                            </thead>
                            <tbody>

                            @php($i=1)
                            @foreach($treat as $t)

                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$t->branch->name}}</td>
                                    <td>{{$t->doctor->name}}</td>
                                    <td>{{sprintf('%09d',$t->plan_id)}}</td>
                                    <td>{{$t->treatment->engname}}</td>
                                    <td class="center">{{$t->completed ? 'YES' : 'NO'}}</td>
                                    <td>{{$t->completeddate? \Carbon\Carbon::parse($t->completeddate)->format('d-M-Y'):'N/A'}}</td>
                                    <td>{{$t->appointment_id ? $t->appointment->client->engname : 'N/A'}}</td>
                                    <td>{{$t->appointment_id ? $t->appointment->doctor->name: 'N/A'}}</td>
                                    <td>{{$t->appointment_id ? \Carbon\Carbon::parse($t->appointment->date)->format('d-M-Y'):'N/A'}}</td>
                                    <td>{{$t->appointment_id ? \Carbon\Carbon::parse($t->appointment->time)->format('g:i A'): 'N/A'}}</td>
                                </tr>
                            @endforeach
                            {{--{{dd($treat)}}--}}
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="center">
                        <h4>No record view</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
           $('#treatmentProcedure').dataTable();
        });
    </script>
@endsection

