<?php
namespace App\core;

abstract class dbModel extends Model
{
    abstract public static function     tableName(): string
;
    abstract  public static function    primary_key(): string;
    abstract public function displayName(): string;

    abstract public function attrs():array;
    public function save()
    {

        $attrs = $this->attrs();
        $tableName =static::tableName();
        $val =array_map(fn($n)=>(":$n"),$attrs);
        $sql ="INSERT INTO $tableName(".implode(',',$attrs).")
         VALUES(".implode(',',$val).")";
        $stmt= App::$app->db->pdo->prepare($sql);
        foreach ($attrs as $key) {
            $stmt->bindValue(":$key",$this->{$key});
        }
        $stmt->execute();
        return true;
    }
    public static function findOne($whr)
    {
        $whk = array_keys($whr);
        $tableName =static::tableName();
        $datain =implode(" AND ",array_map(fn($n) => "$n = :$n",$whk));
        $sql ="SELECT * FROM $tableName WHERE $datain";
        $stmt =App::$app->db->pdo->prepare($sql);
        foreach ($whr as $key => $value) {
            $stmt->bindValue(":$key",$value);

        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }
}
?>