<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property float $balance
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
class User extends Model
{
    protected $table = 'users';

    /**
     * $fillable array
     */
    protected $fillable = [
        'name',
        'balance',
    ];




}
