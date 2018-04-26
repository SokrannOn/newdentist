    <div>
        <h4>Doctor Information</h4>
    </div>
    <div>
        <table class="table table-list-view">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{$doc->name}}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{strtolower($doc->gender) =='m' ? 'Male' : 'Female'}}</td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>{{$doc->contact}}</td>
                </tr>
                <tr>
                    <td>Base Salary</td>
                    <td>{{"$ ".$doc->baseSalary}}</td>
                </tr>
                <tr>
                    <td>Commission</td>
                    <td>{{$doc->commission ? $doc->commission."%" : '0%'}}</td>
                </tr>
                <tr>
                    <td>Commission earn</td>
                    <td>{{"$ ".\App\Rounding::roundUp($share,'d')}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{"$ ".(\App\Rounding::roundUp($share,'d')+$doc->baseSalary)}}</td>
                </tr>
                <tr>
                    <td>Posted Amount (Riel)</td>
                    <td>{{number_format(\App\Rounding::postedAmount((\App\Rounding::roundUp($share,'d')+$doc->baseSalary),'l'),2)}}</td>
                </tr>
            </tbody>
        </table>
    </div>