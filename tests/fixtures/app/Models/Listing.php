<?php

namespace Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RingierIMU\Attributable\Attributable;

class Listing extends Model
{
    use Attributable;

    protected $fillable = [
        'title',
    ];
}
