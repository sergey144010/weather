<?php

namespace App\Services;

use Illuminate\Http\Request;

class IndexServiceController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): array
    {
        $error = null;
        $history = null;
        $collection = null;

        /** @var WeatherService $weatherService */
        $weatherService = app(WeatherService::class);

        if ($this->request->isMethod('POST')) {
            // skip validation, leave it for the server
            $date = $this->request->input('date');
            try {
                if (isset($date)) {
                    $history = $weatherService->getByDate($date);
                } else {
                    $error = 'Date is empty';
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
            }
        }

        try {
            $collection = $weatherService->getHistory();
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
        }

        return [
            'history' => $history,
            'collection' => $collection,
            'error' => $error,
        ];
    }
}
