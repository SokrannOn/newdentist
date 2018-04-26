<div class="table-responsive">

    <table class="table table-bordered table-striped">
        <tr>
            <th class="center" style="color: red">Date</th>
            <th class="center" style="color: red">Client Name</th>
            <th class="center" style="color: red">Treatment Name</th>
            <th class="center" style="color: red">Created By</th>
        </tr>
            <tr>
                <td class="center" style="color: blue">{{$pre->date}}</td>
                <td class="center" style="color: blue">{{$pre->client->khname}}</td>
                <td class="center" style="color: blue">{{$pre->treatment->khname}}</td>
                <td class="center" style="color: blue">{{$pre->user->name}}</td>
            </tr>
    </table>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>Product Name</th>
            <th class="center">Quantities</th>
            <th>Description</th>
        </tr>
        @foreach($pre->products as $product)
            <tr>
                <td>{{$product->khName}}</td>
                <td class="center">{{$product->pivot->qty}}</td>
                <td>{{str_limit($product->pivot->des,50)}}</td>
            </tr>
        @endforeach
    </table>
</div>