<?php

namespace App\Services;

use App\Models\HistoryDto;
use Psr\Http\Message\ResponseInterface;

class WeatherService
{
    private WeatherClient $weatherClient;

    public function __construct(WeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * @param string $date
     * @return HistoryDto
     * @throws \Exception
     * @throws \JsonException
     */
    public function getByDate(string $date): HistoryDto
    {
        $response = $this->decodeResponse(
            $this->weatherClient->client()->send(
                $this->weatherClient->client()->request(1, 'weather@getByDate', ['date' => $date])
            )
        );
        $this->checkErrors($response);

        return $this->toModel($response->result);
    }

    /**
     * @return HistoryDto[]
     * @throws \Exception
     * @throws \JsonException
     */
    public function getHistory(): array
    {
        $response = $this->decodeResponse(
            $this->weatherClient->client()->send(
                $this->weatherClient->client()->request(1, 'weather@getHistory', ['lastDays' => 30])
            )
        );
        $this->checkErrors($response);

        return $this->toModelCollection($response->result);
    }

    private function checkErrors(\stdClass $response): void
    {
        if (isset($response->error)) {
            throw new \Exception($response->error->message);
        }
    }

    private function decodeResponse(ResponseInterface $response): \stdClass
    {
        return json_decode(
            $response->getBody()->getContents(),
            false,
            512,
            JSON_THROW_ON_ERROR
        );
    }

    /**
     * @return HistoryDto[]
     */
    private function toModelCollection(array $inCollection): array
    {
        $collection = [];
        foreach ($inCollection as $item) {
            $collection[] = $this->toModel($item);
        }

        return $collection;
    }

    private function toModel(\stdClass $inModel): HistoryDto
    {
        $model = new HistoryDto();
        $model->id = $inModel->id;
        $model->temp = $inModel->temp;
        $model->date = $inModel->date_at;

        return $model;
    }
}
