@extends('layouts.admin')

@section('title', $title)

@section('css')

@endsection

@section('content')

    @if (isset($title))<h2>{!! $title !!}</h2>@endif

    @include('layouts.admin_common.notifications')

    <div class="row-fluid">

        <div class="col">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

                <!-- widget div-->
                <div>

                    @if(Helpers::has_permission(Auth::user()->id, 'add_user'))
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-12 padding-bottom-10">
                                    <a href="{{ URL::route('admin.user.create') }}"
                                       class="btn btn-info btn-sm pull-left"><span class="fa fa-plus"> &nbsp;</span>Добавить пользователя</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <table id="userList" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th data-hide="phone">ID</th>
                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Имя</th>
                            <th data-hide="phone"><i class="fa fa-fw fa-envelope text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                            <th data-hide="phone,tablet"> Роль</th>
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Дата регистрации</th>
                            <th data-hide="phone,tablet"> Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </div>

@endsection

@section('js')
    <script>

        $(document).ready(function () {

            pageSetUp();

            /* // DOM Position key index //

            l - Length changing (dropdown)
            f - Filtering input (search)
            t - The Table! (datatable)
            i - Information (records)
            p - Pagination (paging)
            r - pRocessing
            < and > - div elements
            <"#id" and > - div with an id
            <"class" and > - div with a class
            <"#id.class" and > - div with an id and class

            Also see: http://legacy.datatables.net/usage/features
            */

            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#userList').dataTable({

                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#userList'), breakpointDefinition);
                    }
                },

                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('id', 'rowid_' + data['id']);
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! URL::route('admin.datatable.users') !!}'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'created_at', name: 'created_at'},
                    {data: "actions", name: 'actions', orderable: false, searchable: false}],
            });

            /* END BASIC */



            $('#userList').on('click', 'a.deleteRow', function () {
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
                            url: SITE_URL + "/admin/user/destroy/" + rowid,
                            type: "DELETE",
                            dataType: "html",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function () {
                                $("#rowid_" + rowid).remove();
                                swal("Сделано!", "Данные успешно удалены!", "success");
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal("Ошибка при удалении!", "Попробуйте еще раз", "error");
                            }
                        });
                    });
            });
        })

    </script>
@endsection