<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Http\Requests\WeatherGetByDateRequest;
use App\Http\Requests\WeatherGetHistoryRequest;
use App\Models\History;
use App\Services\WeatherService;
use Illuminate\Database\Eloquent\Collection;
use Sajya\Server\Procedure;

class WeatherProcedure extends Procedure
{
    /**
     * @var string
     */
    public static string $name = 'weather';

    public function getByDate(WeatherGetByDateRequest $request): History
    {
        return (new WeatherService())->getByDate($request);
    }

    public function getHistory(WeatherGetHistoryRequest $request): Collection
    {
        return (new WeatherService())->getHistory($request);
    }
}
