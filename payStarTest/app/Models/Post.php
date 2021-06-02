<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    protected $casts = [
        'list' => 'array'
    ];

    public function setMetaAttribute($value)
    {
        $list = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $list[] = $array_item;
            }
        }

        $this->attributes['list'] = json_encode($list);
    }
}
