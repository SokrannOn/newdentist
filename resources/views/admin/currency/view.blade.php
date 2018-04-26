<table class="table table-hover" id="currencyView">
    <thead>
        <tr>
            <th>No</th>
            <th>Khmer Name</th>
            <th>English Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th class="center">Rounding</th>
            <th class="center">Decimal Place</th>
            <th>Locale Currency</th>
            <th class="center">Sell Rate</th>
            <th class="center">Buy Rate</th>
            <th>Default</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php($i=1)
        @foreach($currency as $c)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$c->khname}}</td>
                <td>{{$c->engname}}</td>
                <td>{{\Carbon\Carbon::parse($c->startdate)->format('d-M-Y')}}</td>
                <td>{{\Carbon\Carbon::parse($c->enddate)->format('d-M-Y')}}</td>
                <td class="center">{{number_format($c->rounding,2)}}</td>
                <td class="center">{{$c->decimalplace}}</td>
                <td>{{$c->localecurrency}}</td>
                <td class="center">{{$c->sellrate}}</td>
                <td class="center">{{$c->buyrate}}</td>
                <td>{{$c->default ? 'Default' : 'N/A'}}</td>
                <td>
                    <a href="#" onclick="editCurrency('{{$c->id}}')" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-edit icon-edit"></i></a></a>
                    <a href="#" onclick="deleteCurrency('{{$c->id}}')"><i class="fa fa-trash icon-delete"></i></a>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>