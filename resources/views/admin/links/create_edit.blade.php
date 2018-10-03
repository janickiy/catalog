@extends('layouts.admin')

@section('title', isset($link) ? 'Редактирование ссылки' : 'Добавление ссылки' )

@section('content')

    <h2>{!! isset($link) ? 'Редактирование' : 'Добавление' !!} ссылки</h2>

    <div class="row-fluid">
        <div class="col">

            {!! Form::open(['url' => isset($link) ? URL::route('admin.links.update') : URL::route('admin.links.store'), 'method' => isset($link) ? 'put' : 'post', 'class' => 'form-horizontal']) !!}

            {!! isset($link) ? Form::hidden('id', $link->id) : '' !!}

            <div class="box-body">
                <div class="form-group">

                    {!! Form::label('name', 'Название*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('name', old('name', isset($link->name) ? $link->name : null), ['class' => 'form-control', 'placeholder'=>'Название', 'id' => 'name']) !!}

                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('catalog_id', 'Каталог*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">


                        @if ($errors->has('catalog_id'))
                            <span class="text-danger">{{ $errors->first('catalog_id') }}</span>
                        @endif

                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('url', 'Url адрес сайта*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('url', old('url', isset($link->url) ? $link->url : null), ['class' => 'form-control', 'placeholder'=>'Url адрес сайта', 'id' => 'url']) !!}

                        @if ($errors->has('url'))
                            <span class="text-danger">{{ $errors->first('url') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('reciprocal_link', 'Обратная ссылка', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('reciprocal_link', old('reciprocal_link', isset($link->reciprocal_link) ? $link->reciprocal_link : null), ['class' => 'form-control', 'placeholder'=>'Обратная ссылка', 'id' => 'reciprocal_link']) !!}

                        @if ($errors->has('reciprocal_link'))
                            <span class="text-danger">{{ $errors->first('reciprocal_link') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('email', 'Email*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('email', old('email', isset($link->email) ? $link->email : null), ['class' => 'form-control', 'placeholder'=>'Email', 'id' => 'email']) !!}

                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>


                <div class="form-group">

                    {!! Form::label('description', 'Описание*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::textarea('description', old('description', isset($link) ? $link->description : null), ['class' => 'form-control', 'rows' => 2]) !!}

                       @if ($errors->has('email'))
                           <span class="text-danger">{{ $errors->first('email') }}</span>
                       @endif
                   </div>
               </div>

                <div class="form-group">

                    {!! Form::label('full_description', 'Полное описание*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::textarea('full_description', old('full_description', isset($link) ? $link->full_description : null), ['class' => 'form-control', 'rows' => 3]) !!}

                        @if ($errors->has('full_description'))
                            <span class="text-danger">{{ $errors->first('full_description') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('keywords', 'Ключевые слова', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::textarea('keywords', old('keywords', isset($link) ? $link->keywords : null), ['class' => 'form-control', 'rows' => 2]) !!}

                        @if ($errors->has('keywords'))
                            <span class="text-danger">{{ $errors->first('keywords') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('htmlcode_banner', 'HTML код баннера', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::textarea('htmlcode_banner', old('htmlcode_banner', isset($link) ? $link->htmlcode_banner : null), ['class' => 'form-control', 'rows' => 3]) !!}

                        @if ($errors->has('htmlcode_banner'))
                            <span class="text-danger">{{ $errors->first('htmlcode_banner') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('check_link', 'Проверять сайт', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::checkbox('check_link', null, isset($link) ? ($link->check_link == 1 ? true: false): false) !!}

                        @if ($errors->has('check_link'))
                            <span class="text-danger">{{ $errors->first('check_link') }}</span>
                        @endif

                    </div>
                </div>

            </div>

            <div class="box-footer">
                <div class="col-sm-4">
                    <a href="{{ URL::route('admin.links.list') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
                </div>
                <div class="col-sm-5">

                    {!! Form::submit( 'Отправить', ['class'=>'btn btn-success']) !!}

                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addRole').validate({
                rules: {
                    name: {
                        required: true
                    },
                    symbol: {
                        required: true
                    }
                }
            });
        });
    </script>
@endsection