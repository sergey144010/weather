<?php

namespace App\Services;

use App\Http\Requests\WeatherGetByDateRequest;
use App\Http\Requests\WeatherGetHistoryRequest;
use App\Http\Response\RespondTrait;
use App\Models\History;
use App\Repositories\HistoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WeatherService
{
    use RespondTrait;

    public function getByDate(WeatherGetByDateRequest $request): History
    {
        if (! $request->validate()) {
            throw $this->respondErrors($request->errors());
        }

        try {
            $history = (new HistoryRepository())->findByDate($request->getDate());
        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $this->respondError('History for current date not found');
        }

        return $history;
    }

    public function getHistory(WeatherGetHistoryRequest $request): Collection
    {
        if (! $request->validate()) {
            throw $this->respondErrors($request->errors());
        }

        $period = new \DatePeriod(
            (new \DateTime())->sub(\DateInterval::createFromDateString($request->getLastDays() . ' day')),
            new \DateInterval('P1D'),
            new \DateTime(),
        );

        return (new HistoryRepository())->findCollectionByLastDay($period->start);
    }
}
