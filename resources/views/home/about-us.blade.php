@extends('home.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
    <div class="block00">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-3 column">
                    <div class="block00-img">
                        <img src="{{ asset('img/about-us/about-us_01.png') }}" alt="">
                    </div>
                    <div class="block00-text">
                        <p>关注我们的订阅号</p>
                        <p>企业动态随时掌握</p>
                    </div>
                    <div class="line"><img src="{{ asset('img/about-us/about-us_04.png') }}" alt=""></div>
                </div>

                <div class="col-md-3 column">
                    <div class="block00-img">
                        <img src="{{ asset('img/about-us/about-us_02.png') }}" alt="">
                    </div>
                    <div class="block00-text">
                        <p>关注我们的小程序</p>
                        <p>不错过任何招聘信息</p>
                    </div>
                    <div class="line"><img src="{{ asset('img/about-us/about-us_04.png') }}" alt=""></div>
                </div>

                <div class="col-md-3 column">
                    <div class="block00-img">
                        <img src="{{ asset('img/about-us/about-us_03.png') }}" alt="">
                    </div>
                    <div class="block00-text">
                        <p>关注我们的客服</p>
                        <p>企业入驻、在线咨询</p>
                    </div>
                    <div class="line"><img src="{{ asset('img/about-us/about-us_04.png') }}" alt=""></div>
                </div>

                <div class="col-md-3 column">
                    <div class="block00-img">
                        <img src="{{ asset('img/ic_phone.png') }}" alt="">
                    </div>
                    <div class="block00-text">
                        <p>全国免费热线</p>
                        <p>400-888-888</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block01">
        <div class="block-content">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12 column block-title">
                        <img src="{{ asset('img/ic_want.png') }}" alt="">
                        <h1>我们想要解决的</h1>
                    </div>

                    <div class="col-md-6 column">
                        <div class="block01-item">
                            <div class="item-title">没有学历？</div>
                            <div class="item-content">太多的过来人在感叹”这个专业不适合我！“专业是针对职场需要而不同职业的对人的性格、优势、潜能的要求各不相同、选择一个不适合自己的专业无异于自废武功。用自己的短板与别人的优势血拼，所以一定要找到适合的专业，以专业为报考原则，不要以“尽可能上知名学校”为原则！</div>
                        </div>
                    </div>

                    <div class="col-md-6 column">
                        <div class="block01-item">
                            <div class="item-title">没有经验？</div>
                            <div class="item-content">录取分数高有可能因为该专业当下比较热门而导致报考人数多形成的，还有的专业录取分数高可能是因为一年该专业由于录取分数低而使当年报考人数较多形成的，就算这个专业是该校王牌专业，也并不一定就是适合孩子的专业。</div>
                        </div>
                    </div>
                    <div class="col-md-6 column">
                        <div class="block01-item">
                            <div class="item-title">没有技能？</div>
                            <div class="item-content">未来的就业情况瞬息万变，高考的今年热门不代表大学四年毕业后的热门和好就业，看看我们身处的环境，短短四五年时间，以大数据、云计算、人工智能为代表的信息科技都以爆炸式发展把我们带入了一个更智能的认知时代，最重要的是自己的优势是什么，适合什么，选择大于努力。</div>
                        </div>
                    </div>
                    <div class="col-md-6 column">
                        <div class="block01-item">
                            <div class="item-title">没有人脉？</div>
                            <div class="item-content">每个人的兴趣可能会变化，尤其高中生社会阅历较少，对自己兴趣的认知比较表面，把兴趣当成职业是需要有性格、天赋、优势等特质，基石测评统称为“潜能”来做支撑的，很多人把兴趣当职业时会发现自己唯一的乐趣被剥夺了，是因为他不具备兴趣所具备的潜能，所以越走越痛苦。</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="block02">
        <div class="block-content">
            <div class="container">
                <div class="row clearfix">

                    <div class="col-md-12 column block-title">
                        <img src="{{ asset('img/ic_idea.png') }}" alt="">
                        <h1>区域聘理念</h1>
                    </div>
                    <div class="col-md-6 column">
                        <div class="left-img">
                            <img src="{{ asset('img/home/home_03.png') }}" alt="" class="img-responsive center-block">
                        </div>
                    </div>

                    <div class="col-md-6 column">
                        <div class="right-content">
                            <div class="p1">     北京基石测评网络技术有限公司是一家专注于人才测评与评鉴，为高中生选择专业、职业规划、性格测评的科研型企业。基石测评通过研究国内外性格测评技术并在国内研发应用12年以上，创始人团队在12年时间通过为世界500强、国内知名企业、中小型等不同规模、不同发展阶段的企业做人才甄选与评鉴，人才适岗度、胜任能力评估等人力资源系统咨询服务中积累了各行、各业、各岗位的企业用人标准及能力素质模型。高中生的专业选择就是职场岗位的前身是人生重要的转折点，基石测评通过120万以上人才库的模型统计，研发出应用于高中生专业选择的精准潜能测评，致力于帮助高中生深入认知自己、发现自己、帮助他们选择最适合自己的专业，让他们在人生路上少走弯路，为高中生未来的成功奠定基石。
                            </div>
                            <div class="p2">    在长达12年的时间，创始人团队帮助高中生选择专业人数2000人以上，帮助个人与职场人员做精准职业定位与职涯发展规划人数超过20万以上，为上市企业、大中小企业做人力资源系统咨询项目90家以上，面试、评估人才胜任能力、人才盘点人数5万人以上；线下总裁班授课101期 ，线上授课70期以上，服务的上市企业、大中小企业超过4500家，其中先后服务过时代集团、圣元乳业、慧聪网、玉柴重工、金蝶软件、广州绿茵阁、美团网、柏克中国、华美整形、樊登读书会、南京云台山集团、厦门宏仁医药、湖南大业食品、海联(香港)传媒、兰格钢铁、宁波轿辰集团、海南华亚工程设计等企业，创始人团队以卓越的服务，专业的能力，坚持“真诚、专业、服务、创新的价值观，赢得了客户的首肯。</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="block03">
        <div class="block-content">
            <div class="container">
                <div class="row clearfix">

                    <div class="col-md-12 column block-title">
                        <img src="{{ asset('img/ic_cooperate.png') }}" alt="">
                        <h1>合作企业</h1>
                    </div>

                    <ul>
                        <li><img src="{{ asset('img/home/home_07.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_09.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_11.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_13.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_15.png') }}" alt=""></li>

                        <li><img src="{{ asset('img/home/home_22.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_23.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_24.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_25.png') }}" alt=""></li>
                        <li><img src="{{ asset('img/home/home_26.png') }}" alt=""></li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
@stop
