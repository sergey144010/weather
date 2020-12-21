<?php

namespace Database\Seeders;

use App\Models\History;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $period = new \DatePeriod(
            (new \DateTime())->sub(new \DateInterval('P6M')),
            new \DateInterval('P1D'),
            new \DateTime(),
        );

        array_map(
            function ($item) {
                $model = new History();
                $model->temp = (mt_rand() / mt_getrandmax()) + mt_rand(-40, 40);
                $model->date_at = $item;
                $model->save();
                },
            iterator_to_array($period)
        );
    }
}
