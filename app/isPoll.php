<?php
/**
 * Created by PhpStorm.
 * User: Tavares
 * Date: 23/11/2016
 * Time: 22:32
 */

namespace App;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface isPoll
{
    /**
     * @return HasMany
     */
    public function pollAnswers();
}