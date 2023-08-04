<?php

namespace RingierIMU\Attributable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\RimuAttribute
 *
 * @property-read Model|\Eloquent $attributable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RimuAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RimuAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RimuAttribute query()
 *
 * @mixin \Eloquent
 */
class RimuAttribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'attributable_type',
        'attributable_id',
        'attributes',
        'created_at',
        'updated_at',
    ];

    public function getTable()
    {
        return config('rimu-attributable.table');
    }

    public function attributable(): MorphTo
    {
        return $this->morphTo();
    }
}
