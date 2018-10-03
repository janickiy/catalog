@extends('layouts.admin')

@section('title', 'Добавление параметра')

@section('css')

@endsection

@section('content')

<!-- Main content -->
<section class="content">

    @include('layouts.admin_common.notifications')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить параметр</h3>
                </div>

                {!! Form::open(['url' => isset($setting) ? URL::to('admin/settings/update/'.$setting->id ) : URL::route('admin.settings.store'),'files' => true, 'method' => isset($setting) ? 'put' : 'post', 'class' => 'form-horizontal']) !!}
                {!! Form::hidden('setting_id', isset($setting) ? $setting->id: null) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('key_cd', 'Ключ *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            @if(isset($setting))
                            {!! Form::text('key_cd', old('key_cd', $setting->key_cd), ['class' => 'form-control', 'placeholder'=>'Key','readonly']) !!}
                            @else
                            {!! Form::text('key_cd', old('key_cd', null), ['class' => 'form-control', 'placeholder'=>'Key']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'Тип *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            {!! Form::text('type', old('type', isset($setting) ? $setting->type : $type), ['class' => 'form-control validate[required]', 'placeholder'=>'Type', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('display_value', 'Свойство *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            {!! Form::text('display_value', old('display_value', isset($setting) ? $setting->display_value : null), ['class' => 'form-control validate[required]','placeholder'=>'Свойство']) !!}
                        </div>
                    </div>
                    @if(isset($setting) && $setting->type == 'SELECT' || $type == 'SELECT' )
                    <div class="form-group" id="type_select">
                        {!! Form::label('value', 'Value *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            <ul id="options-select" class="fake-input" tabindex="1" style="width:100%;"  data-values="{{ isset($setting) ? $setting->getOriginal('value') : ''}}">
                            </ul>
                        </div>
                    </div>
                    @elseif(isset($setting) && $setting->type == 'FILE' || $type == 'FILE' )
                    <div class="form-group" id="type_text">
                        {!! Form::label('value', 'Значение *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
						<span class="btn  btn-file  btn-primary">Загрузить файл {!! Form::file('value') !!}	</span>
                        </div>
                        @if(isset($setting))
                        <div class="col-md-4">
                            <a class="btn btn-info" href="{{ url('admin/settings/download/' . $setting->id) }}">Загрузить</a>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="form-group" id="type_text">
                        {!! Form::label('value', 'Значение *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('value', old('value', isset($setting) ? $setting->value : null), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($setting) ? 'Обновить': 'Добавить'), ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div><!-- .col-md-12 -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
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