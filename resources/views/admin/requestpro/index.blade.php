 @extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create Product
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">Request Number</th>
                            <th class="center">Request Date</th>
                            <th class="center">Request By</th>
                            <th>Status</th>
                            <th class="center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request as $r)
                            <tr>
                                <td style="font-size: 13px; font-family: 'Khmer OS System'; text-align: center;">
                                    <?php
                                    echo "CAM-REQ-" . sprintf('%06d',$r->id);
                                    ?>
                                </td>
                                <td style="font-size: 13px; font-family: 'Khmer OS System'; text-align: center;">
                                    {{Carbon\Carbon::parse($r->date)->format('d-M-Y')}}
                                </td>
                                <td style="font-size: 13px; font-family: 'Khmer OS System'; text-align: center;">
                                    {!! \App\User::where('id',$r->request_by)->value('name')!!}
                                </td>
                                <td style="font-size: 13px; font-family: 'Khmer OS System';">
                                    {{$r->description}}
                                </td>
                                <td style="text-align: center;">
                                    <a href="#" title="Show Detail" onclick="showDetail({{$r->id}})" data-toggle="modal" data-target="#myModal"><i class="fa fa-indent"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="myModal" role="dialog">

            </div>
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript">

$(document).ready(function() {
         $('#example').DataTable({
           "aaSorting": [[ 0, "desc" ]]
        });
    });
    function showDetail(id) {
        $.ajax({
            type:'get',
            url: "{{url('/show/details/request/product')}}"+"/"+id,
            dataType:'html',
            success:function (data) {
                $("#myModal").html(data);
            },
            error:function (error) {
                console.log(error);
            }
        });
    }
</script>
@stop
