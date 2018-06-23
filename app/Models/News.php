<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 16 Jun 2018 17:08:38 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class News
 * 
 * @property int $id
 * @property string $title
 * @property string $brief
 * @property string $banner
 * @property string $keyword
 * @property string $content
 * @property int $like_num
 * @property int $read_num
 * @property int $sort
 * @property string $banner_status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class News extends Eloquent
{
	protected $casts = [
		'like_num' => 'int',
		'read_num' => 'int',
		'init_read_num' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'title',
		'brief',
		'banner',
		'keyword',
		'content',
		'like_num',
		'read_num',
		'init_read_num',
		'sort',
		'banner_status'
	];

    static public function formatHits($hits)
    {
        $show = '';
        if ($hits < 1000) {
            $show = $hits;
        } elseif ($hits < 10000) {
            $show = floor($hits/1000).'k+';
        } else {
            $show = floor($hits/10000).'w+';
        }

        return $show;
    }
}
