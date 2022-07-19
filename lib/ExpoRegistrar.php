<?php

namespace ExponentPhpSDK;

use ExponentPhpSDK\Exceptions\ExpoRegistrarException;

class ExpoRegistrar
{
    /**
     * Repository that manages the storage and retrieval
     *
     * @var ExpoRepository
     */
    private $repository;

    /**
     * ExpoRegistrar constructor.
     *
     * @param ExpoRepository $repository
     */
    public function __construct(ExpoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Registers the given token for the given interest
     *
     * @param $interest
     * @param $token
     *
     * @throws ExpoRegistrarException
     *
     * @return string
     */
    public function registerInterest(
        $interest,
        $token,
        $experienceId = null
    ) {
        if (!$this->isValidExpoPushToken($token)) {
            throw ExpoRegistrarException::invalidToken();
        }

        $stored = $this->repository->store($interest, $token, $experienceId);

        if (!$stored) {
            throw ExpoRegistrarException::couldNotRegisterInterest();
        }

        return $token;
    }

    /**
     * Removes token of a given interest
     *
     * @param $interest
     * @param $token
     *
     * @throws ExpoRegistrarException
     *
     * @return bool
     */
    public function removeInterest($interest, $token = null)
    {
        if (!$this->repository->forget($interest, $token)) {
            throw ExpoRegistrarException::couldNotRemoveInterest();
        }

        return true;
    }

    /**
     * Gets the tokens of the interests
     *
     * @throws ExpoRegistrarException
     *
     * @return array<Token>
     */
    public function getInterests(array $interests): array
    {
        $tokens = [];

        foreach ($interests as $interest) {
            $tokens = [...$tokens, ...$this->repository->retrieve($interest)];
        }

        if (empty($tokens)) {
            throw ExpoRegistrarException::emptyInterests();
        }

        return $tokens;
    }

    /**
     * Determines if a token is a valid Expo push token
     *
     * @param string $token
     *
     * @return bool
     */
    private function isValidExpoPushToken(string $token)
    {
        return  substr($token, 0, 18) ===  "ExponentPushToken[" && substr($token, -1) === ']';
    }
}
