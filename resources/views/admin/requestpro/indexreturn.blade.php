@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
               View Product Return
            </div>
            <div class="panel-body table-responsive">
                <div style="padding: 0 1.5% 0 0 ">
                    @if($returnreqpro->count())
                            <table width="980px" class="table table-bordered" id="viewProductReturn">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Request Return</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Return Date</th>
                                        <th style="text-align: center;">Return By</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <?php $i=1; ?>
                                <tbody>
                                @foreach($returnreqpro as $re)
                                    <tr>
                                        <td style="text-align: center;">{!! $i++ !!}</td>
                                        <td style="text-align: center;">{!!"CAM-REQ-".sprintf("%06d",$re->stockoutre->requestpro_id)!!}</td>
                                        <td style="text-align: center;">{!! strtolower($re->status)=="s" ? "Some products" : "Return All" !!}</td>
                                        <td style="text-align: center;">{!! \Carbon\Carbon::parse($re->created_at)->format('d-M-Y') !!}</td>
                                        <td style="text-align: center;">{{App\User::where('id',$re->returnBy)->value('nameDisplay')}}</td>
                                        <td style="text-align: center;">
                                            <a href="#" title="View Product Return" onclick="ViewProductReturn('{{$re->id}}','{{$re->status}}','{{$re->stockoutre_id}}')" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                        <h4>No Found results</h4>
                    @endif
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                    </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
        <script type="text/javascript">
            function ViewProductReturn(reId,status,stockoutId) {
                $.ajax({
                    type: 'get',
                    url: "{{url('/viewproductreturn')}}"+"/"+reId+"/"+status+"/"+stockoutId,
                    dataType: 'html',
                    success:function (data) {
                        $("#myModal").html(data);
                    },
                    error:function (error) {

                        console.log(error);
                    }
                });
            }


            $(document).ready(function () {
                $("#viewProductReturn").DataTable({});
            });
        </script>
@endsection