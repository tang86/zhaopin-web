<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Apr 2018 09:52:26 +0800.
 */

namespace App\Models;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $subject_id
 * @property bool $is_multi
 * @property int $sort
 *
 * @package App\Models
 */
class Category extends Common
{
    const MULTI = 1;
    const SINGLE = 0;

    static public $IS_MULTI = [
        1 => '有',
        0 => '无'
    ];

	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'subject_id' => 'int',
		'is_multi' => 'bool',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'subject_id',
		'is_multi',
		'sort'
	];

    static public function selectOptions()
    {
        $options = [];
        $all = static::all();
        if ($all) {
            $all = $all->toArray();
            foreach ($all as $row) {
                $options[$row['id']] = $row['name'];
            }
        }
        return $options;
    }
}
