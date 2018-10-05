@extends('layouts.admin')

@section('title', isset($role) ? 'Редактирование роли пользователя' : 'Добавление роли пользователя' )

@section('content')

    <h2>{!! isset($role) ? 'Редактирование' : 'Добавление' !!} роли</h2>

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    <p>*-обязательные поля</p>

                    {!! Form::open(['url' => isset($role) ? URL::route('admin.role.update') : URL::route('admin.role.store'), 'method' => isset($role) ? 'put' : 'post', 'class' => 'form-horizontal', 'id' => "addRole"]) !!}

                    {!! isset($role) ? Form::hidden('id', $role->id) : '' !!}

                    <div class="box-body">
                        <div class="form-group">

                            {!! Form::label('name', 'Название*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::text('name', old('name', isset($role->name) ? $role->name : null), ['class' => 'form-control', 'placeholder'=>'Название', 'id' => 'name']) !!}

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_name', 'Отображаемое имя *', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::text('display_name', old('display_name', isset($role) ? $role->display_name : null), ['class' => 'form-control', 'placeholder'=>'Отображаемое имя', 'id' => "display_name"]) !!}

                                @if ($errors->has('display_name'))
                                    <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                            {!! Form::label('description', 'Описание*', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">

                                {!! Form::text('description', old('description', isset($role) ? $role->description : null), ['class' => 'form-control', 'placeholder' => 'Описание', 'id' => "description"]) !!}

                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Права доступа</label>
                            <div class="col-sm-6">
                                <ul style="display: inline-block;list-style-type: none;padding:0; margin:0;">
                                    @if (isset($role))
                                        @foreach($permissions as $row)
                                            <li class="checkbox" style="display: inline-block; min-width: 155px;">
                                                <label>

                                                    {!! Form::checkbox('permission[]',$row->id, in_array($row->id, $stored_permissions) ? true : false) !!}

                                                    {{ $row->display_name }}

                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-sm-4">
                            <a href="{{ URL::route('admin.role.list') }}" class="btn btn-danger btn-flat pull-right">Отменить</a>
                        </div>
                        <div class="col-sm-5 margin-bottom-10">

                            {!! Form::submit( 'Отправить', ['class'=>'btn btn-success']) !!}

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

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