<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Query;

/**
 * Model that represents one book in the system
 */
class Book extends ActiveRecord
{

    /** @var int Default limit for the number of the most borrowed books in the statement */
    const STATS_LIMIT = 10;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'books';
    }

    /**
     * Will return the most frequently borrowed books
     *
     * @param int $limit
     * @return array
     */
    public static function booksStats(int $limit = self::STATS_LIMIT): array
    {
        return (new Query())
            ->from('books')
            ->leftJoin('`borrows`', '`borrows`.`book_id` = `books`.`id`')
            ->groupBy(['`books`.`id`'])
            ->select(
                [
                    '`books`.`id`',
                    '`books`.`name`',
                    'sum(case when `borrows`.`book_id` is null then 0 else 1 end) as `cnt`'
                ])
            ->limit($limit)
            ->orderBy(['`cnt`' => SORT_DESC, "`books`.`name`" => SORT_ASC])
            ->all();
    }

    /**
     * Returns the total number of books
     *
     * @return int
     * @throws Exception
     */
    public static function countOfBooks(): int
    {
        return (int)(Yii::$app->db->createCommand(
            "SELECT COUNT(*) as `cnt` FROM `books`"
        )->queryAll()[0]["cnt"]);
    }

    /**
     * Return the number of books with a name
     *
     * @param $name
     * @return int
     */
    public static function countWithName($name): int
    {
        return (new Query)->from('`books`')
            ->where(["name" => $name])
            ->select("count(*) as cnt")->one()["cnt"];
    }

    /**
     * Returns books in pagination context
     *
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    public static function getBooksFromPage(int $pageSize, int $page): array
    {
        return static::find()
            ->limit($pageSize)
            ->offset(($page - 1) * $pageSize)
            ->orderBy('`name`')
            ->all();
    }
}