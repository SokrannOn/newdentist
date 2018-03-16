<table class="table table-hover" id="planCurrentView">
    <thead>
    <tr>
        <th>Client Name</th>
        <th>Treatment Name</th>
        <th class="center">Teeth Number</th>
        <th class="center">Quantities</th>
        <th class="center">Unit Price</th>
        <th class="center">Amount</th>
        <th class="center">Completed</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$plan->client->engname}}</td>
    </tr>
    @foreach( $plan->treatments as $p)
        <tr>
            <td colspan="2"></td>
            <td>{{$p->engname}}</td>
            <td class="center">{{$p->pivot->teeNo}}</td>
            <td class="center">{{$p->pivot->qty}}</td>
            <td class="center">{{"$ ".$p->pivot->price}}</td>
            <td class="center">{{"$ ".$p->pivot->amount}}</td>
            <td class="center">
                @if($p->pivot->completed == 1 )
                    <a class="cursor-pointer text-success"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                @else
                    <a class="cursor-pointer" style="color:red;" onclick='completed("{{$p->pivot->id}}")'><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pull-right">
    <a href="{{route('plan.index')}}" class="cursor-pointer btn btn-xs btn-danger">Close</a>
</div>