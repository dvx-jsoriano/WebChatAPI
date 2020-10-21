<?php

namespace App\Custom;

use Exception;
use Illuminate\Support\Facades\Log;

class WebChat
{
    public $sample;

    /**
     * Class constructor.
     */
    public function __construct($sample)
    {
        $this->sample = $sample;
    }

    /**
     * Function generate session id composed of 16 character starts with letter C.
     */
    public function GenerateSessionID($code)
    {
        try {
            // set the first character from parameter
            if (strlen($code) != 1)
                $value = 'C';
            else
                $value = strtoupper($code);
            // generate 15 random numbers
            for ($i = 0; $i < 15; $i++)
                $value .= mt_rand(0, 9);
            // return the result
            return $value;
        } catch (Exception $ex) {
            Log::debug('generating session id.', $ex->getMessage());
        }
    }
}
