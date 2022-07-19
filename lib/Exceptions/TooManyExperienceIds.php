<?php

namespace ExponentPhpSDK\Exceptions;

use Exception;

class TooManyExperienceIds extends Exception
{
    /**
     * Exception message
     *
     * @var string
     */
    protected $message;

    /**
     * Details from body of the response
     *
     * @var array
     */
    private array $details;

    /**
     * Exception constructor
     */
    public function __construct(string $message, array $details = [])
    {
        $this->message = $message;
        $this->details = $details;
    }

    /**
     * Get details
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
