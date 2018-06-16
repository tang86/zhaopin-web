<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    static public function fetchTypesByCategoryId($category_id)
    {
        $types = [];

        switch ($category_id) {
            case 1:
                $types = Interest::all()->toArray();
                break;

            case 2:
                $types = Ability::all()->toArray();
                break;

            case 3:
                $types = Personality::all()->toArray();
                break;

        }

        return $types;
    }

    static public function getOptionsByCategoryId($category_id)
    {
        $options = [
            [
                'id' => 0,
                'text' => '请选择'
            ]
        ];

        $types = static::fetchTypesByCategoryId($category_id);
        if (!empty($types)) {
            foreach ($types as $type) {
                $options[] = [
                    'id' => $type['id'],
                    'text' => $type['name']
                ];
            }
        }

        return $options;
    }

    static public function getOptionsForForm($category_id)
    {
        $options = [
            0 => '请选择'
        ];

        $types = static::fetchTypesByCategoryId($category_id);
        if (!empty($types)) {
            foreach ($types as $type) {
                $options[$type['id']] = $type['name'];
            }
        }

        return $options;
    }
}
