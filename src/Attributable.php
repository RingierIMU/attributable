<?php

namespace RingierIMU\Attributable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Attributable
{
    public array $attr = [];

    public static function bootAttributable(): void
    {
        static::saved(function (Model $model) {
            $method = 'update';

            if (!$model->rimuAttributes()->withTrashed()->first()) {
                $method = 'create';
            }

            $model
                ->rimuAttributes()
                ->$method([
                    'attributes' => json_encode($model->attr),
                ]);
        });

        static::updated(function (Model $model) {
            $model
                ->rimuAttributes()
                ->update([
                    'attributes' => json_encode($model->attr),
                ]);
        });

        static::retrieved(function (Model $model) {
            $model->attr = $model->rimuAttributes?->attributes ?? [];
        });

        static::deleting(function (Model $model) {
            $model
                ->rimuAttributes()
                ->delete();
        });

        if (method_exists(static::class, 'trashed')) {
            static::restoring(function (Model $model) {
                $model
                    ->rimuAttributes()
                    ->restore();
            });

            static::forceDeleting(function (Model $model) {
                $model
                    ->rimuAttributes()
                    ->forceDelete();
            });
        }
    }

    public function rimuAttributes(): MorphOne
    {
        return $this->morphOne(RimuAttribute::class, 'attributable');
    }
}
