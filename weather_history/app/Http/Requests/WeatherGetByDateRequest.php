<?php

namespace App\Http\Requests;

class WeatherGetByDateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'date' => 'required|date',
        ];
    }

    public function getDate(): \DateTime
    {
        return new \DateTime($this->getStringValue('date'));
    }
}
