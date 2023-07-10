<?php

namespace App\Libs;

use PDO;

class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Db::getConnection();
    }

    public function insert(string $table, array $fields): bool
    {
        if (count($fields)) {
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
            }
            $columns = implode("`, `", array_keys($fields));
            $values = implode(", ", array_keys($params));

            $sql = "INSERT INTO `{$table}` (`{$columns}`) VALUES ({$values})";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute($fields);
        }
        return false;
    }

    public function update(string $table, array $id, string $tableId, array $fields): bool
    {
        $id = $id['id'];
        if (count($fields)) {
            $x = 1;
            $set = "";
            foreach ($fields as $key => $value) {
                $set .= "`{$key}` = :$key";
                if ($x < count($fields)) {
                    $set .= ", ";
                }
                $x ++;
            }
            $sql = "UPDATE `{$table}` SET {$set} WHERE `{$tableId}` = {$id}";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute($fields);
        }
        return false;
    }

    public function delete(string $table, array $id): void
    {
        $sql = "DELETE FROM `{$table}` WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function select(string $table): array|false
    {
        $sql = "SELECT * FROM `{$table}`";
        /** @phpstan-ignore-next-line */
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectById(array $id): mixed
    {
        $id = $id['id'];
        $sql = "SELECT * 
                    FROM basic 
                    INNER JOIN additional 
                    ON basic.id = additional.basic_id 
                    INNER JOIN special 
                    ON additional.basic_id = special.add_id 
                    WHERE basic.id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectByLogin(mixed $email, mixed $password): mixed
    {
        $sql = "SELECT * 
                    FROM basic 
                    INNER JOIN additional 
                    ON basic.id = additional.basic_id 
                    INNER JOIN special 
                    ON additional.basic_id = special.add_id 
                    WHERE basic.email=? 
                    AND basic.password=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAll(): false|array
    {
        $sql = "SELECT * 
                    FROM basic 
                    INNER JOIN additional 
                    ON basic.id = additional.basic_id 
                    INNER JOIN special 
                    ON additional.basic_id = special.add_id";
        /** @phpstan-ignore-next-line */
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(array $id): void
    {
        $id = $id['id'];
        $sql = "DELETE basic, additional, special
                    FROM basic
                    INNER JOIN additional
                    ON basic.id = additional.basic_id
                    INNER JOIN special
                    ON additional.basic_id = special.add_id
                    WHERE basic.id = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

}