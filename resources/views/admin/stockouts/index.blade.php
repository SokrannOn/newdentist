@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <br>
        <div class="panel panel-default">
            {{--Create Users--}}
            <div class="panel-heading">
                Stock Out
            </div>
            <div class="panel panel-body">
                <div class="container-fluid table-responsive">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table">
                                @if($stockout->count())
                                    <table class="table table-bordered " style="border-radius: 5px;" id="import">
                                        <thead>
                                        <tr>
                                            <th class="font center">No</th>
                                            <th class="font center">Invoice Numbers</th>
                                            <th class="font center">Stock Out Date</th>
                                            <th class="font center">User</th>
                                            <th class="font center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;?>
                                        @foreach($stockout as $re)
                                            <tr>
                                                <td class="center">{{$i++}}</td>
                                                <td class="center">{{"CAM-IN-" . sprintf('%06d',$re->prescription_id)}}</td>
                                                <td class="center">{{Carbon\Carbon::parse($re->date)->format('d-M-Y')}}</td>
                                                <td class="center">{{$re->user->name}}</td>
                                                <td class="center">
                                                    <a href="#" onclick="Views({{$re->prescription_id}})" style="margin-right:10px;"><i class="fa fa-eye" data-toggle="modal" data-target="#myModal"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h4>No Record</h4>
                                @endif
                            </div>
                            <a href="{{url('admin/dashbords')}}" class="btn btn-danger btn-sm">Close</a>
                            <a href="{{url('stockout/create')}}" class="btn btn-info btn-sm">Create New</a>
                        </div>
                    {{--Modal view import detail--}}
                    <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div id="viewDetails">

                            </div>
                        </div>
                        {{--End model view import detail--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        function Views(id) {
            $.ajax({
               type: 'get',
                url: "{{url('/get/stockout/details')}}"+"/"+id,
                dataType: 'html',
                success:function (data) {
                    $("#viewDetails").html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function() {
            $('#import').DataTable({

            });
        });
    </script>
@stop
