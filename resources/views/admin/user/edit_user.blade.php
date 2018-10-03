@extends('layouts.admin')

@section('title', $title)

@section('css')

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
<div class="box">
<form action='{{ url("admin/user/update") }}' method="post" class="form-horizontal" enctype="multipart/form-data" id="admin">
  {!! csrf_field() !!}
      <div class="box-body">
      <h4 class="text-info text-center">Edit User</h4>

        <input type="hidden" name="id" value="{{$userData->id}}">

        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputName">Name</label>

          <div class="col-sm-6">
            <input type="text" value="{{$userData->name}}" class="form-control" id="name" name="name">

            @if ($errors->has('name')) 
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
    
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">Email</label>

          <div class="col-sm-6">
            <input type="email" value="{{$userData->email}}" class="form-control" id="email" name="email" readonly>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">New Password</label>

          <div class="col-sm-6">
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">Confirm Password</label>

          <div class="col-sm-6">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            @if ($errors->has('confirm_password')) 
            <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
            @endif
            
          </div>
        </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Role</label>
            <div class="col-sm-6">

               <select class="form-control select2" name="role_id" id="role_id">
               <option value="" >Select</option>
                @foreach($roles as $role)
                  <option value="{{$role->id}}" <?= ($role->id==$userData->role_id) ? 'selected' : '' ?>>{{$role->name}}</option>
                @endforeach
                </select>
                
                @if ($errors->has('role')) 
                  <p class="text-danger">{{ $errors->first('role_id') }}</p>
                 @endif

            </div>
          </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Avatar</label>

          <div class="col-sm-6">
            <input type="file" name="avatar" class="form-control input-file-field">
            <input type="hidden" name="pic" value="{{ $userData->avatar ? $userData->avatar : 'NULL' }}">
            <br>
            @if (!empty($userData->avatar))
            <img src='{{ url("public/uploads/users/$userData->avatar") }}' alt="No Avatar" width="80" height="80">
            @else
            <img src='{{ url("public/user.png") }}' alt="No Avatar" width="80" height="80">
            @endif

          </div>
        </div>


      </div>
      <div class="box-footer">
      <div class="col-sm-4">
      <a href="{{ url('admin/user/list') }}" class="btn btn-info btn-flat pull-right">Cancel</a>
      </div>
      <div class="col-sm-5">
      <button class="btn btn-primary btn-flat pull-right" type="submit">Submit</button>
      </div>
      </div>
      </form>
      </div>

    </section>
@endsection
@section('js')
    <script type="text/javascript">


    </script>
@endsection