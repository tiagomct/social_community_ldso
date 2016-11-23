<?php
/**
 * Created by PhpStorm.
 * User: Tavares
 * Date: 23/11/2016
 * Time: 22:29
 */

namespace App;


use Illuminate\Database\Eloquent\Relations\HasMany;

interface IsThread
{

    /**
     * @return HasMany
     */
    public function comments();

    /**
     * @return HasMany
     */
    public function likes();

    /**
     * @return HasMany
     */
    public function reports();

    /**
     * @return HasMany
     */
    public function follows();
}