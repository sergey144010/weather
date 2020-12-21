<?php

namespace App\Repositories;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HistoryRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->builder = History::query();
    }

    public function findById(int $id): History
    {
        $this->whereId($id);

        $model = $this->getCollection()->first();

        if (! $model instanceof History) {
            throw new ModelNotFoundException('Model ' . self::class . ' not found');
        }

        return $model;
    }

    public function findByDate(\DateTime $date): History
    {
        $this->whereDateAt($date);

        $model = $this->getCollection()->first();

        if (! $model instanceof History) {
            throw new ModelNotFoundException('Model ' . self::class . ' not found');
        }

        return $model;
    }

    public function findCollectionByLastDay(\DateTimeInterface $date): Collection
    {
        $this->builder->where('date_at', '>=', $date->format('Y-m-d'));

        return $this->getCollection();
    }
}
