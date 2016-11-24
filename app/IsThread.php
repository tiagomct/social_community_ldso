<?php
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