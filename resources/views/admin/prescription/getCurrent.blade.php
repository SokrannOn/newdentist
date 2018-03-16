<table class="table table-hover">
    <thead>
        <tr>
            <th>Medical Name</th>
            <th class="center">Quantities</th>
            <th>Description</th>
            <th class="center">Unit Price</th>
            <th class="center">Amount</th>
            <th class="center">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pres->products as $pre)
        <tr>
            <td>{{$pre->enName}}</td>
            <td class="center">{{$pre->pivot->qty}}</td>
            <td>{{$pre->pivot->des}}</td>
            <td class="center">{{$pre->pivot->price}}</td>
            <td class="center">{{$pre->pivot->amount}}</td>
            <td class="center">
                <a class="cursor-pointer padding-10 text-danger" onclick='deletePrescript("{{$pre->pivot->id}}")'><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a class="cursor-pointer padding-10" title="Print" onclick='printPre()'><i class="fa fa-print fa-2x"></i></a>

