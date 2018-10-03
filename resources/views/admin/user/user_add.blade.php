@extends('layouts.admin')

@section('title', $title)

@section('css')

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box box-info">
             <div class="box-header with-border">
              <h3 class="box-title">Add New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('admin/user/store') }}" method="post" id="myform1" class="form-horizontal" enctype="multipart/form-data">
            
             <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">

              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Name</label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Name" class="form-control" id="name" name="name">
                  
                  @if ($errors->has('name')) 
                  <p class="text-danger">{{ $errors->first('name') }}</p>
                  @endif

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Email</label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Email" class="form-control" id="email" name="email">
                  @if ($errors->has('email')) 
                  <p class="text-danger">{{ $errors->first('email') }}</p>
                  @endif                    
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Password</label>
                  <div class="col-sm-6">
                    <input type="password" placeholder="Password" class="form-control" id="password" name="password">
                 
                  @if ($errors->has('password')) 
                  <p class="text-danger">{{ $errors->first('password') }}</p>
                  @endif

                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Confirm password</label>
                  <div class="col-sm-6">
                    <input type="password" placeholder="Confirm password" class="form-control" id="password_confirmation" name="password_confirmation">
                  @if ($errors->has('password_confirmation')) 
                  <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                  @endif

                  </div>
                </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Role</label>
            <div class="col-sm-6">

               <select class="form-control select2" name="role" id="role">
               <option value="" >Select</option>
                @foreach($roles as $role)
                  <option value="{{$role->id}}" >{{$role->name}}</option>
                @endforeach
                </select>
                
                @if ($errors->has('role')) 
                  <p class="text-danger">{{ $errors->first('role') }}</p>
                 @endif

            </div>
          </div>


                    <div class="form-group">
                      <label class="col-sm-3 control-label" for="inputEmail3">Avatar</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control input-file-field" name="avatar">
                      </div>
                    </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-4">
                <a href="{{ url('admin/user/list') }}" class="btn btn-info btn-flat pull-right">Cancel</a>
                </div>
                <div class="col-sm-5">
                <button class="btn btn-primary btn-flat pull-right" type="submit">Submit</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

</section>
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection