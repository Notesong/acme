<?php
use Phinx\Migration\AbstractMigration;
class SeedUsersTable extends AbstractMigration
{
    public function up()
    {
        $password_hash = password_hash('verysecret', PASSWORD_DEFAULT);
        $this->execute("
            insert into users (first_name, last_name, email, password, active, access_level)
            values
            ('Lee', 'Damien', 'me@you.com', '$password_hash', '1', '20')
        ");
    }
    public function down()
    {
    }
}
