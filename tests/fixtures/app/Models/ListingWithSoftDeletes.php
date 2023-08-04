<?php

namespace Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RingierIMU\Attributable\Attributable;

class ListingWithSoftDeletes extends Model
{
    use Attributable;
    use SoftDeletes;

    protected $table = 'listings';

    protected $fillable = [
        'title',
    ];
}
