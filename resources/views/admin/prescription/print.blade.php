{{--pre--}}
<table>
    <tr>
        <td>
            <p style="color: #0b58a2; font-family: 'Khmer Mool',Serif; font-size: 16px;" >មន្ទីរពេទ្យ........</p>
        </td>
    </tr>
</table><br>
<table width="100%">
    <tr>
        <td style="text-align: center ">
            <h1 style="color: #0b58a2; font-family: 'Khmer Mool',Serif; font-size: 16px;" ><u>វេជ្ជបញ្ជា</u></h1>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <p >
                 {{ "ឈ្មោះ \t" }}
            </p>
        </td>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <p >
                {{$pre->client->khname}}
            </p>
        </td>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <p >
                {{'អាយុ '}}
            </p>
        </td>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px; text-align: left" >
            <p >
                {{$pre->client->age.' ឆ្នាំ'}}
            </p>
        </td>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <p >
                {{'ភេទ  '}}
            </p>
        </td>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <p >
                {{$pre->client->gender==1 ? 'ប្រុស': 'ស្រី'}}
            </p>
        </td>
    </tr>
</table>
<table style="margin-top: 10px;">
    <tr>
        <td style="color: #0b58a2; font-family: 'Khmer OS Content',Serif; font-size: 12px;" >
            <h5 >
                {{'រោគវិនិច្ឆ័យ : '.$pre->treatment->khname}}
            </h5>
        </td>
    </tr>
</table>
<br>
<hr>
<br>
<table width="100%">
    <tr style="color:#0d6aad; font-family: 'Khmer OS Content';​text-align: left; font-size: 12px; ">
        <td>ឈ្មោះថ្នាំ</td>
        <td>សេចក្តីណែនាំ</td>
        <td style="text-align: center; padding: 5px;">បរិមាណ</td>
        {{--<th style="text-align: center; padding: 5px;">Unit Price</th>--}}
        {{--<th style="text-align: center; padding: 5px;">Amount</th>--}}
    </tr>
    @php($total =0)
    @foreach($pre->products as $p)
        <tr>
            <td style="padding: 5px;">{{$p->enName}}</td>
            <td style="padding: 5px;">{{$p->pivot->des}}</td>
            <td style="text-align: center; padding: 5px;">{{$p->pivot->qty}}</td>
            {{--<td style="text-align: center; padding: 5px;">{{"$ ".$p->pivot->price}}</td>--}}
            {{--<td style="text-align: center; padding: 5px;">{{"$ ".$p->pivot->amount}}</td>--}}
            {{--@php($total+=$p->pivot->amount)--}}
        </tr>
    @endforeach
    {{--<tr>--}}
        {{--<td colspan="3"></td>--}}
        {{--<td style="text-align: center; padding: 5px;">Total</td>--}}
        {{--<td style="text-align: center; padding: 5px;">{{"$ ".$total}}</td>--}}
    {{--</tr>--}}
</table>
<br><br>
<div style="text-align: right;float: right;">
    <table>
        <tr>
            <td style="color:#0d6aad; font-family: 'Khmer OS Content';">កាលបរិច្ឆេទ </td>
            <td>{{" : ".\Carbon\Carbon::parse($pre->created_at)->format('d-M-Y')}}</td>
        </tr>
        <tr>
            <td style="color:#0d6aad; font-family: 'Khmer OS Content';">វេជ្ជបណ្ឌិត</td>
            <td>{{" : ".$pre->user->name}}</td>
        </tr>
        <tr>
            <td style="color:#0d6aad; font-family: 'Khmer OS Content';">ហត្ថលេខា</td>
            <td>{{" : "}}__________________</td>
        </tr>
        <tr>
            <td style="color: #0d6aad; padding: 10px; float: left"></td>
        </tr>
    </table>
</div>





