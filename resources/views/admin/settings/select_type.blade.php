@extends('layouts.admin')

@section('title', $title)

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

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <a href="{{ url('admin/settings/create/TEXT') }}" style="width:200px"  class="btn btn-primary">Добавить Text параметр</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('admin/settings/create/SELECT') }}" style="width:200px" class="btn btn-primary">Добавить Select параметр</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('admin/settings/create/FILE') }}" style="width:200px" class="btn btn-primary">Добавить File параметр</a>
                                </div>
                            </div>
                        </div>
                    </div>
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