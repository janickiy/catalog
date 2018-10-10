@extends('layouts.admin')

@section('title', 'Ссылки')

@section('css')

@endsection

@section('content')

    @if (isset($title))<h2>{!! $title !!}</h2>@endif

    @include('layouts.admin_common.notifications')

    <div class="row">
        <div class="col-lg-12"><p class="text-center">
                <a class="btn btn-outline btn-default btn-lg" title="Импорт" href="{{ URL::route('admin.links.import') }}">
                    <span class="fa fa-download fa-2x"></span> Импорт
                </a>
                <a class="btn btn-outline btn-default btn-lg" title="Экспорт" href="{{ URL::route('admin.links.export') }}">
                    <span class="fa fa-upload fa-2x"></span> Экспорт
                </a>
            </p>
        </div>
    </div>

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    @if(Helpers::has_permission(Auth::user()->id, 'add_role'))
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-12 padding-bottom-10">
                                    <a href="{{ URL::route('admin.links.create') }}"
                                       class="btn btn-info btn-sm pull-left"><span class="fa fa-plus"> &nbsp;</span>Добавить
                                        ссылку</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {!! Form::open(['url' => URL::route('admin.statuslinks.update'), 'method' => 'put']) !!}

                    <table id="itemList" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th><span><input type="checkbox" title="Отметить все/Снять отметку у всех"  id="checkAll"></span></th>
                            <th data-hide="phone"> ID</th>
                            <th data-hide="phone"> Название</th>
                            <th data-hide="phone"> Описание</th>
                            <th data-hide="phone"> Ссылка</th>
                            <th data-hide="phone"> Email</th>
                            <th data-hide="phone"> Каталог</th>
                            <th data-hide="phone"> Статус</th>
                            <th data-hide="phone"> Просмотры</th>
                            <th data-hide="phone"> Дата</th>
                            <th data-hide="phone,tablet"> Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-sm-12 padding-bottom-10">
                            <div class="form-inline">
                                <div class="control-group">

                                    {!! Form::select('action', $status_list, null, ['class' => 'span3 form-control', 'placeholder' => 'выберите', 'id' => 'select_action']) !!}

                                    <span class="help-inline">

                                        {!! Form::submit( 'Применить', ['class' => 'btn btn-success']) !!}

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $("#itemList").DataTable({
                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('id', 'rowid_' + data['id']);
                    if (data['status_link'] == 'hide' || data['status_link'] == 'black') $(row).attr('class', 'danger');
                    else if (data['status_link'] == 'new') $(row).attr('class', 'warning');

                },
                aaSorting: [[1, 'asc']],
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route('admin.datatable.links') !!}',
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'url', name: 'url'},
                    {data: 'email', name: 'email'},
                    {data: 'catalog', name: 'catalog', searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'views', name: 'views'},
                    {data: 'created_at', name: 'created_at'},
                    {data: "actions", name: 'actions', orderable: false, searchable: false}
                ],
            });
        });

        // Delete start
        $(document).ready(function () {

            $('#itemList').on('click', 'a.deleteRow', function () {

                var btn = this;
                var rowid = $(this).attr('id');
                swal({
                        title: "Вы уверены?",
                        text: "Вы не сможете восстановить эту информацию!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Да, удалить!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: SITE_URL + "/admin/links/delete/" + rowid,
                            type: "DELETE",
                            dataType: "html",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function () {
                                $("#rowid_" + rowid).remove();
                                swal("Сделано!", "Данные успешно удаленны!", "success");
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal("Ошибка при удалении!", "Попробуйте еще раз", "error");
                            }
                        });
                    });
            });

            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

        });
    </script>
@endsection