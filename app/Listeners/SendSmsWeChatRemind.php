<?php

namespace App\Listeners;

use App\Events\MessageRemind;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Log;

class SendSmsWeChatRemind
{
    private $app = null;

    public function __construct()
    {
        $options = config('wechat.official_account.default');

        $this->app = Factory::officialAccount($options);
    }

    /**
     * Handle the event.
     *
     * @param  MessageRemind $event
     * @return void
     */
    public function handle(MessageRemind $event)
    {
        Log::info('异步发送微信给' . $event->data['name']);
        if (config('admin.new_user_num') >= $event->data['num']) {
            $str = '还差 ' . (config('admin.new_user_num') - $event->data['num']) . ' 个邀请，即可获得测评卡';
        } else {
            $str = '截止目前您已经邀请 ' . $event->data['num'] . ' 个';
        }
        $res = $this->app->template_message->send([
            'touser' => $event->user,
            'template_id' => $event->template_id,
            'data' => [
                'first' => '邀请新人关注成功通知',
                'keyword1' => $event->data['name'],
                'keyword2' => $event->data['num'] . '/' . config('admin.new_user_num'),
                'keyword3' => $str,
                'remark' => '北京基石测评',
            ],
        ]);
        // todo 如果够了指标，发送通知
        if ($event->data['num'] == config('admin.new_user_num')) {
            Log::info(23456);
            $res = $this->app->template_message->send([
                'touser' => $event->user,
                'template_id' => 'AZ_z1HIHmkWgviA2JKiZwxWtfzy-FrUSOhGnCsxKQmw',
                'data' => [
                    'first' => $event->data['num'] . '恭喜您完成纳新任务',
                    'keyword1' => '邀请 ' . config('admin.new_user_num') . ' 个新用户获测评卡',
                    'keyword2' => '完成纳新任务，获得测评卡，卡号：123456',
                    'keyword3' => date('Y-m-d', time()),
                    'remark' => '北京基石测评',
                ],
            ]);
        }
        Log::warning($event->user);
        Log::warning($res);
    }
}
