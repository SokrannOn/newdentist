@extends('admin.master')
@section('content')
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 5px; margin-top: 25%;">
               	<div class="panel panel-warning">
               		<div class="panel-heading">
               			<h4><i class="fa fa-exclamation-triangle fa-sm" aria-hidden="true"></i> Warning!</h4>
               		</div>
               		<div class="panel-body">
               			<p>Sorry! This page cannot diplay. Because administrator didn't set values yet.</p>
               			<p>Click on <a href="{{ url()->previous() }}" > Back </a></p>
               		</div>
               	</div>
            </div>
        </div>
    </div>

@stop
@section('script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
        $('#myModal').modal();
	});

</script>
@stop