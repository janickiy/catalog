@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                    <?php
                        $avatarPicture = Auth::user()->avatar;
                    ?>

                    @if($avatarPicture !=null && Auth::user()->provider !=null)
                        <img src="{{$avatarPicture}}" class="img-responsive">
                    @elseif($avatarPicture !=null && Auth::user()->provider ==null)
                    <img src='{{url("/public/uploads/users/$avatarPicture")}}' class="img-responsive">
                    @else
                        {{ config('app.name', 'Laravel') }}
                    @endif
                    <strong>{{Auth::user()->name}}</strong>
                    </div>
                    <div class="col-md-9">
                    You are logged in!
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
