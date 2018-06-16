<?php
/**
 * Created by PhpStorm.
 * User: zhaochang
 * Date: 18-5-3
 * Time: 下午8:17
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class Common extends Eloquent
{
    static public function getAllIndexById()
    {
        $items = [];
        $models = static::all();
        foreach ($models as $model) {
            $items[$model->id] = $model->toArray();
        }
        return $items;

    }

    static public function getAllIndexByName()
    {
        $items = [];
        $models = static::all();
        foreach ($models as $model) {
            $items[$model->name] = $model->toArray();
        }
        return $items;

    }

    static public function indexBy($models, $field)
    {

        $items = [];
        foreach ($models as $key => $model) {

            $items[$model->$field] = $model->toArray();
            $items[$model->$field]['sort'] = $key + 1;
        }
        return $items;
    }

    static public function modelIndexBy($models, $field)
    {

        $items = [];
        foreach ($models as $key => $model) {

            $items[$model->$field] = $model;

        }
        return $items;
    }


}