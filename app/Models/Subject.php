<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Apr 2018 09:52:26 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Subject
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Subject extends Eloquent
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;

    static public $STATUS = [
        1 => '开启',
        0 => '禁用'
    ];
	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark'
	];

    static public function selectOptions()
    {
        $options = [];
        $all = static::all()->toArray();
        if (!empty($all)) {
            foreach ($all as $row) {
                $options[$row['id']] = $row['name'];
            }
        }
        return $options;
    }

    static public function getName($subject_id)
    {
        $name = '';
        $subject = static::find($subject_id);
        if ($subject) {
            $name = $subject['name'];
        }
        return $name;

    }
}
