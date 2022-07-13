<?php declare(strict_types=1);
namespace Noesis\Auth\Adapter;

use App\Model\User;
use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Authentication\Result;

class TwitterAuthentication implements AdapterInterface
{
    /**
     * Username
     *
     * @var string
     */
    protected string $username;

    /**
     * Instance
     *
     * @var self
     */
    private static ?self $instance = null;

    /**
     * Validate
     *
     * @param string $username
     * 
     * @return Result
     */
    public static function validate(string $username): Result
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance->setUserName($username)->authenticate();
    }

    /**
     * Set Username
     *
     * @param string $username
     * 
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get User from storage
     *
     * @return array
     */
    public function getUsersWhere(string $field, mixed $value): array
    {
        return User::where([$field => $value]);
    }

    private function getResultForCount(int $count)
    {
        if ($count === 0) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, $this->username);
        }
        
        return ($count > 1) 
            ? new Result(Result::FAILURE_IDENTITY_AMBIGUOUS, $this->username) 
            : new Result(Result::SUCCESS, $this->username);
    }
    
    /**
     * Performs an authentication attempt
     *
     * @return \Laminas\Authentication\Result
     *  
     * @throws \Laminas\Authentication\Adapter\Exception\ExceptionInterface 
     *         If authentication cannot be performed
     */
    public function authenticate()
    {
        $users = $this->getUsersWhere('username', $this->username);

        return $this->getResultForCount(count($users));
    }
}