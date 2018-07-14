<?php

use Faker\Generator as Faker;

$faker = \Faker\Factory::create('zh_CN');

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title' => '如何增加自己的技能?',
        'brief' => '很多人不明白很多公司在面试的时候为什么不要简历，今天我们就这个问题进行一个探讨。',
        'banner' => 'news/banner.png',
        'content' => '<p>一个人能力的高低，直接影响其成长与进步，对人生来说尤为重要。如何提高个人综合能力，是近年来人们一直关注的问题。</p>
    <p>能力是直接影响活动效率，并使活动顺利完成的个性心理特征。能力有一般能力和特殊能力之分：一般能力，是指观察、记忆、思维、想象等能力,通常也叫智力。它是人们完成任何活动所不可缺少的,是能力中最主要有是一般的部分；特殊能力，是指人们从事特殊职业或专业需要的能力。例如音乐中所需要的听觉表象能力或是人们从事任何一项专业性活动既需要一般能力，也需要特殊能力。二者的发展也是相互促进的。</p>
    <p>无论一个人的一般能力和特殊能力，虽然与大脑的智能有一定关联，但关键在于大量的知识积累和付诸实践中的反复训练，即，积累和实践。因此，提高个人能力主要应该加强以下几个方面的训练。</p>',
        'like_num' => $faker->numberBetween(),
        'read_num' => $faker->numberBetween(),
        'sort' => $faker->numberBetween(),
    ];
});
