@extends('layouts.frontend')

@section('title', 'Главная страница')
@section('description', '')
@section('keywords', '')

@section('css')

    <style>

        html,
        body {
            overflow-x: hidden; /* Prevent scroll on narrow devices */
        }

        body {
            padding-top: 56px;
        }

        @media (max-width: 767.98px) {
            .offcanvas-collapse {
                position: fixed;
                top: 56px; /* Height of navbar */
                bottom: 0;
                width: 100%;
                padding-right: 1rem;
                padding-left: 1rem;
                overflow-y: auto;
                background-color: var(--gray-dark);
                transition: -webkit-transform .3s ease-in-out;
                transition: transform .3s ease-in-out;
                transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }

            .offcanvas-collapse.open {
                -webkit-transform: translateX(-1rem);
                transform: translateX(-1rem); /* Account for horizontal padding on navbar */
            }
        }


        .nav-scroller .nav {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            color: rgba(255, 255, 255, .75);
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
            color: var(--secondary);
        }

        .nav-underline .nav-link:hover {
            color: var(--blue);
        }

        .nav-underline .active {
            font-weight: 500;
            color: var(--gray-dark);
        }


        .border-bottom {
            border-bottom: 1px solid #e5e5e5;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }


    </style>

@endsection

@section('content')

    <ul class="list-inline">
        <li><a href="">sdasd.</a></li>
        <li>sdasd.</li>
    </ul>


    <div class="row">
        <div class="col-sm-12 bg-white rounded box-shadow" style="margin:10px">
            <table width="100%" border="0">
                @for ($i = 0; $i < $number; $i++)
                    <tr>
                        @for ($j = 0; $j < getSetting('COLUMNS_NUMBER'); $j++)
                            <td valign="top" width="{{ getSetting('COLUMNS_NUMBER') }}">
                                @if(isset($arr[$i][$j][1]) && isset($arr[$i][$j][0]) && isset($arr[$i][$j][3]))
                                    <table border="0">
                                        <tr>
                                            <td style="padding:6px" valign="top">
                                                <img border="0" width="30px"
                                                     src="{{ isset($arr[$i][$j][2]) && $arr[$i][$j][2] ? url('uploads/catalog/' . $arr[$i][$j][2]) : url('/img/folder.gif') }}">
                                            </td>
                                            <td style="padding:6px">
                                                <a href="{{ URL::route('index', ['id' => $arr[$i][$j][1]]) }}">{{ $arr[$i][$j][0] }}</a>
                                                <span>({{ $arr[$i][$j][3] }})</span><br>
                                                <div class="subcat">

                                                    {!! ShowSubCat($arr[$i][$j][1]) !!}

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
    </div>


    {!! isset($pathway) ? $pathway : '' !!}


    <div class="row">



        <div style="margin:10px" class="col-sm-12 col-md-8 col-lg-8   bg-white rounded box-shadow">
            <div style="text-align: right;">
                <a class="btn btn-success" href="{{ URL::route('addurl') }}">Добавить сайт</a>
            </div>
            <h2 style="padding-bottom: 20px">Suggestions</h2>


            <table width="100%" cellspacing="0" cellpadding="0" border="0">

            @foreach($links as $link)

                <!-- одна запись -->
                    <tr>
                        <td valign="top" align="right">
                             {{ $rank++ }}.&nbsp;&nbsp;
                        </td>
                        <td valign="bottom" align="left" width="100%" class="rez-h">
                           <strong class="text-info">{{ $link->name }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-bottom:25px;">
                            <div class="border-bottom border-gray">
                                <address><a href="" target="_blank">
                                    {!! isset($link->htmlcode_banner) && $link->htmlcode_banner ? $links->htmlcode_banner : '<img border="0" src="'.url('/img/noimage.gif').'">'; !!}
                                </a>
                                {{ $link->description }}
                                    <br>
                                    <a href="http://{{ $link->url }}" target="_blank">{{ $link->url }}</a>&nbsp; &nbsp; &nbsp;
                                   <span class="text-muted">
                                    {{ $link->created_at }}
                                    &nbsp; &nbsp; &nbsp;
                                    Количество просмотров - {{ $link->views }}
                                    &nbsp; &nbsp; &nbsp;
                                    @if($link->city) Город - {{$link->city}}@endif
                                   </span>
                                </address>
                                <p class="text-right"><a style="margin-bottom: 20px" href="{{ URL::route('info',['id' => $link->id]) }}">подробно...</a></p>
                            </div>

                        </td>
                    </tr>

            </table>
            @endforeach



        </div>





        <div style="margin:10px" class="" col-sm-12 col-md-4 col-lg-2 bg-white rounded box-shadow">
            hjkljj fffffffffffffffffffffffffffffffffffffffffffffff
        </div>

        <div style="margin:10px" class="col-sm-12 col-md-8 col-lg-8">

            {!! isset($id) && $id ? $links->links() : '' !!}
        </div>

    </div>




@endsection

@section('js')
    <script>


    </script>
@endsection
