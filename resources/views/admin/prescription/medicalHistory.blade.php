
<div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 5px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Medical History</h4>
        </div>
        <div class="modal-body">
            @foreach($client as $c)
                <small class="text-danger">Treatment : {{$c->treatment->engname}}</small><br>
                <small class="text-danger">{{"Date : ".\Carbon\Carbon::parse($c->created_at)->format('d-M-Y')}}</small>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Medical Name</th>
                            <th>Description</th>
                            <th class="center">Quantities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($c->products as $p)
                            <tr>
                                <td>{{$p->enName}}</td>
                                <td>{{$p->pivot->des}}</td>
                                <td class="center">{{$p->pivot->qty}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>