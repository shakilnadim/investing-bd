<?php

namespace App\Exceptions;

use Exception;

class InvalidImageDimensionException extends Exception
{
    protected $message = 'Invalid Image Dimensions';
}
