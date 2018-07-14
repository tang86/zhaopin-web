<?php

namespace App;

use App\Models\MemberHasSubject;
use App\Models\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // 不允许编辑字段
    protected $guarded = [];

    /**
     * 说明: 我送出的礼物（测评卡）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author 郭庆
     */
    public function sendOrders()
    {
        return $this->belongsToMany(
            Order::class,
            'gifts',
            'send_user',
            'order_id'
        );
    }


    /**
     * 说明: 我收到的礼物（测评卡）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author 郭庆
     */
    public function receiveOrders()
    {
        return $this->belongsToMany(
            Order::class,
            'gifts',
            'receive_user',
            'order_id'
        );
    }

    public function subjects()
    {
        return $this->hasMany(MemberHasSubject::class,'member_id','id');
    }
}
