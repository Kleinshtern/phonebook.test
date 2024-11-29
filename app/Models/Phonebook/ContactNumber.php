<?php

namespace App\Models\Phonebook;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ContactNumber
 *
 * @package ContactNumber
 *
 * @property-read int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $phone_type
 * @property string $phone
 * @property string $avatar
 * @property boolean $is_favorite
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class ContactNumber extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        'full_name'
    ];

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date'
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . " " . $this->last_name,
        );
    }

    public function scopeFavorite(Builder $query): void
    {
        $query->where('is_favorite', '=', true);
    }

    public function scopeDefault(Builder $query): void
    {
        $query->where('is_favorite', '=', false);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
