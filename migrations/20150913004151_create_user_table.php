<?php
use Phinx\Migration\AbstractMigration;
class CreateUserTable extends AbstractMigration
{
    /**
     * Create user table with first name, last name, Email
     * password, active status, access level, and created dates.
     * Also add index to be sure emails are unique.
     */
    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('active', 'integer', ['default' => '0'])
            ->addColumn('access_level', 'integer', ['default' => '1'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->save();
    }
    public function down()
    {
        $this->dropTable('users');
    }
}
