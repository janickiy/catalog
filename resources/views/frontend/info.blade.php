@extends('layouts.frontend')

@section('title', $title)
@section('description', '')
@section('keywords', $link->keywords)


@section('css')

@endsection

@section('content')

    <div class="col-sm-12 bg-white rounded box-shadow" style="margin:10px">

    <h1>{{ $link->name }}</h1>

    <p>{!! $link->full_description !!}</p>

    <p>Раздел: {!! $link->catalog->name !!}</p>

    @if($link->phone)<p>Тел.: {!! $link->phone !!}</p>@endif

    @if($link->city)<p>Город: {!! $link->city !!}</p>@endif

    <br />
    Перейти на сайт: <a href="{{ url('redirect/' . $link->id) }}">http://{{ $link->url }}</a>

    <table border="0" width=100%>
        <tr>
            <td align="center"><script type="text/javascript"><!--
                    google_ad_client = "pub-2243538192217050";
                    /* 180x150, создано 13.01.09 */
                    google_ad_slot = "0787053397";
                    google_ad_width = 180;
                    google_ad_height = 150;
                    //-->

                </script>
                <script type="text/javascript"
                        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script></td>
            <td align="center"><script type="text/javascript"><!--
                    google_ad_client = "pub-2243538192217050";
                    /* 180x150, создано 13.01.09 */
                    google_ad_slot = "3389480850";
                    google_ad_width = 180;
                    google_ad_height = 150;
                    //-->
                </script>
                <script type="text/javascript"
                        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script></td>
            <td align="center"><script type="text/javascript"><!--
                    google_ad_client = "pub-2243538192217050";
                    /* 180x150, создано 13.01.09 */
                    google_ad_slot = "8384555531";
                    google_ad_width = 180;
                    google_ad_height = 150;
                    //-->
                </script>
                <script type="text/javascript"
                        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script></td>
        </tr>
    </table>

    </div>

@endsection

@section('js')



@endsection
