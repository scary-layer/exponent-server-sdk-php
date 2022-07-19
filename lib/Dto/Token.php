<?php

namespace ExponentPhpSDK\Dto;

class Token
{
    /**
     * Expo token to send notification
     */
    private string $token;

    /**
     * Experience id of the token
     */
    private ?string $experienceId;

    /**
     * Token constructor
     */
    public function __construct(string $token, ?string $experienceId = null)
    {
        $this->token = $token;
        $this->experienceId = $experienceId;
    }

    /**
     * Get experience id
     */
    public function getExperienceId(): ?string
    {
        return $this->experienceId;
    }

    /**
     * Get token
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
