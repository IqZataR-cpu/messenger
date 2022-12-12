<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Collection::macro('loadUsingLimit', function ($relations): Collection {
            /** @var Collection $collection */
            $collection = $this;
            return MacroServiceProvider::loadUsingLimit($collection, is_string($relations) ? func_get_args() : $relations);
        });
    }

    /**
     * @param  Collection $collection
     * @param  array      $relations
     * @return Collection
     */
    public static function loadUsingLimit(Collection $collection, array $relations): Collection
    {
        foreach ($relations as $name => $constraints) {

            if (is_int($name)) {
                $name = $constraints;

                if (Str::contains($name, ':')) {
                    $name = explode(':', 'name', 2)[0];
                    $constraints = function (Relation $query) use ($name) {
                        $query->select(explode(',', explode(':', $name, 3)[1]));
                    };
                } else {
                    $constraints = function () {};
                }
            }

            /** @var Relation $relation */
            $relation = $collection
                ->map(function (Model $model) use ($name) {
                    return $model->{$name}();
                })
                ->each(function (Relation $relation) use ($constraints) {
                    $constraints($relation);
                })
                ->reduce(function (?Relation $carry, Relation $query) {
                    return $carry ? $carry->unionAll($query) : $query;
                });

            $relation->match(
                $relation->initRelation($collection->all(), $name),
                $relation->get(), $name
            );
        }

        return $collection;
    }
}
