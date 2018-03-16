<div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 5px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Import Details Date : {{\Carbon\Carbon::parse($importId->impDate)->format('d-M-Y')}}</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <th class="center">Quantities</th>
                        <th class="center">Manufactured Date</th>
                        <th class="center">Expired Date</th>
                    </tr>
                    @foreach($importId->histories as $id)
                    <tr>
                        <td>{{$id->product->khName}}</td>
                        <td class="center">{{$id->qty}}</td>
                        <td class="center">{{\Carbon\Carbon::parse($id->mfd)->format('d-M-Y')}}</td>
                        <td class="center">{{\Carbon\Carbon::parse($id->expd)->format('d-M-Y')}}</td>
                    </tr>
                   @endforeach
                </table>
            </div>
            <h5><smal>Total Quantities : {{$importId->histories->sum('qty')}}</smal></h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>