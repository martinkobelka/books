<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Query;

/**
 * Model that represents one borrowed book
 */
class Borrow extends ActiveRecord
{
    /** @var int Flag indicating the boorow that is active */
    private const ACTIVE_BORROW = 0;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'borrows';
    }

    /**
     * Number of all active borrows
     *
     * @return int
     * @throws Exception
     */
    public static function countAll(): int
    {
        return (int)(Yii::$app->db->createCommand(
            "SELECT COUNT(*) as cnt FROM borrows where returned = :active_const",
            ["active_const" => self::ACTIVE_BORROW]
        )->queryAll()[0]["cnt"]);

    }

    /**
     * The number of all active loans for a specific book
     *
     * @param int $book_id
     * @return int
     * @throws Exception
     */
    public static function countWithBook(int $book_id): int
    {
        return (int)(Yii::$app->db->createCommand(
            "SELECT COUNT(*) as count_of_books FROM borrows where book_id = :book_id and returned = :active_const",
            ["book_id" => $book_id, "active_const" => self::ACTIVE_BORROW]
        )->queryAll()[0]["count_of_books"]);
    }

    /**
     * It will find out when the book on the given ID will be available.
     * !! It does not test if the borrow exists !!
     *
     * @param $book_id
     * @return string|null
     */
    public static function whenBookAvailable($book_id)
    {
        return static::find()
            ->where(['book_id' => $book_id, 'returned' => self::ACTIVE_BORROW])
            ->orderBy("end")
            ->limit(1)
            ->one()['end'];
    }

    /**
     * If the user has a borrowed book, this method will
     * return information about the borrowed book
     *
     * @param int $user_id
     * @param int $book_id
     * @return array|ActiveRecord|null
     */
    public static function getUserBorrow(int $user_id, int $book_id)
    {
        return static::find()
            ->where(
                [
                    'user_id' => $user_id,
                    'book_id' => $book_id,
                    'returned' => self::ACTIVE_BORROW
                ]
            )->one();
    }

    /**
     *
     * Display all borrows of all users paged and sorted by username
     *
     * @param int $page_size
     * @param int $page
     * @return array
     */
    public static function allWithRelationsPaginate(int $page_size, int $page): array
    {
        return (new Query())
            ->from('`borrows`')
            ->innerJoin('`users`', '`users`.`id` = `borrows`.`user_id`')
            ->innerJoin('`books`', '`books`.`id` = `borrows`.`book_id`')
            ->select([
                'id' => '`borrows`.`id`',
                'username' => '`users`.`username`',
                'book_id' => '`books`.`id`',
                'name' => '`books`.`name`',
                'end' => '`borrows`.`end`'
            ])
            ->where(["`returned`" => self::ACTIVE_BORROW])
            ->limit($page_size)
            ->offset(($page - 1) * $page_size)
            ->orderBy('`users`.`username`')
            ->all();
    }


}