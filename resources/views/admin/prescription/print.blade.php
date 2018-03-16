{{--pre--}}
<table>
    <tr>
        <td>
            <h1 style="color: #0d6aad; font-family: 'Arial Black', arial-black" >PRESCRIPTIONS</h1>
            <h5 style="color: #2F3133; line-height: 1px;">CAMSOFTS COMPANY</h5>
            <address style="line-height: 20px">
                #S25, Street S, Toul Roka Village,<br>
                Chak Angre Krom, Phnom Penh
            </address>
        </td>
    </tr>
</table><br>
<table>
    <tr>
        <td>
            <h1 style="color: #0d6aad; font-family: 'Arial Black', arial-black; font-size: 14px;" >TREATMENT</h1>
            <address style="line-height: 20px">
                {{$pre->treatment->engname}}
            </address>
        </td>
    </tr>
</table>
<br>
<hr>
<br>
<table width="100%">
    <tr style="color:#0d6aad; font-family: Arial;text-align: left; ">
        <th>Medical Name</th>
        <th>Description</th>
        <th style="text-align: center; padding: 5px;">Quantities</th>
        <th style="text-align: center; padding: 5px;">Unit Price</th>
        <th style="text-align: center; padding: 5px;">Amount</th>
    </tr>
    @php($total =0)
    @foreach($pre->products as $p)
        <tr>
            <td style="padding: 5px;">{{$p->enName}}</td>
            <td style="padding: 5px;">{{$p->pivot->des}}</td>
            <td style="text-align: center; padding: 5px;">{{$p->pivot->qty}}</td>
            <td style="text-align: center; padding: 5px;">{{"$ ".$p->pivot->price}}</td>
            <td style="text-align: center; padding: 5px;">{{"$ ".$p->pivot->amount}}</td>
            @php($total+=$p->pivot->amount)
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td style="text-align: center; padding: 5px;">Total</td>
        <td style="text-align: center; padding: 5px;">{{"$ ".$total}}</td>
    </tr>
</table>
<br><br>
<div style="text-align: right;float: right;">
    <table>
        <tr>
            <td style="color: #0d6aad; padding: 10px;">Date</td>
            <td>{{" : ".\Carbon\Carbon::parse($pre->created_at)->format('d-M-Y')}}</td>
        </tr>
        <tr>
            <td style="color: #0d6aad; padding: 10px;">Doctor</td>
            <td>{{" : ".$pre->user->name}}</td>
        </tr>
        <tr>
            <td style="color: #0d6aad; padding: 10px;">Sign</td>
            <td>{{" : "}}__________________</td>
        </tr>
    </table>
</div>





