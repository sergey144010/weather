<?php

namespace App\Models;

/**
 * Class History
 * @package App\Models
 *
 * @property int $id
 * @property float $temp
 * @property \DateTime $date_at
 */
class History extends AbstractModel
{
    protected $table = 'history';
    public $timestamps = false;
}
