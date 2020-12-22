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
        $response = $this->weatherClient->client()->send(
            $request = $this->weatherClient->client()->request(1, 'weather@getByDate', ['date' => $date])
        );

        if (! isset($response)) {
            throw new \Exception('Response is null');
        }

        $responseDecoded = $this->decodeResponse($response);
        $this->checkErrors($responseDecoded);

        return $this->toModel($responseDecoded->result);
    }

    /**
     * @return HistoryDto[]
     * @throws \Exception
     * @throws \JsonException
     */
    public function getHistory(): array
    {
        $response = $this->weatherClient->client()->send(
            $this->weatherClient->client()->request(1, 'weather@getHistory', ['lastDays' => 30])
        );

        if (! isset($response)) {
            throw new \Exception('Response is null');
        }

        $responseDecoded = $this->decodeResponse($response);
        $this->checkErrors($responseDecoded);

        return $this->toModelCollection($responseDecoded->result);
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
