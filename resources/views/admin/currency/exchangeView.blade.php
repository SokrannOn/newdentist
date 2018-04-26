@if(count($e))
    <table id="exchangefff" class="table table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Currency</th>
            <th>Sell Rate</th>
            <th>Buy Rate</th>
            <th>Mid-Rate</th>
        </tr>
        </thead>
        <tbody>
        @php($i=1)
        @foreach($e as $ex)
            <tr>
                <td>{{$i++}}</td>
                <td>{{\Carbon\Carbon::parse($ex->date)->format('d-M-Y')}}</td>
                <td>{{$ex->currency->engname}}</td>
                <td>{{$ex->sellrate}}</td>
                <td>{{$ex->buyrate}}</td>
                <td>{{$ex->midrate}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h6 class="center">No content available</h6>
@endif