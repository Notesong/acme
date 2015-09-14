<?php

use Phinx\Migration\AbstractMigration;

class SeedPagesTable extends AbstractMigration
{
  public function up()
  {
      $this->execute("
          insert into pages (browser_title, page_content)
          values
          ('About Acme', '<h1>About Acme</h1><p>All about this company.</p>')
      ");
  }
  public function down()
  {

  }
}
