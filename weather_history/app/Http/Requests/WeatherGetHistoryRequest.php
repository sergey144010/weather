<?php

namespace App\Http\Requests;

class WeatherGetHistoryRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'lastDays' => 'required|int',
        ];
    }

    public function getLastDays(): int
    {
        return $this->getIntValue('lastDays');
    }
}
