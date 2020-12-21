<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Builder $builder;

    public function builder(): Builder
    {
        return $this->builder;
    }

    public function getCollection(array $columns = ['*']): Collection
    {
        return $this->builder->get($columns);
    }

    public function whereId(int $id): void
    {
        $this->builder->where('id', $id);
    }

    public function whereDateAt(\DateTime $date): void
    {
        $this->builder->where('date_at', '=', $date->format('Y-m-d'));
    }
}
