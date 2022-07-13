<?php declare(strict_types=1);
namespace Noesis\Support;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class UserFactory
{
    public function __construct(
        private string $username,
        private string $email,
        private string $first_name,
        private string $last_name,
        private string $full_name
    )
    {
        // PHP 8 :)
    }

    /**
     * Map Linkedin Resourcee Owner
     *
     * @param ResourceOwnerInterface $ResourceOwner
     * 
     * @return array
     */
    private static function mapLinkedinResourceOwner(ResourceOwnerInterface $ResourceOwner): array
    {
        return [
            'id'            => $ResourceOwner->getId(),
            'username'      => "{$ResourceOwner->getFirstName()} {$ResourceOwner->getLastName()}",
            'email'         => $ResourceOwner->getEmail(),
            'first_name'    => $ResourceOwner->getFirstName(),
            'last_name'     => $ResourceOwner->getLastName(),
            'full_name'     =>"{$ResourceOwner->getFirstName()} {$ResourceOwner->getLastName()}"
        ];
    }

    /**
     * Map Github Resource Owner
     *
     * @param ResourceOwnerInterface $ResourceOwner
     * 
     * @return array
     */
    private static function mapGithubResourcecOwner(ResourceOwnerInterface $ResourceOwner): array
    {
        $names = explode(' ', $ResourceOwner->getName());
        return [
            'id'            => $ResourceOwner->getId(),
            'username'      => $ResourceOwner->getNickName(),
            'email'         => $ResourceOwner->getEmail(),
            'first_name'    => $names[0],
            'last_name'     => $names[1],
            'full_name'     => $ResourceOwner->getName()
        ];
    }

    /**
     * Map Twitter Resource Owner
     *
     * @param ResourceOwnerInterface $ResourceOwner
     * 
     * @return array
     */
    private static function mapTwitterResourceOwner(ResourceOwnerInterface $ResourceOwner): array
    {
        $names = explode(' ', $ResourceOwner->getName());
        return [
            'id'            => $ResourceOwner->getId(),
            'username'      => $ResourceOwner->getUsername(),
            'email'         => $ResourceOwner->getEmail(),
            'first_name'    => $names[0],
            'last_name'     => $names[1],
            'full_name'     => $ResourceOwner->getName()
        ];
    }

    public static function fromOauthResourceOwner(ResourceOwnerInterface $ResourceOwner, string $provider_name): array
    {
        return match ($provider_name) {
            'linkedin' => self::mapLinkedinResourceOwner($ResourceOwner),
            'twitter' => self::mapTwitterResourceOwner($ResourceOwner),
            default => self::mapGithubResourcecOwner($ResourceOwner),
        };
    }
}