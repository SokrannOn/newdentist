@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
    {!!Form::open(['action'=>'RequestproController@store','method'=>'post'])!!}
    <div class="panel panel-default">
        <div class="panel-body">
            <div id="showProduct">
                <div class="center">
                    <i class="fa fa-spinner fa-spin fa-5x" style="font-size:24px"> </i> <span>&nbsp; Wait...</span>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
    </div>

@stop
@section('script')
    <script type="text/javascript">
        function add(id) {
            $.ajax({
                type: 'get',
                url: "{{url('/add/request/product')}}"+'/'+id,
                dataType: 'html',
                success: function (data) {
                    $(document).ready(function() {
                        showProduct();
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function showProduct() {
            $.ajax({
                type: 'get',
                url: "{{url('/get/show/product')}}",
                dataType: 'html',
                success: function (data) {
                    $('#showProduct').fadeIn('slow').html(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function() {
            showProduct();
        });
        function request(id) {
            $.ajax({
                type: 'get',
                url: "{{url('/get/product/request')}}"+'/'+id,
                dataType: 'html',
                success: function (data) {
                    $('#request').html(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }


        function remove(id) {
            if(id){
                $.ajax({
                    type: 'get',
                    url: "{{url('/remove/request/product')}}"+'/'+id,
                    success: function () {
                        $(document).ready(function() {
                            showProduct();
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }

        function discardRecord() {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to discard all items ?",
                type: "warning",
                showCancelButton:true,
//              closeOnConfirm: false,
                confirmButtonText: "Yes",
                cancelButtonText : "No",
                cancelButtonColor:"#d33",
                confirmButtonColor: "#d33"
            }, function() {
                $.ajax({
                    url : "{{url('/discard/request/product')}}",
                    type: "get",
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully discarded!", "success");

                        $(document).ready(function() {
                            showProduct();
                        });
                    })

            });
        }
        function qtyProduct(id) {
            var qtyId = "#"+id;
            var availableQtyId = "#available"+id;
            var errorId = "#error"+id;
            var qt =$(qtyId).val();
            var availableQty =$(availableQtyId).val();
            var qty = parseInt(qt);
            var available = parseInt(availableQty);
            if(qty >=0 && qty <= available){
                $(errorId).html("<span style='padding:5px;font-size: 10px;' class='text-info'>Stock Available "+available+" items</span>");
                $(qtyId).css('border','1px solid lightblue');
                $.ajax({
                    type: 'get',
                    url: "{{url('/update/qty/request/product')}}"+'/'+id+'/'+qty,
                    success: function () {
                        $(document).ready(function() {

                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }else{
                if(qty >available){
                    $(errorId).html("<span style='padding:5px;font-size: 10px;' class='text-danger'>Stock Not Available</span>");
                }
                $(qtyId).css('border','1px solid red');
            }
        }

    </script>
@stop
