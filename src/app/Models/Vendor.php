<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Vendor
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read int $reports_count
 * @property-read int $sum_delay_minutes
 * @property-read Collection|Order[] $orders
 *
 * @package App\Models
 */
class Vendor extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
