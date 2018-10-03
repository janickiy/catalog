@extends('layouts.app')

@section('title', $title)

@section('css')

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      @if (Session::has('message'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{ Session::get('message') }}.
      </div>
      @endif
    
<div class="box">
<form action='{{ url("user/update-profile") }}' method="post" class="form-horizontal" enctype="multipart/form-data" id="admin">
  {!! csrf_field() !!}
      <div class="box-body">
      <h4 class="text-info text-center">Edit Profile</h4>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputName">{{ trans('message.form.name') }}</label>

          <div class="col-sm-6">
            <input type="text" value="{{$userData->name}}" class="form-control" id="name" name="name">

            @if ($errors->has('name')) 
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
    
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">{{ trans('message.table.email') }}</label>

          <div class="col-sm-6">
            <input type="email" value="{{$userData->email}}" class="form-control" id="email" name="email" readonly>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">{{ trans('message.form.new_password') }}</label>

          <div class="col-sm-6">
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputEmail">{{ trans('message.form.confirm_password') }}</label>

          <div class="col-sm-6">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            @if ($errors->has('confirm_password')) 
            <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
            @endif
            
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">{{ trans('message.form.picture') }}</label>

          <div class="col-sm-6">
            <input type="file" name="picture" class="form-control input-file-field" onchange="previewFile()">
            <input type="hidden" name="pic" value="{{ $userData->picture ? $userData->picture : 'NULL' }}">
          </div>
        </div>


      </div>
      <div class="box-footer">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-5">
      <button class="btn btn-primary btn-flat pull-right" type="submit">{{ trans('message.form.submit') }}</button>
      </div>
      </div>
      </form>
      </div>

    </section>
@endsection
@section('js')
    <script type="text/javascript">
    $('#customerAdd').validate({
        rules: {
            name: {
                required: true
            },
            email:{
                required: true
            }
        }
    });

    </script>
@endsection