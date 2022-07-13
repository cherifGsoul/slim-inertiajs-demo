<?php declare(strict_types=1);
namespace Noesis\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class TwitterResourceOwner implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    protected $response;

    /**
     * Domain
     *
     * @var string
     */
    protected $domain;

    /**
     * @param \stdClass $response
     */
    public function __construct(\stdClass $response)
    {
        $response = $response->data[0] ?? [];
        $this->response = (array) $response ?? [];
    }

    /**
     * Get ID
     *
     * @return string|int
     */
    public function getId(): string|int
    {
        return $this->getResponseValue('id');
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getResponseValue('name');
    }

    /**
     * Get resource owner nickname
     *
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->getResponseValue('login');
    }

    /**
     * Get Username
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->getResponseValue('username');
    }

    /**
     * Get Email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getResponseValue('email');
    }

    /**
     * Get user data as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->response;
    }

    /**
     * Get Response Value
     *
     * @param string $key
     * 
     * @return mixed
     */
    private function getResponseValue(string $key): mixed
    {
        return $this->response[$key] ?? null;
    }

    /**
     * Get resource owner url
     *
     * @return string
     */
    public function getUrl()
    {
        return trim($this->domain.'/'.$this->getNickname()) ?: null;
    }

    /**
     * Set resource owner domain
     *
     * @param  string $domain
     *
     * @return ResourceOwnerInterface
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }
}
