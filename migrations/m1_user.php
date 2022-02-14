<?php

use App\core\App;

class m1_user
{
    public function up()
    {
        $SQL = "CREATE TABLE IF NOT EXISTS users(
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255),
                lastname VARCHAR(255),
                email VARCHAR(255))
                ENGINE=INNODB;";
        App::$app->db->pdo->exec($SQL);
    }
    public function down()
    {
        $SQL = "DROP TABLE  user";
        App::$app->db->pdo->exec($SQL);
    }
}
?>