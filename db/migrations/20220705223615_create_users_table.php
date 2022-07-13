<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

use Illuminate\Database\Capsule\Manager as Capsule;

final class CreateUsersTable extends AbstractMigration
{
    private function setupConnection()
    {
        $capsule = new Capsule;
        $config = require_once dirname(dirname(__DIR__)) . '/server/config/app.php';
        $capsule->addConnection([
            'driver' => $config['db']['connection'],
            'database' => $config['db']['database'],
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->setupConnection();

        Capsule::schema()->create('users', function($table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('full_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
        // $table = $this->table('users', ['signed' => false]);
        // $table
        //     ->addColumn('username', 'string')
        //     ->addColumn('email', 'string')
        //     ->addColumn('full_name', 'string')
        //     ->addColumn('first_name', 'string')
        //     ->addColumn('last_name', 'string')
        //     ->addTimestamps()
        //     ->addIndex('username', ['unique' => true])
        //     ->addIndex('email', ['unique' => true])
        //     ->create();
    }

    public function down(): void
    {
        $this->setupConnection();

        Capsule::schema()->dropIfExists('users');
    }
}
