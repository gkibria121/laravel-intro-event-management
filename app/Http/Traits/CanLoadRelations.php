<?php

declare(strict_types=1);


namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

trait CanLoadRelations
{

    public function loadRelations(Builder|Model|HasMany  $for, ?array $allowedRelations = null): Builder|Model
    {


        $relations = $this->getRequestedRelations();
        if (empty($relations))
            return $for;

        $filteredRelations = $this->getValidRelations($relations, $allowedRelations);


        return $for instanceof Model ? $for->load(...$filteredRelations) : $for->with(...$filteredRelations);
    }

    public function getRequestedRelations(): array
    {
        $includes = request()->get('include', '');
        $relations  = explode(',', $includes);
        return array_map(function ($relatiion) {
            return trim($relatiion);
        }, $relations);
    }
    public function getValidRelations(array $relations, array|null $allowedRelations): array
    {

        return   array_filter($relations, function ($relation) use ($allowedRelations) {
            return in_array($relation, $allowedRelations ?? $this->allowedRelations ?? []);
        });
    }
}
