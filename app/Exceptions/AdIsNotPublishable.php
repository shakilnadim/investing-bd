<?php

namespace App\Exceptions;

use Exception;

class AdIsNotPublishable extends Exception
{
    protected $message = 'Advertisement is not publishable';

}
