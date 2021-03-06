@extends('layouts.qadoorheader')
@section('qadoor_meta')
    <title>QADoor问答门分类页_{{ $cat->name }}</title>
    <meta name="keywords" content="QADoor,QADoor.com,qadoor.com,问答门,{{ $cat->name }}">
    <meta name="author" content="Lucas, 网站:www.yuanpengfei.com">
    <meta name="description" content="QADoor(问答门)是一个问答索引站,聚合了互联网各大平台的问答内容,致力于为软件开发相关人员提供高质量的问答结果参考.">
@endsection
@section('content')
    <div class="container row">
        <div class="col-xs-12 col-md-9 menu_floor">
            <div class="ad_first mt20">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- QADoor分类页面顶部广告1 -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-4980361559626740"
                     data-ad-slot="8217494351"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <section class="android floor">
                <div class="title_head mt20">
                    <div class="title_name">
                        {{ $cat->name }}
                    </div>
                    <div class="title_detail">
                        <ul>
                            <li class="mr20 active"><a href="#cat_latest" data-toggle="tab">最新的</a></li>
                            <li><a href="#cat_hottest" data-toggle="tab">热门的</a></li>
                        </ul>
                        <div class="tips">
                            @foreach( $cat->tags->take(3) as $tag)
                                <a href="/tag_list/{{ $tag->id }}" target="_blank">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <div class="more">
                            <a href="#">更多相关标签>> </a>
                        </div>
                    </div>
                </div>
                <div class="content tab-content" id="myTabContent1">
                    <div class="tab-pane fade in active" id="cat_latest">
                        <ul>
                            @foreach($latest_questions as $question)
                            <li class="clear_fix">
                                <ul class="num clear_fix">
                                    <li class="num_vote"><i>{{ $question->votes }}</i>投票</li>
                                    @if($question->answers->count() == 0)
                                        <li class="num_answer_mid"><i>{{ $question->answers->count() }}</i>回答</li>
                                    @elseif($question->answers->count() >= 50)
                                        <li class="num_answer_no"><i>{{ $question->answers->count() }}</i>回答</li>
                                    @else
                                        <li class="num_answer_ok"><i>{{ $question->answers->count() }}</i>回答</li>
                                    @endif
                                    <li class="num_scan"><i>50</i>浏览</li>
                                </ul>
                                <div class="question">
                                    <div class="questioner mt20">
                                        <a class="qser_name">Mno</a> 刚刚提问
                                    </div>
                                    <a href="/detail/{{ $question->id }}" class="describe">
                                        {{ $question->title }}
                                    </a>
                                    @foreach($question->tags->take(2) as $tag)
                                    <a href="/tag_list/{{ $tag->id }}" target="_blank" class="fllt">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        {{$latest_questions->appends(array_except(Request::query(), 'latest_page'))->links()}}
                    </div>


                    <div class="tab-pane fade in" id="cat_hottest">
                        <ul>
                            @foreach($hotted_questions as $question)
                                <li class="clear_fix">
                                    <ul class="num clear_fix">
                                        <li class="num_vote"><i>{{ $question->votes }}</i>投票</li>
                                        @if($question->answers->count() == 0)
                                            <li class="num_answer_mid"><i>{{ $question->answers->count() }}</i>回答</li>
                                        @elseif($question->answers->count() >= 50)
                                            <li class="num_answer_no"><i>{{ $question->answers->count() }}</i>回答</li>
                                        @else
                                            <li class="num_answer_ok"><i>{{ $question->answers->count() }}</i>回答</li>
                                        @endif
                                        <li class="num_scan"><i>50</i>浏览</li>
                                    </ul>
                                    <div class="question">
                                        <div class="questioner mt20">
                                            <a class="qser_name">Mno</a> 刚刚提问
                                        </div>
                                        <a href="/detail/{{ $question->id }}" class="describe">
                                            {{ $question->title }}
                                        </a>
                                        @foreach($question->tags->take(2) as $tag)
                                            <a href="/tag_list/{{ $tag->id }}" target="_blank" class="fllt">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{$hotted_questions->appends(array_except(Request::query(), 'hotted_page'))->links()}}
                    </div>

                </div>
            </section>

        </div>
        @include('frontend.sidebar')
    </div>
    <input type="hidden" id="active_item" value="{{$current_active_item}}" />
@endsection
@section('customjs')
    <script type="text/javascript">
        $(document).ready(function(){
            var item = $('#active_item').val().trim();
            if (item == "latest_page") {
//                alert("最新");
                $('div.title_detail ul li').removeClass('mr20 active');
                $('div.title_detail ul li:eq(0)').addClass('mr20 active');
                $('div.title_detail ul li:eq(1)').removeClass('mr20 active');
                $('#cat_hottest').removeClass('active'); // remove active class from tabs
                $('#cat_latest').addClass('active'); // remove active class from tabs
            } else if (item == "hotted_page") {
//                alert("最热");
                $('div.title_detail ul li').removeClass('mr20 active');
                $('div.title_detail ul li:eq(1)').addClass('mr20 active');
                $('div.title_detail ul li:eq(0)').removeClass('mr20 active');
                $('#cat_latest').removeClass('active'); // remove active class from tabs
                $('#cat_hottest').addClass('active'); // remove active class from tabs
            }
        });
    </script>
@endsection