<?php
/**
 * Created by PhpStorm.
 * User: alihamzehei
 * Date: 2/26/2021
 * Time: 9:16 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeValueProduct extends Pivot
{
    public function value()
    {
        return $this->belongsTo(AttributeValue::class , 'value_id' , 'id');
    }
}
