<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>测评报告</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="<?php echo e(URL::asset('bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::asset('style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/nav.css?__v=20180602210141')); ?>">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
    <script src="<?php echo e(URL::asset('js/echarts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js?__v=20180602210141')); ?>"></script>
    <script>
        var potentials = <?php echo json_encode($potentials); ?> //潜能
        var interests = <?php echo json_encode($interests); ?> //兴趣
        var shakes = <?php echo json_encode($shakes); ?> //型格
        var qualities = <?php echo json_encode($qualities); ?> //素质

        var potential_grades = <?php echo json_encode($potential_grades); ?> //潜能得分
        var quality_grades = <?php echo json_encode($quality_grades); ?> //素质模型得分
        var interest_grades = <?php echo json_encode($interest_grades); ?> // 兴趣得分
        var shake_grades = <?php echo json_encode($shake_grades); ?> // 型格得分

        var best_potential_has_qualities = <?php echo json_encode($best_potential_has_qualities); ?> //最佳潜能
        var second_potential_has_qualities = <?php echo json_encode($second_potential_has_qualities); ?> //第二潜能
        var third_potential_has_qualities = <?php echo json_encode($third_potential_has_qualities); ?> //第三潜能


        var short_first_potential_has_qualities = <?php echo json_encode($short_first_potential_has_qualities); ?> //短板第一潜能
        var short_second_potential_has_qualities = <?php echo json_encode($short_second_potential_has_qualities); ?> //短板第二潜能
    </script>

</head>
<body>
<div class="container-fluid">
    <div class="row-fluid" id="sy">
        <div class="col-xs-12">
            <div class="cover">

                <div class="col-xs-12">
                    <img class="img-responsive center-block" alt="340x656" src="<?php echo e(URL::asset('images/logo_cover.png')); ?>" />
                </div>
                <div class="col-xs-12 clearfix user-info">
                    <div>
                        <span class="user-name"><?php echo e($report->user_name); ?></span>
                        <span class="user-gender font28 black888"><?php echo e($report->gender == 1 ? '男' : '女'); ?></span>
                    </div>
                    <div class="user-school">
                        <span class="font28 black888"><?php echo e($report->address); ?></span>
                    </div>
                    <div>
                        <i class="blue-under-line"></i>
                    </div>
                    <div class="created_at_block">
                        <p class="font24 color35"><?php echo e(date('Y-m-d', $report->created_at)); ?>生成</p>
                    </div>


                </div>

            </div>


        </div>
    </div>
    <div id="qy" class="row-fluid">
        <div class="col-xs-12">
            <div class="preface">

                <div class="zc-title">
                    <div class="zc-title-bg">
                        <div class="zc-title-text">前言</div>
                    </div>
                </div>
                <div class="col-xs-12 clearfix">
                    <p>成功心理学的最新研究发现：在外部条件给定的前提下，一个人能否成功，关键在于能否准确识别并全力发挥其天生优势</p>
                    <div class="tfhxg">
                        <div class="tfhxg-text emphasis">天赋和性格</div>
                    </div>
                    <p>这些取得突出成就的人并不是具备什么天赋异禀的天才而是能够把自己的优势潜能在适合自己的领域中不断的应用和发挥从而获得比常人更大的成功！</p>
                    <p class="font32 orange">所以自己的优势、潜能、性格是什么？适合在什么专业和领域去发展是对个人的成功至关重要的！</p>
                    <p>高考专业选择时90%的人都在犯的一个错误——以未来的“钱途”或者个人的兴趣来作为选择专业的根据。这是非常不全面的、甚至是短浅的。今天这个专业赚钱多不代表四年以后依然如此，即使四年以后依然赚钱多但并不代表你的孩子做这行也能赚到钱。同样依据个人的兴趣来选择专业是非常片面的，每个人的兴趣可能会随着经历而变化，尤其高中生这一年龄段社会阅历较少，对自己兴趣的认知是比较表面的，要把兴趣当职业那是需要有性格、天赋、优势等基石测评统称为“潜能”来做支撑的，不是一件简单的事情。为什么很多人把兴趣当职业时会发现自己连人生的唯一的乐趣都被剥夺了呢？原因很简单，那是因为他不具备兴趣所对应的潜能，所以越做越难受、越做越痛苦。那也有一少部分人把自己的兴趣当职业并且取得很好的成就，那是因为他们具备支撑兴趣所对应的潜能。</p>
                </div>
                <div class="col-xs-12">
                    <div class="say font32 blue">
                        “世上没有绝对的庸才，只有放错位置的人才”。一个人做技术是非常平庸甚至糟糕的，但他可能很适合做与人打交道的职业并能做到优秀。如果在选择专业时不能根据自己的天赋、潜能、性格相匹配，那么就算你具有再大的潜能也无从得到释放和发挥。
                    </div>
                    <div class="say font32 blue">
                        三百六十行，行行出状元！没有最好的专业，只有最适合的专业！没有不能成就人的专业，只有选错专业的人！
                    </div>

                    <div class="say002 font32">
                        请您详细阅读此报告，深刻的认知自己，才能在未来的人生职场中占据一个高的起点！
                    </div>

                </div>
                <div class="col-xs-12">
                    <div class="triangle001"></div>
                    <div class="triangle002"></div>

                </div>
            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="col-xs-12 contents">
            <div class="zc-title">
                <div class="zc-title-bg">
                    <div class="zc-title-text">目录</div>
                </div>
            </div>
            <ul class="col-xs-12 font28 color333">
                <li><i></i>个人高匹配度的专业推荐</li>
                <li><i></i>个人28项素质模型</li>
                <li><i></i>个人潜能分布概况</li>
                <li><i></i>最佳潜能解析</li>
                <li><i></i>第二潜能解析</li>
                <li><i></i>第三潜能解析</li>
                <li><i></i>个人短板解析</li>
                <li><i></i>个人专业兴趣解析</li>
                <li><i></i>个人潜能与个人兴趣最佳匹配点解析</li>
                <li><i></i>所推荐专业的详情与未来就业空间</li>
            </ul>
        </div>
    </div>

    <div class="row-fluid">
        <div class="col-xs-12" id="zytj">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">个人高匹配度的专业推荐</div>
                </div>
            </div>
            <div class="say font26 color666">
                根据对个人的性格、天赋、行为模式、风格及兴趣等多维度的综合分析与印证，以下你最适合的、最能发挥优势、最容取得突出成就的专业推荐。
            </div>
        </div>

    </div>
    <div class="row-fluid zc">
        <div class="col-xs-12">
            <div class="major">
                <div class="zypp font26 color35">
                    最佳匹配专业
                </div>
                <?php $__currentLoopData = $major_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $major_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 10): ?>
                        <div class="major_line font28 color35"><span class="code"><?php echo e($majors[$major_grade['major_id']]['code']); ?></span><span class="school"><?php echo e($majors[$major_grade['major_id']]['name']); ?></span></div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="major">
                <div class="zypp font26 color35">
                    较佳匹配专业
                </div>
                <?php $__currentLoopData = $major_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $major_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 20 && $key >= 10): ?>
                        <div class="major_line font28 color35"><span class="code"><?php echo e($majors[$major_grade['major_id']]['code']); ?></span><span class="school"><?php echo e($majors[$major_grade['major_id']]['name']); ?></span></div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="major">
                <div class="warning">

                </div>

                <p class="font26 color35">-尺有所长，寸有所短，选择专业应谨遵扬长避短，以下
                    是 <span class="zc-red">你最不适合、最不具备优势、应该避免选择的专业</span>：</p>
                <?php $__currentLoopData = array_reverse($major_grades->toArray()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $major_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 10): ?>
                        <div class="major_line font28 color35"><span class="code"><?php echo e($majors[$major_grade['major_id']]['code']); ?></span><span class="school"><?php echo e($majors[$major_grade['major_id']]['name']); ?></span></div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


        </div>

    </div>
    <div class="row-fluid">
        <div class="col-xs-12" id="szmx">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">个人28项素质模型</div>
                </div>
            </div>
            <div class="bar-long" id="quality">

            </div>
        </div>

    </div>
    <div class="row-fluid">
        <div class="col-xs-12" id="qnfb">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">个人潜能分布概况</div>
                </div>
            </div>
            <div class="say font26 color666">
                潜能是人在其性格、天赋和经历相结合下所长期培养出来的，具有在某领域做出突出成就的潜质，是一个人在哪些方面发展能够事半功倍的精确指导。每个人都具有九大类潜能，具体分布因人而异。潜能与性格、天赋和价值取向息息相关，难以在短期内改变，而且强加改变往往使本来的优势潜能不在具有优势，而本来的短板也不会有多大的提升等不可预测的后果，所以强烈建议测试者和家长：关注和培养TA的优势潜能！扬长避短！
            </div>
            <div class="radar" id="potential_grades"></div>
            <div class="comment">
                <div class="star_5">
                    <div class="star_5_title">
                        <?php echo e(trim($level_grades[0]['name'], '/')); ?>

                    </div>
                    <img src="<?php echo e(URL::asset($level_grades[0]['star_img'])); ?>" alt="">
                    <p class="star_5_text blue font26">这是你  <span class="font36">最强大</span>  的潜能，</p>
                    <p class="star_5_text blue font26">最具优势的领域，在此方面进行针对性培养和充分的发挥，最容易取得突出成就，继而获得成功。</p>
                </div>

                <div class="star_4">
                    <div class="star_4_title">
                        <?php $__currentLoopData = explode('/', trim($level_grades[1]['name'], '/')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($name); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <img src="<?php echo e(URL::asset($level_grades[1]['star_img'])); ?>" alt="">
                    <p class="star_5_text font26">这是你  <span class="font36">非常强大</span>  的潜能，</p>
                    <p class="star_5_text font26">在此方面多多磨练和总结提升，会是你比较容易取得突出成就的领域</p>
                </div>
                <div class="star_3">
                    <div class="star_3_title">
                        <p>
                        <?php $__currentLoopData = explode('/', trim($level_grades[2]['name'], '/')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <span><?php echo e($name); ?></span>
                            <?php if($key==1): ?>
                        </p>
                        <p>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </p>

                    </div>
                    <img src="<?php echo e(URL::asset($level_grades[2]['star_img'])); ?>" alt="">
                    <p class="star_5_text font26">这是你  <span class="font36">一般</span>  的潜能，</p>
                    <p class="star_5_text font26">对你综合能力的提升会有较大的帮助，但对你取得突出成就不具有至关重要的决定性作用</p>
                </div>

                <div class="warning">

                </div>
                <div class="star_2">
                    <div class="star_2_title">
                        <?php $__currentLoopData = explode('/', trim($level_grades[3]['name'], '/')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($name); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <img src="<?php echo e(URL::asset($level_grades[3]['star_img'])); ?>" alt="">
                    <p class="star_5_text font26">这是你  <span class="font36">最不具备优势</span>  的领域，</p>
                    <p class="star_5_text font26">建议最好不要涉及该专业以及从事该类型职业，这是你天生性格的短板。每个人要改变自己的性格是非常困难，而且是需要付出非常大代价的事情，当你在弥补短板的同时会导致你最大优势的丧失，并且会对你产生不好的影响——</p>
                    <p class="star_5_text font26">如：自信心的打击，成长速度缓慢等。成功之道在于最大限度地发挥优势，控制弱点，而不是把重点放在攻克弱点上。</p>
                </div>


            </div>
        </div>

    </div>
    <div class="row-fluid zc">
        <div class="col-xs-12" id="zjqn">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">最佳潜能解析</div>
                </div>
            </div>
            <div class="say font26 color666">
                最佳潜能是指个人最本能和最具有优势的潜能，是你未来发展道路上会帮助你取得最大成就的高潜力素
                养，在此方面应该尽快下最大力度培养与充分发挥，以便不断的沉淀此方面的能力，进而早日获得突出成就
            </div>
            <div class="font34 text-center bold">你的最佳潜能是</div>
            <div class="qianneng"><?php echo e($best_potential_name = $potentials[$potential_grades[0]['potential_id']]['name']); ?></div>
            <div class="say font26 color666">
                <?php echo e($potentials[$potential_grades[0]['potential_id']]['description']); ?>

            </div>
            <div class="radar" id="best_potential">


            </div>
            <div class="comment">
                <p class="font26 comment_title">你的最佳潜能 <span class="font32"><?php echo e($best_potential_name); ?></span> 优势具体体现在:</p>
                <?php $short_in_best = false; ?>
                <?php $__currentLoopData = $best_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $best_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(60 <= $best_potential_sorted_quality_grade['quality_grade']): ?>
                        <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($best_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($best_potential_has_qualities[$best_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                    <?php else: ?>

                        <?php
                            if (40 > $best_potential_sorted_quality_grade['quality_grade']) {
                                $short_in_best = true;
                            }
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($short_in_best): ?>
                <div>
                    <div class="warning"></div>
                    <p class="font26 color35">以下是你最佳潜能 <span class="emphasis"><?php echo e($best_potential_name); ?></span> 中的较弱势的素质能力，
                        建议要重点针对性的进行提升，才能让你的最佳潜能得到
                        更加完美的体现：</p>
                    <?php $__currentLoopData = $best_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $best_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(40 > $best_potential_sorted_quality_grade['quality_grade']): ?>
                            <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($best_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($best_potential_has_qualities[$best_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                <p class="xwms font26">你的行为模式：</p>
                <?php $__currentLoopData = $best_potential_abilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 2): ?>
                    <div>
                        <div class="yuan font32 bold"><?php echo e($ability->name); ?></div>

                        <p class="font28 color35"><i></i><?php echo e($ability->description); ?></p>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

    </div>
    <div class="row-fluid zc">
        <div class="col-xs-12" id="deqn">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text"><?php echo e($second_potential_name = $potentials[$potential_grades[1]['potential_id']]['name']); ?></div>
                </div>
            </div>
            <div class="say font26 color666">
                第二潜能是个人在大部分情况下都会表现出来的优势和潜能，同时是对最佳潜能的强力补充，应该针对性培养和发挥，第二潜能也是你比较容易取得突出成就的领域。
            </div>
            <div class="font34 text-center bold">你的第二潜能是</div>
            <div class="qianneng"><?php echo e($best_potential_name = $potentials[$potential_grades[1]['potential_id']]['name']); ?></div>
            <div class="say font26 color666">
                <?php echo e($potentials[$potential_grades[1]['potential_id']]['description']); ?>

            </div>
            <div class="radar" id="second_potential">


            </div>
            <div class="comment">
                <p class="font26 comment_title">你的第二潜能 <span class="font32"><?php echo e($best_potential_name); ?></span> 优势具体体现在:</p>
                <?php $short_in_second = false; ?>
                <?php $__currentLoopData = $second_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $second_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(60 <= $second_potential_sorted_quality_grade['quality_grade']): ?>
                    <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($second_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($second_potential_has_qualities[$second_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                    <?php else: ?>
                        <?php
                            if (40 > $second_potential_sorted_quality_grade['quality_grade']) {
                                $short_in_second = true;
                            }
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($short_in_second): ?>
                <div>
                    <div class="warning"></div>
                    <p class="font26 color35">以下是你第二潜能 <span class="emphasis"><?php echo e($second_potential_name); ?></span> 中的较弱势的素质能力，
                        建议要重点针对性的进行提升，才能让你的第二潜能得到
                        更加完美的体现：</p>
                    <?php $__currentLoopData = $second_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $second_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(40 > $second_potential_sorted_quality_grade['quality_grade']): ?>
                            <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($second_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($second_potential_has_qualities[$second_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                <p class="xwms font26">你的行为模式：</p>
                <?php $__currentLoopData = $second_potential_abilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 1): ?>
                    <div>
                        <div class="yuan font32 bold"><?php echo e($ability->name); ?></div>

                        <p class="font28 color35"><i></i><?php echo e($ability->description); ?></p>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

    </div>

    <div class="row-fluid zc">
        <div class="col-xs-12" id="dsqn">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text"><?php echo e($third_potential_name = $potentials[$potential_grades[2]['potential_id']]['name']); ?></div>
                </div>
            </div>
            <div class="say font26 color666">
                第三潜能是个人在多数情况下会显现出来的优势和潜能，也是对最佳潜能和第二潜能的补充，也应着重培养和发挥，以保证在全方位发展，具有更大的成长空间。
            </div>
            <div class="font34 text-center bold">你的第三潜能是</div>
            <div class="qianneng"><?php echo e($third_potential_name); ?></div>
            <div class="say font26 color666">
                <?php echo e($potentials[$potential_grades[2]['potential_id']]['description']); ?>

            </div>
            <div class="radar" id="third_potential">


            </div>
            <div class="comment">
                <p class="font26 comment_title">你的第三潜能 <span class="font32"><?php echo e($third_potential_name); ?></span> 优势具体体现在:</p>
                <?php $short_in_third = false; ?>
                <?php $__currentLoopData = $third_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $third_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(60 <= $third_potential_sorted_quality_grade['quality_grade']): ?>
                    <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($third_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($third_potential_has_qualities[$third_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                    <?php else: ?>
                        <?php

                            if(40 > $third_potential_sorted_quality_grade['quality_grade']) {
                                $short_in_third = true;
                            }

                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($short_in_third): ?>
                <div>
                    <div class="warning"></div>
                    <p class="font26 color35">以下是你第三潜能 <span class="emphasis"><?php echo e($best_potential_name); ?></span> 中的较弱势的素质能力，
                        建议要重点针对性的进行提升，才能让你的第三潜能得到
                        更加完美的体现：</p>
                    <?php $__currentLoopData = $third_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $third_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(40 > $third_potential_sorted_quality_grade['quality_grade']): ?>
                            <p class="font28 color35"><i></i><?php echo e(\App\Models\Quality::getPrefix($third_potential_sorted_quality_grade['quality_grade'])); ?><?php echo e($third_potential_has_qualities[$third_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                    <?php endif; ?>

            </div>
        </div>

    </div>

    <div class="row-fluid zc">
        <div class="col-xs-12" id="grdb">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">个人短板分析</div>
                </div>
            </div>
            <div class="say font26 color666">
                个人短板是指个人最不具备、最欠缺的潜能，是你未来发展道路上应该避免选择的专业和避免从事的职业。长期在短板领域投入精力不仅会让自己承担更大的精神与心理压力，同时无疑是在用自己的短板与他人的优势做比拼，长此以往，会让人逐渐丧失信心，痛苦、挣扎、没有价值感等感觉会随之而来，更谈不上成功！建议：选择的专业和未来从事的职业尽量避开需要该潜能的领域。
            </div>

            <div class="duanban-title font34 text-center bold">你的个人短板是</div>
            <div class="duanban"><?php echo e($short_first_potential_name = $potentials[$potential_grades[8]['potential_id']]['name']); ?></div>
            <div class="zc-result">
                <p class="font26 color666">主要表现在：</p>
                <p class="font26 color35"><?php echo e($potentials[$potential_grades[8]['potential_id']]['shortcoming']); ?></p>
            </div>
            <div class="radar" id="short_first_potential"></div>
            <div class="zc-result">
                <p class="qqnl font26">你的第一个短板潜能 <span class="font32"><?php echo e($short_first_potential_name); ?></span> 最欠缺的能力是:</p>

                <?php $__currentLoopData = $short_first_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $short_first_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(60 > $short_first_potential_sorted_quality_grade['quality_grade']): ?>
                        <p class="font26 color35"><i></i><?php echo e($short_first_potential_has_qualities[$short_first_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="duanban-title font34 text-center bold">你的第二个个人短板潜能是</div>
            <div class="duanban"><?php echo e($short_first_potential_name = $potentials[$potential_grades[7]['potential_id']]['name']); ?></div>
            <div class="zc-result">
                <p class="font26 color666">主要表现在：</p>
                <p class="font26 color35"><?php echo e($potentials[$potential_grades[7]['potential_id']]['shortcoming']); ?></p>
            </div>
            <div class="radar" id="short_second_potential"></div>
            <div class="zc-result">
                <p class="qqnl font26">你的第二个短板潜能 <span class="font32"><?php echo e($short_first_potential_name); ?></span> 最欠缺的能力是:</p>

                <?php $__currentLoopData = $short_second_potential_sorted_quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $short_second_potential_sorted_quality_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(60 > $short_second_potential_sorted_quality_grade['quality_grade']): ?>
                        <p class="font26 color35"><i></i><?php echo e($short_second_potential_has_qualities[$short_second_potential_sorted_quality_grade['quality_id']]['quality_description']); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="row-fluid zc">
        <div class="col-xs-12" id="zyxq">
            <div class="zc-title002">
                <div class="zc-title002-bg">
                    <div class="zc-title002-text">个人专业兴趣解析</div>
                </div>
            </div>
            <div class="say font26 color666">
                个人兴趣按社会元素、职业倾向不同分为六类，每类分数越高代表在此领域的兴趣程度越高。在选择专业的时建议重点关注前3类兴趣。个人兴趣是选择专业非常重要的维度之一，越是感兴趣的领域，在学习时的自主性和效率上越高。建议：选择的专业最好在前三个兴趣分类中，尽量不要选择后3类兴趣分类的专业。
            </div>
            <div class="radar" id="interest_grades"></div>
            <p class="font26 color35 bold">
                个人兴趣是专业投入度的基石，至少要做到不排斥，以下的
                兴趣就是你基本不会排斥的前三类兴趣，有利于专业的选择。
            </p>
            <div class="triangle001"></div>
            <?php $__currentLoopData = $interest_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key < 3): ?>
                    <div class="interest">
                        <div class="star_5_title">
                            <?php echo e($interests[$interest_grade['interest_id']]['name']); ?>

                        </div>

                        <p class="font26 color35">
                            主要表现在：
                        </p>
                        <p class="font26 color35"><?php echo e($interests[$interest_grade['interest_id']]['detail']); ?>

                        </p>
                        <p class="font26 color666">
                            合适的典型职业：
                        </p>

                        <p class="font26 color666 bold"><?php echo e($interests[$interest_grade['interest_id']]['career']); ?></p>
                    </div>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

    <div class="row-fluid zc">
        <div class="col-xs-12" id="zjpp">
            <div class="zc-title003 font28">
                        <p class="text003-1">个人潜能与个人兴趣</p>
                        <p class="text003-2">最佳匹配点解析</p>

            </div>
            <div class="say font26 color666">
                个人潜能与个人兴趣最佳匹配点主要是从个人最具备的潜能和个人最感兴趣的领域中寻找最匹配的交集之处。本维度旨在寻找到个人既感兴趣又有潜能优势可以长远发展的领域。但若找不到最佳匹配点，建议以个人潜能为最重要的选择专业指标，因为个人潜能在高中生这一年龄阶段已定型且相对清晰，并且后天较难改变；但兴趣却具有不稳定性、可能会随着经历发生变化或者个人虽然感兴趣但并不具备相应的潜能，难以奠定成功的基础。
            </div>
            <div class="bar" id="shake"></div>
            <p class="font26 color35">
                你的潜能和兴趣进行对比分析后，在专业选择的过程中能够
                让你既有潜能的支撑匹配，同时又在兴趣方面也不会排斥的
                匹配点如下：
            </p>

            <?php $__currentLoopData = $shake_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shake_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key < 3): ?>
                    <div class="interest">
                        <div class="star_5_title"><?php echo e($shakes[$shake_grade['shake_id']]['name']); ?></div>
                        <p class="font26 color35">
                            主要表现在：
                        </p>
                        <p class="font26 color35 bold"><?php echo e($shakes[$shake_grade['shake_id']]['description']); ?></p>

                    </div>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="row-fluid zc">
        <div class="col-xs-12" id="wljy">
            <div class="zc-title003 font28">
                <p class="text003-1">所推荐专业的详情</p>
                <p class="text003-2">与未来就业空间</p>
            </div>
            <div class="major-10">
                <p class="font29 color333 bold">以下为</p>
                <p class="font29 color333 bold">个人最佳匹配的10个专业详情与未来就业空间</p>
            </div>

        </div>
    </div>

    <div class="row-fluid zc">
        <div class="col-xs-12">
            <?php $__currentLoopData = $major_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $major_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key < 10): ?>
                    <div class="major-info">
                        <div class="major-title zytj">
                            <p class="font29"><?php echo e($majors[$major_grade['major_id']]['name']); ?></p>
                            <p class="font29"><?php echo e($majors[$major_grade['major_id']]['code']); ?></p>
                        </div>
                        <div class="major-title2 font29 color333 zyms">专业描述</div>
                        <div class="major-content font28 color666"><?php echo e($major_details[$major_grade['major_id']]['description']); ?></div>
                        <div class="major-title2 font29 color333 zyms">专业设置目的</div>
                        <div class="major-content font28 color666"><?php echo e($major_details[$major_grade['major_id']]['goal']); ?></div>
                        <div class="major-title2 font29 color333 zyms">主修课程</div>
                        <div class="major-content font28 color666"><?php echo e($major_details[$major_grade['major_id']]['course']); ?></div>
                        <div class="major-title2 font29 color333 zyms">未来就业空间</div>
                        <div class="major-content font28 color666"><?php echo e($major_details[$major_grade['major_id']]['career']); ?></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>



</div>

<div class="row-fluid zc">
    <div class="col-xs-12">
        <div class="footer">
            <div class="jieshu">感谢您的测评与阅读！</div>
            <div class="font34 color333">
                理想的结果一定是从周密的准备开始，现在你已经深刻的认知了自己和适合自己的专业，下一步就应该去寻找这些适合你的专业在哪些学校中开办，他们在学校中的地位如何，然后根据自己的分数去匹配院校。
            </div>
            <div class="jieshu">最后，祝您学业顺利，前程似锦！</div>
        </div>

    </div>
</div>

<div class="nav">
    <!--<div class="nvb" href="#sy">报告导航</div>
    <a class="nvb active" href="#sy">首页</a>
    <a class="nvb" href="#qy">前言</a>
    <a class="nvb" href="#ml">目录</a>-->
    <a class="nvb" href="#zytj">专业推荐</a>
    <a class="nvb" href="#szmx">素质模型</a>
    <a class="nvb" href="#qnfb">潜能分布</a>
    <a class="nvb" href="#zjqn">最佳潜能</a>
    <a class="nvb" href="#deqn">第二潜能</a>
    <a class="nvb" href="#dsqn">第三潜能</a>
    <a class="nvb" href="#grdb">个人短板</a>
    <a class="nvb" href="#zyxq">专业兴趣</a>
    <a class="nvb" href="#zjpp">最佳匹配</a>
    <a class="nvb" href="#wljy">未来就业</a>
    <button class="nvb" id="btn-share">分享报告</button>
    <button class="nvb" id="btn-home">回到首页</button>
</div>
<div class="switcher">
    <img style="width:100%;" src="<?php echo e(URL::asset('images/icon_nav.png')); ?>" >
</div>

<script src="<?php echo e(URL::asset('index.js')); ?>"></script>
</body>
</html>
