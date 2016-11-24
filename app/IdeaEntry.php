<?php

namespace App;

use App\Traits\Pollable;

class IdeaEntry extends Thread implements isPoll
{
    use Pollable;
}
