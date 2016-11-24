<?php
namespace App;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface isPoll
{
    /**
     * @return HasMany
     */
    public function pollAnswers();
}