<div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 5px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Invoice Detail : {{\Carbon\Carbon::parse($prescription->date)->format('d-M-Y')}}</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="text-align: center;">Product Code</th>
                        <th style="text-align: center;">Quantities</th>
                        <th style="text-align: center;">Unit Price</th>
                        <th style="text-align: center;">Amount</th>
                    </tr>
                    @foreach($prescription->products as $pro)
                        <tr>
                            <td style="text-align: center;">{{$pro->khName}}</td>
                            <td style="text-align: center;">{!! $pro->pivot->qty !!}</td>
                            <td style="text-align: center;">{!! $pro->pivot->price !!}</td>
                            <td style="text-align: center;">{!! $pro->pivot->amount !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h5><smal>Customer : {{$prescription->client->khname}}</smal></h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>