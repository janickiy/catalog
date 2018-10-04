@extends('layouts.admin')

@section('title', 'Импорт' )

@section('content')

    <h2>Импорт</h2>

    <div class="row-fluid">
        <div class="col">

            {!! Form::open(['url' => URL::route('admin.links.importlink'), 'files' => true, 'method' => 'post', 'class' => 'form-horizontal']) !!}

            <div class="box-body">

                <div class="form-group">

                    {!! Form::label('file', 'Файл', ['class' => 'col-sm-3 control-label']) !!}

                    <div class="col-sm-6">

                        {!! Form::file('file',  ['class' => 'form-control input-file-field']) !!}

                        @if ($errors->has('file'))
                            <p class="text-danger">{{ $errors->first('file') }}</p>
                        @endif

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
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection