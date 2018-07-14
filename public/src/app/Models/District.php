<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Jun 2018 15:42:11 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Encore\Admin\Traits\ModelTree;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class District
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $sort
 * @property int $parent_id
 * 
 * @property \App\Models\District $district
 * @property \Illuminate\Database\Eloquent\Collection $districts
 *
 * @package App\Models
 */
class District extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'parent_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'parent_id'
	];

	use FormOptions;
	use ModelTree;

	public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

    public function district()
	{
		return $this->belongsTo(District::class, 'parent_id');
	}

	public function districts()
	{
		return $this->hasMany(District::class, 'parent_id');
	}

	static public function id2name($id)
    {
        try{
            return District::where('id', $id)->firstOrFail()->name;
        }
        catch(\Exception $e) {

        }
        finally {
            return '';
        }

    }

    public static function selectOptions()
    {
        $options = (new static())->buildSelectOptions();

        return collect($options)->prepend('中国', 0)->all();
    }


}
