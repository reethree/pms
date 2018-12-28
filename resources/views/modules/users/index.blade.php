@extends('main-layout')

@section('content')
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php $i = 1;?>
                @foreach($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                      <td><span class="label label-success">Active</span></td>  
                      <td>
                          <a href="{{route('edit-users', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                          <a href="{{route('delete-users', $user->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="{{route('create-users')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
                {{ $users->links() }}
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    
@endsection

@section('custom_js')

@endsection