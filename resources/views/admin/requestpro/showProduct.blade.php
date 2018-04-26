@if($tmpdata->count())
    <div class="panel panel-default table-responsive">
        <table class="table table-bordered table-hover table-striped" cellspacing="0">
            <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Product Name</th>
                <th style="text-align: center;">Quantities</th>
                <th style="text-align: center;">Actions</th>
            </tr>
            </thead>
            <?php $no=1;?>
            <tbody>
            @foreach($tmpdata as $tmppo)
                <tr>
                    <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">{{$no++}}</td>
                    <td style="font-size: 11px; font-family: 'Khmer OS System';">
                        {{$tmppo->product->enName}}
                    </td>
                    <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                        {{$tmppo->qty}}
                    </td>
                    <td width="150px" style="text-align: center;">
                        <a style="padding: 2px" class="cursor-pointer " type="button" title="Remove Product" onclick="remove({{$tmppo->id}})"><i style="color: red;" class="fa fa-trash"></i></a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    {!! Form::submit('Save',['class'=>'btn btn-success btn-sm']) !!}
    <a class="cursor-pointer btn btn-danger btn-sm" type="button" title="Discard" onclick="discard()">Discard</a>
@else
    <h4 class="center text-danger">No found record!</h4>
@endif