<?php

use App\core\App;

class m2_pass
{
    public function up()
    {
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL";
        App::$app->db->pdo->exec($SQL);
    }
    public function down()
    {
        $SQL = "ALTER TABLE user DROP COLUMN password";
        App::$app->db->pdo->exec($SQL);
    }
}
?>