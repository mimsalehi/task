<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Order
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon $delivery_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read int|null $reports_count
 * @property-read Trip $trip
 * @property-read Vendor $vendor
 * @property-read Collection|DelayReport[] $reports
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The vendor of order
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Delay reports of on order
     *
     * @return HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(DelayReport::class, 'order_id');
    }

    /**
     * The trip of an order
     * @return HasOne
     */
    public function trip(): HasOne
    {
        return $this->hasOne(Trip::class);
    }
}
