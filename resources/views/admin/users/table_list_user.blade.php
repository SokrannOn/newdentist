<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="center">User ID</th>
            <th class="center">Photo</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Position</th>
            <th>Email</th>
            <th style="width:20%; !important;" class="center">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php $i=1;?>
            @foreach($user as $u)
                <td style="line-height: 50px;" class="center">{{$i++}}</td>
                <td class="center"><img src='{{asset("photo/$u->photo")}}' alt="no image" style="background: white;border:2px solid #00A6C7;border-radius: 50px;padding:1px;height: 50px; width: 50px;"></td>
                <td style="line-height: 50px">{{$u->name}}</td>
                <td style="line-height: 50px">{{$u->username}}</td>
                <td style="line-height: 50px">{{$u->position->name}}</td>
                <td style="line-height: 50px">{{$u->email}}</td>
                <td style="line-height: 50px" class="center">


                    <a href="#" onclick='editUser("{{$u->id}}")' data-toggle="modal" data-target="#editUser"><i class="fa fa-edit icon-edit"></i></a>
                    <a href="#" onclick='resetPassword("{{$u->id}}")' data-toggle="modal" data-target=".bs-example-modal-sm" style="padding: 2px;"><i class="fa fa-refresh" style="color: #00a65a;"></i></a>
                    <a href="#" onclick='deleteUser("{{$u->id}}")'><i class="fa fa-trash icon-delete"></i></a>
                    <a href="#" onclick='viewUser("{{$u->id}}")'  data-toggle="modal" data-target="#viewUser"><i class="fa fa-eye icon-view"></i></a>

                </td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>