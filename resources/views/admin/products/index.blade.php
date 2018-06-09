@if($pro->count())
    <div class="form-group table-responsive">
        <table id="productList" class="table table-bordered table-striped kh-os">
            <thead>
            <tr>
                <th>No</th>
                <th>Khmer Name</th>
                <th>Category Name</th>
                <th>Branch Name</th>
                <th>Qty</th>
                <th>Created By</th>
                <th style="width:20%; !important;" class="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            @foreach($pro as $p)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$p->khName}}</td>
                    <td>{{$p->category_id ==0 ? '' :$p->category->name}}</td>
                    <td>{{$p->branch_id == 0 ? '' : $p->branch->name}}</td>
                    <td>{{$p->qty}}</td>
                    <td>{{$p->user->name}}</td>
                    <td class="center">
                        <a class="cursor-pointer" onclick="editProduct('{{$p->id}}')"><i class="fa fa-edit icon-edit"></i></a></a>
                        <a class="cursor-pointer" onclick="deleteProduct('{{$p->id}}')"><i class="fa fa-trash icon-delete"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <h4 class="center text-danger">Record not found!</h4>
@endif