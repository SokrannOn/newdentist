@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Invoice Views
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="invoiceView">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice Number</th>
                                <th>Date</th>
                                <th>Plan Number</th>
                                <th>Paid</th>
                                <th>Credit</th>
                                <th class="center">Discount</th>
                                <th class="center">Total</th>
                                <th class="center">Paid</th>
                                <th class="center">Printed</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($inv as $in)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{sprintf('%09d',$in->id)}}</td>
                                <td>{{\Carbon\Carbon::parse($in->date)->format('d-M-Y')}}</td>
                                <td>{{sprintf('%09d',$in->plan_id)}}</td>
                                <td>{{"$ ".$in->paid}}</td>
                                <td>{{"$ ".round($in->credit,2)}}</td>
                                <td class="center">{{ $in->dis." %" }}</td>
                                <td class="center">{{ "$ ".round($in->totalAmount,2)  }}</td>
                                <td class="center">{{$in->isPayment ? "Yes" : "No"}}</td>
                                <td class="center">{{$in->print ? "Yes" : "No"}}</td>
                                <td class="center">
                                    <a class="cursor-pointer" href="{{route('invoice.show',$in->id)}}"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#invoiceView').DataTable();
        });
    </script>
@endsection