<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 5px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Edit</h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                {!! Form::model($c,['action'=>['currencyController@update',$c->id],'method'=>'patch']) !!}
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('English Name') !!}
                            {!! Form::text('engname',null,['class'=>'edit-form-control','placeholder'=>'Please enter english name','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Khmer Name') !!}
                            {!! Form::text('khname',null,['class'=>'edit-form-control','placeholder'=>'Please enter khmer name','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Start Date') !!}
                            {!! Form::date('startdate',null,['class'=>'edit-form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('End Date') !!}
                            {!! Form::date('enddate',null,['class'=>'edit-form-control','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Rounding') !!}
                            {!! Form::number('rounding',null,['class'=>'edit-form-control','placeholder'=>'Rounding','required','step'=>'any']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Decimal Place') !!}
                            {!! Form::number('decimalplace',null,['class'=>'edit-form-control','placeholder'=>'Decimal place','required']) !!}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Sell Rate') !!}
                            {!! Form::number('sellrate',null,['class'=>'edit-form-control','placeholder'=>'Sell Rate','step'=>'any','required']) !!}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('Buy Rate') !!}
                            {!! Form::number('buyrate',null,['class'=>'edit-form-control','placeholder'=>'Buy Rate','step'=>'any','required']) !!}
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-lg-3">
                        {!! Form::checkbox('editlc',null,$c->localecurrency,['id'=>'editlc']) !!}
                        <label for="editlc">
                            Locale Currency
                        </label>
                    </div>
                    <div class="col-lg-3">
                        {!! Form::checkbox('editdefault',null,$c->default,['id'=>'editdefault']) !!}
                        <label for="editdefault">
                            Default
                        </label>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::submit('Update',['class'=>'btn btn-success btn-sm']) !!}
                            {!! Form::reset('Clear',['class'=>'btn btn-warning btn-sm']) !!}
                            <a class="cursor-pointer btn btn-danger btn-sm" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>