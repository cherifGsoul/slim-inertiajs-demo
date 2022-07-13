<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'username' => 'lukewatts',
                'email' => 'watts.luke@yahoo.com',
                'first_name' => 'Luke',
                'last_name' => 'Watts',
                'full_name' => 'Luke Watts',
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ]
        ];

        $user = $this->table('users');
        $user->insert($data)->saveData();
    }
}
