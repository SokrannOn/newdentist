@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Invoice
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <table>
                        <tr>
                            <td>
                                <h1 style="color: #0d6aad; font-family: 'Arial Black', arial-black" >INVOICE</h1>
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
                            <td style="vertical-align: text-top; padding: 10px;">
                                <div style="line-height: 10px">
                                    <p style=": 10px; color: #0d6aad; font-family:'Times New Roman', serif">CLIENT</p>
                                    <addrees style=" line-height:20px; font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif">
                                        <div>
                                            <table>
                                                <tr>
                                                    <td>Client Name</td><td>{{" : ".$inv->plan->client->engname}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td><td>{{$inv->plan->client->gender == 1 ? " : Male" : " : Female"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Age</td><td>{{" : ".$inv->plan->client->age." years old"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Cell Phone</td><td>{{" : ".$inv->plan->client->tel}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td><td>{{" : ".$inv->plan->client->email}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </addrees>
                                </div>

                            </td>

                            <td style="vertical-align: text-top; padding: 0 20px 0 20px">
                                <div style="line-height: 10px">
                                    <p style="color: #0d6aad; font-family:'Times New Roman', serif">INVOICE STATUS</p>
                                    <addrees style=" line-height:20px; font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif">
                                        <div>
                                            <table>
                                                <tr>
                                                    <td>Invoice Number</td><td>{{" : ".sprintf('%06d',$inv->id)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date </td><td>{{": ".\Carbon\Carbon::parse($inv->date)->format('d-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Plan </td><td>{{" : ".sprintf('%09d',$inv->plan_id)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Print By</td><td>{{" : ".\App\User::find($inv->user_id)->value('name')}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </addrees>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div style="border-top: 1px solid #0b58a2;"></div>
                    <br>
                    <table width="100%">
                        <tr>
                            <td style="color: #0b58a2; padding: 7px;">Description</td>
                            <td style="color: #0b58a2; padding: 7px; text-align: center;">Teeth Number</td>
                            <td style="color: #0b58a2; padding: 7px; text-align: center;">Quantities</td>
                            <td style="color: #0b58a2; padding: 7px; text-align: center;">Unit Price</td>
                            <td style="color: #0b58a2; padding: 7px; text-align: center;">Discount</td>
                            <td style="color: #0b58a2; padding: 7px;">Amount</td>
                        </tr>
                        @php($total=0)
                        @foreach($inv->plan->treatments as $t)
                            <tr>
                                <td style="padding: 7px;">{{$t->engname}}</td>
                                <td style="padding: 7px; text-align: center;">{{$t->pivot->teeNo}}</td>
                                <td style="padding: 7px; text-align: center;">{{$t->pivot->qty}}</td>
                                <td style="padding: 7px; text-align: center;">{{"$ ".$t->pivot->price}}</td>
                                <td style="padding: 7px; text-align: center;">{{$t->dis ? $t->dis : '0' }}</td>
                                <td style="padding: 7px;">{{$t->pivot->amount ? "$ ".$t->pivot->amount : '0' }}</td>
                                @php($total+=$t->pivot->amount)
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td style="padding: 7px;">Grand Total</td>
                            <td style="padding: 7px;">{{"$ ".$total}}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td style="padding: 7px;">TAX</td>
                            <td style="padding: 7px;">{{"$ "}}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td style="padding: 7px;">Total</td>
                            <td style="padding: 7px;">{{"$ ".$total}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a onclick="history.back()" class="btn btn-danger btn-sm pull-right">Back</a>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection