<?php declare(strict_types=1);
namespace App\Model;

class User extends Model
{
    // /**
    //  * __construct
    //  *
    //  * @param int $id
    //  */
    // public function __construct(
    //     public int $id,
    //     public string $username,
    //     public string $email,
    //     public string $first_name,
    //     public string $last_name,
    //     public string $full_name,
    //     public string $created_at,
    //     public string $updated_at
    // )
    // {
    //     // PHP 8 :)
    // }

    /**
     * __construct
     *
     * @param string $param
     */
    public function __construct()
    {
        $this->table = 'users';

        parent::__construct();
    }
    
}