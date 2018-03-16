@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Plan Views
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="planview">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Plan Date</th>
                                <th>Client Name</th>
                                <th>Branch</th>
                                <th>Effective Date</th>
                                <th>Expired Date</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($plan as $p)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{\Carbon\Carbon::parse($p->date)->format('d-M-Y')}}</td>
                                <td>{{$p->client->engname}}</td>
                                <td>{{$p->branch->name}}</td>
                                <td>{{\Carbon\Carbon::parse($p->effectiveDate)->format('d-M-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($p->expiredDate)->format('d-M-Y')}}</td>
                                <td class="center">
                                    <a href='{{url("/plan/detail/view/$p->id")}}' class="padding-10"><i class="fa fa-eye"></i></a>
                                    {{--<a href="" class="padding-10"><i class="fa fa-edit"></i></a>--}}
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

        function viewDetail(id) {
            $.ajax({
                type : 'get',
                url  : "{{url('/plan/detail/view/')}}"+"/"+id,
                dataType : 'html',
                success:function (data) {
                    $('#plandetail').html(data);
                }
            });
        }
        $(document).ready(function () {
           $('#planview').DataTable();
        });
    </script>
@endsection