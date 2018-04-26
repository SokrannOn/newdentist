
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <head>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Product Name</th>
                <th style="text-align: center;">Quantities</th>
            </tr>
        </head>
        <tbody>
        <?php $n=1; ?>
        @foreach($requestPro->products as $p)
            <tr>
                <td style="font-family: 'Times New Roman';text-align: center; font-size: 12px;">{{$n++}}</td>
                <td style="font-family: 'Khmer OS System'; font-size: 12px;">{!! $p->khName !!}</td>
                <td style="text-align: center; font-size: 12px;">{!! $p->pivot->qty !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! Form::submit('Export',['class'=>'btn btn-primary btn-sm']) !!}