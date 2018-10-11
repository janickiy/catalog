@extends('layouts.frontend')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)

@section('css')


@endsection

@section('content')

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
                                                <img border="0" width="30px" src="{{ isset($arr[$i][$j][2]) && $arr[$i][$j][2] ? url('uploads/catalog/' . $arr[$i][$j][2]) : url('/img/folder.gif') }}">
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

            <div id="logo" >
                <div id="logopos" syle="float: right !important;">

                </div>
            </div>

            <h2 style="padding-bottom: 20px">@if(isset($catalog_name)) {{$catalog_name}}@elseНовые ссылки@endif</h2>

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
