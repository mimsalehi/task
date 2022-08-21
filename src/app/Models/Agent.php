<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Agent
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|DelayReport[] $reports
 *
 * @package App\Models
 */
class Agent extends Model
{
    use HasFactory;

    /**
     * Delay Reports assigned to the Agent
     */
    public function reports(): HasMany
    {
        return $this->hasMany(DelayReport::class);
    }
}
