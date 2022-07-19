<?php

namespace ExponentPhpSDK;

use ExponentPhpSDK\Dto\Token;

interface ExpoRepository
{
    /**
     * Stores an Expo token with a given identifier
     */
    public function store(
        string $key,
        string $value,
        ?string $experienceId = null
    ): bool;

    /**
     * Retrieve an Expo token with a given identifier
     *
     * @return array<Token>|null
     */
    public function retrieve(string $key): array;

    /**
     * Removes an Expo token with a given identifier
     */
    public function forget(string $key, string $value = null): bool;
}
