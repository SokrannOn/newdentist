
@if(count($payment))
    <div class="row">
        @foreach($payment as $doc)
            <div class="col-lg-3">
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{$doc->doctor->name}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{strtolower($doc->doctor->gender) =='m' ? 'Male' : 'Female'}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{$doc->doctor->contact}}</td>
                        </tr>
                        <tr>
                            <td>Base Salary</td>
                            <td>{{"$ ".$doc->doctor->baseSalary}}</td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>{{$doc->currency->engname}}</td>
                        </tr>
                        <tr>
                            <td>Exchange Rate</td>
                            <td>{{"$ ".$doc->exchangeRate}}</td>
                        </tr>
                        <tr>
                            <td>Commission</td>
                            <td>{{$doc->doctor->commission ? $doc->doctor->commission."%" : '0%'}}</td>
                        </tr>
                        <tr>
                            <td>Paid Amount</td>
                            <td>{{"$ ".$doc->paidAmount}}</td>
                        </tr>
                        <tr>
                            <td>Posted Amount</td>
                            <td>{{\App\Rounding::roundUp($doc->paidAmount*$doc->exchangeRate,'l')." ៛"}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h6>No Record...</h6>
@endif