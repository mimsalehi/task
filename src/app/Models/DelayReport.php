<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DelayReport
 *
 * @property int $id
 * @property int $agent_id
 * @property int $order_id
 * @property int $batch
 * @property int $delay_minutes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Order $order
 * @property-read Agent $agent
 *
 * @package App\Models
 */
class DelayReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Returns the order of report!
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Returns the agent of report!
     * @return BelongsTo
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
