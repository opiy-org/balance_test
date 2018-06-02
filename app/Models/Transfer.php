<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transfer
 *
 * @mixin Eloquent
 * @property-read \App\Models\User $from_user
 * @property-read \App\Models\User $to_user
 * @property int $id
 * @property int|null $from_user_id
 * @property int|null $to_user_id
 * @property float $amount
 * @property int $status
 * @property string|null $error_msg
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereErrorMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transer whereUpdatedAt($value)
 */
class Transer extends Model
{
    protected $table = 'transfers';

    /**
     * $fillable array
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'amount',
        'status',
        'error_msg'
    ];


    /**
     * From
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from_user()
    {
        return $this->belongsTo(
            User::class,
            'from_user_id',
            'id');
    }


    /**
     * To
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user()
    {
        return $this->belongsTo(
            User::class,
            'to_user_id',
            'id');
    }


}
