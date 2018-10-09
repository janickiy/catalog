@extends('layouts.frontend')

@section('title', 'Главная страница')
@section('description', '')
@section('keywords', '')

@section('css')

@endsection

@section('content')

    <table width="100%" border="0">
        @for ($i = 0; $i < $number; $i++)
            <tr>
                @for ($j = 0; $j < getSetting('COLUMNS_NUMBER'); $j++)
                    <td valign="top" width="{{ getSetting('COLUMNS_NUMBER') }}">
                        @if(isset($arr[$i][$j][1]) && isset($arr[$i][$j][0]) && isset($arr[$i][$j][3]))
                            <table border="0" class="folder">
                                <tr>
                                    <td valign="top"><img border="0" src="{{ isset($arr[$i][$j][1]) && $arr[$i][$j][1] ? url('/img/folder.gif') : url('/img/folder.gif') }}"></td>
                                    <td>
                                        <a href="{{ URL::route('index', ['id' => $arr[$i][$j][1]]) }}">{{ $arr[$i][$j][0] }}</a> <span>({{ $arr[$i][$j][3] }})</span><br>
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

    {!! isset($pathway) ? $pathway : '' !!}

    <table border="0" width="100%">
        <tr>
            <td>
                <h2></h2>
                <div style="text-align: center;"> <a href="{{ URL::route('addurl') }}">Добавить сайт</a> </div>

                @foreach($links as $link)

                    <div id="link">
                        <table width="100%" border="0">
                            <tr>
                                <td colspan="2" align="left">
                                    <table align="left">
                                        <tr>
                                            <td>{!! isset($link->htmlcode_banner) && $link->htmlcode_banner ? $links->htmlcode_banner : '<img border="0" src="'.url('/img/noimage.gif').'">"'; !!}</td>
                                        </tr>
                                    </table>
                                    <p align="justify"><a href="http://{{ $link->url }}" target=_blank>{{ $link->name }}</a> - {{ $link->description }}</a><br /><br />
                                        <a href="{{ URL::route('info',['id' => $link->id]) }}">подробно...</a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" align="left"><span class="info">добавлено: {{ $link->created_at }}<br />
                                категория: {{ $link->catalog->name }}<br />
                                кол. просмотров: {{ $link->views }} </span>
                                </td>
                            </tr>
                        </table>

                    </div>

                @endforeach

                {!! isset($id) && $id ? $links->links() : '' !!}

                <div style="text-align: center;"> <a href="{{ URL::route('addurl') }}">Добавить сайт</a> </div>
            </td>
        </tr>
    </table>

@endsection

@section('js')
    <script>



    </script>
@endsection
