<table class="table table-hover">
    <thead>
        <tr>
            <th>Client</th>
            <th>Treatment</th>
            <th class="center">Number Teeth</th>
            <th class="center">Quantities</th>
            <th class="center">Unit Price</th>
            <th class="center">Discount</th>
            <th class="center">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$plan->client->engname}}</td>
        </tr>
        @php($total =0)
        @foreach($plan->treatments as $p)
            <tr>
                <td></td>
                <td>{{$p->engname}}</td>
                <td class="center">{{$p->pivot->teeNo}}</td>
                <td class="center">{{$p->pivot->qty}}</td>
                <td class="center">{{"$ ". $p->pivot->price}}</td>
                <td class="center">{{$p->dis ? $p->dis : 'N/A'}}</td>
                <td class="center">{{"$ ".$p->pivot->amount}}</td>
                @php($total+=$p->pivot->amount)
            </tr>
        @endforeach
        <tr>
            <td colspan="6">Total</td>
            <td class="center">{{ "$ ".$total}}</td>
        </tr>
    </tbody>
</table>