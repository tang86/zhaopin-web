<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>测评了</title>

    <!-- Fonts -->


    <!-- Styles -->
    <style>

    </style>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '/api/questions',
                type: 'POST',

                success: function (questions) {
                    console.log(questions)
                    $.each(questions.data, function(i,qestion){
                        console.log(qestion)
                        if (qestion.category_id == 1) {
                            make_a_question(qestion);
                        }else if (qestion.category_id == 2) {
                            make_b_question(qestion);
                        } else if (qestion.category_id == 3) {
                            make_c_question(qestion);
                        }
                    });


                }
            });

        });

        function make_a_question(question) {
            var html = '<p>\n' +
                '                <h4 >'+question.title+'</h4>\n' +
                '            <input type="radio" name="cat_a['+question.id+']" value="1" checked="checked"> 同意\n' +
                '            <input type="radio" name="cat_a['+question.id+']" value="0"> 不同意\n' +
                '\n' +
                '            </p>';
            $('#cat_a').append(html);

        }

        function make_b_question(question) {
            var html = '<p>\n' +
                '                <h4 >'+question.title+question.sub_questions[0].title+' '+question.sub_questions[1].title+'</h4>\n' +
                '            <input type="radio" name="cat_b['+question.id+']" value="1" checked="checked"> 非常贴切描述我\n' +
                '            <input type="radio" name="cat_b['+question.id+']" value="2"> 一般\n' +
                '            <input type="radio" name="cat_b['+question.id+']" value="3"> 中立\n' +
                '            <input type="radio" name="cat_b['+question.id+']" value="4"> 一般\n' +
                '            <input type="radio" name="cat_b['+question.id+']" value="5"> 非常贴切描述我\n' +
                '\n' +
                '            </p>';
            $('#cat_b').append(html);

        }
        function make_c_question(question) {
            var html = '<p>\n' +
                '                <h4 >'+question.title+'</h4>\n' +
                '            <input type="radio" name="cat_c['+question.id+']" value="1" checked="checked"> 同意\n' +
                '            <input type="radio" name="cat_c['+question.id+']" value="0"> 不同意\n' +
                '\n' +
                '            </p>';
            $('#cat_c').append(html);

        }

    </script>
</head>
<body>
<div class="flex-center position-ref full-height">

    <form action="/evaluate" method="POST">
        <?php echo e(csrf_field()); ?>

    <div class="content">

        <div id="cat_a">
            <h1>A类</h1>


        </div>
        <div id="cat_b">
            <h1>B类</h1>
            <p>
                <h4 >问题一</h4>
            <input type="radio" name="" > 非常贴切描述我
            <input type="radio" name="" > 一般
            <input type="radio" name="" > 中立
            <input type="radio" name="" > 一般
            <input type="radio" name="" > 非常贴切描述我


            </p>

        </div>
        <div id="cat_c">
            <h1>C类</h1>
            <p>
                <h4 >问题一</h4>
            <input type="radio" name="" > A
            <input type="radio" name="" > B

            </p>

        </div>

        <input type="submit" value="提交">
    </div>
    </form>
</div>
</body>
</html>
