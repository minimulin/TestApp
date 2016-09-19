<?php

namespace TestApp\Model;

use TestApp\Kernel\Database\Connection;

/**
 * Модель для работы с отзывами
 */
class Reply
{

    protected static $rules = [
        'name' => [
            'restrictions' => [
                'required' => 'Имя обязательно для заполнения',
                'min_length(2)' => 'Длина имени не может быть менее двух символов',
            ],
        ],
        'email' => [
            'restrictions' => [
                'required' => 'Email обязателен для заполнения',
                'email' => 'Неверный формат',
            ],
        ],
        'message' => [
            'restrictions' => [
                'required' => 'Сообщение обязательно для заполнения',
            ],
        ],
    ];

    public static function getTableName()
    {
        return 'replies';
    }

    public static function findAll($orderBy = null, $asc = true, $onlyActive = true)
    {
        if ($orderBy) {
            $orderByQuery = 'ORDER BY ' . $orderBy . ($asc ? ' asc' : ' desc');
        } else {
            $orderByQuery = '';
        }

        if ($onlyActive) {
            $filter .= ' WHERE is_active IS TRUE ';
        } else {
            $filter;
        }

        $query = 'SELECT * FROM `' . static::getTableName() . '` ' . $filter . $orderByQuery;

        $statement = Connection::prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function findById($id)
    {
        $query = 'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id';

        $statement = Connection::prepare($query);
        $statement->execute([':id' => (int) $id]);
        return $statement->fetch();
    }

    public static function create($data)
    {
        $statement = Connection::prepare('INSERT INTO ' . static::getTableName() . ' (name, email, message, image) VALUES (:name, :email, :message, :image)');

        $result = $statement->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':message' => $data['message'],
            ':image' => $data['image'],
        ]);

        return $result;
    }

    public static function apply($id)
    {
        $statement = Connection::prepare('UPDATE `' . static::getTableName() . '` SET `is_active` = true WHERE id = :id');

        $result = $statement->execute([
            ':id' => (int) $id,
        ]);

        return $result;
    }

    public static function update($data)
    {
        $statement = Connection::prepare('UPDATE `' . static::getTableName() . '` SET `edited` = true, `name` = :name, `email` = :email, `message` = :message WHERE id = :id');

        $result = $statement->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':message' => $data['message'],
            ':id' => $data['id'],
        ]);

        return $result;
    }

    /**
     * Валидация
     * @param  array  $data Валидируемые данные
     * @return mixed        Результат валидации
     */
    public static function validate($data)
    {
        $errors = [];
        foreach ($data as $param => $value) {
            if (array_key_exists($param, self::$rules)) {

                if (isset(self::$rules[$param]['restrictions'])) {
                    foreach (self::$rules[$param]['restrictions'] as $restriction => $message) {
                        if ($restriction == 'required') {
                            if (trim(mb_strlen($value)) == 0) {
                                $errors[$param][] = $message;
                                break;
                            }
                        }
                        if (strpos($restriction, 'min_length') !== false) {
                            preg_match('/^min_length\((.*)\)/', $restriction, $matches);
                            $minLength = $matches[1];
                            if (mb_strlen($value) < $minLength) {
                                $errors[$param][] = $message;
                            }
                        }
                        if ($restriction == 'email') {
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $errors[$param][] = $message;
                            }
                        }
                    }
                }
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return true;
    }

    public static function reject($id)
    {
        $statement = Connection::prepare('UPDATE `' . static::getTableName() . '` SET `is_active` = false WHERE id = :id');

        $result = $statement->execute([
            ':id' => (int) $id,
        ]);

        return $result;
    }

}
