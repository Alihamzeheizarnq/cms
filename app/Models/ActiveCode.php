<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * Class ActiveCode
 * @method  static int generateUniqueCode($request)
 * @method  static bool  validationCode($code , $user)
 *
 */
class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token', 'expired_at'];


    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param $user
     * @return int
     */
    public function ScopeGenerateUniqueCode($query, $user)
    {
        $user->activeCode()->delete();
        $code = mt_rand(100000, 999999);

        $user->activeCode()->create([
            'token' => $code,
            'expired_at' => now()->addMinutes(10)
        ]);

        return $code;


    }


    public function scopeValidationCode($qurey , $code , $user)
    {
        return !! $user->activeCode()->whereToken($code)->where('expired_at' , '>' , now())->first();
    }


}
