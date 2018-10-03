@extends('layouts.admin')

@section('title', isset($catalog) ? 'Редактирование категории' : 'Добавление категории' )

@section('content')

    <h2>{!! isset($catalog) ? 'Редактирование' : 'Добавление' !!} категории</h2>

    <div class="row-fluid">
        <div class="col">

            {!! Form::open(['url' => isset($catalog) ? URL::route('admin.catalog.update') : URL::route('admin.catalog.store'), 'method' => isset($catalog) ? 'put' : 'post', 'files' => true, 'class' => 'form-horizontal']) !!}

            {!! isset($catalog) ? Form::hidden('id', $catalog->id) : '' !!}

            {!!  Form::hidden('parent_id', isset($parent_id) ? $parent_id : 0) !!}

            <div class="box-body">
                <div class="form-group">

                    {!! Form::label('name', 'Название*', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('name', old('name', isset($catalog->name) ? $catalog->name : null), ['class' => 'form-control', 'placeholder'=>'Название']) !!}

                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('description', 'Описание', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::textarea('description', old('value', isset($setting) ? $setting->description : null), ['class' => 'form-control', 'rows' => 2]) !!}

                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif

                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('keywords', 'Ключевые слова', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::text('keywords', old('keywords', isset($catalog->keywords) ? $catalog->keywords : null), ['class' => 'form-control', 'placeholder'=>'Ключевые слова']) !!}

                        @if ($errors->has('keywords'))
                            <span class="text-danger">{{ $errors->first('keywords') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    {!! Form::label('image', 'Иконка', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::file('image',  ['class' => 'form-control input-file-field']) !!}

                        {!! Form::hidden('pic', isset($catalog) && $catalog->image ? $catalog->image : 'NULL') !!}

                        <br>
                        @if (isset($catalog) && !empty($catalog->image))
                            <img src='{{ url("uploads/catalog/$catalog->image") }}' alt="Нет иконки" width="80" height="80">
                        @endif

                    </div>
                </div>







            </div>

            <div class="box-footer">
                <div class="col-sm-4">
                    <a href="{{ URL::route('admin.catalog.list') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
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

    </script>

@endsection