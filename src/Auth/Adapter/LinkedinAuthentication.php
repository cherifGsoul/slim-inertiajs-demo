<?php declare(strict_types=1);
namespace Noesis\Auth\Adapter;

use App\Model\User;
use Laminas\Authentication\Result;
use Illuminate\Database\Eloquent\Collection;
use Laminas\Authentication\Adapter\AdapterInterface;

class LinkedinAuthentication implements AdapterInterface
{
    /**
     * Username
     *
     * @var string
     */
    protected string $username;

    /**
     * Email
     *
     * @var string
     */
    protected string $email;

    /**
     * Instance
     *
     * @var self
     */
    private static ?self $instance = null;

    /**
     * Validate
     *
     * @param string $email
     * 
     * @return Result
     */
    public static function validate(string $email): Result
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance->setEmail($email)->authenticate();
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
     * Set Email
     *
     * @param string $email
     * 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get User from storage
     *
     * @return Collection
     */
    public function getUsersWhere(string $field, mixed $value): Collection
    {
        return User::where($field, $value)->get();
    }

    private function getResultForCount(int $count)
    {
        if ($count === 0) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, $this->email);
        }
        
        return ($count > 1) 
            ? new Result(Result::FAILURE_IDENTITY_AMBIGUOUS, $this->email) 
            : new Result(Result::SUCCESS, $this->email);
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
        $users = $this->getUsersWhere('email', $this->email);

        return $this->getResultForCount($users->count());
    }
}