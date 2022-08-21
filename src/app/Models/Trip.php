<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Trip
 *
 * @property int $id
 * @property int $order_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Order $order
 *
 * @package App\Models
 */
class Trip extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The order of a trip
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
