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

                    <table id="itemList" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th data-hide="phone"> ID</th>
                            <th data-hide="phone"> Имя</th>
                            <th data-hide="phone"> Email</th>
                            <th data-hide="phone"> Сообщение</th>
                            <th data-hide="phone"> IP</th>
                            <th data-hide="phone"> Дата</th>
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
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $("#itemList").DataTable({
                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('id', 'rowid_' + data['id']);
                },
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route('admin.datatable.messages') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'message', name: 'message'},
                    {data: 'ip', name: 'ip'},
                    {data: 'created_at', name: 'created_at'},
                ],
            });
        });

    </script>
@endsection