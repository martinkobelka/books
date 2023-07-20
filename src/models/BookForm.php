<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Model that represents the form for adding/editing a book in the system
 */
class BookForm extends Model
{

    private const NAME_MIN_LENGTH = 3;
    private const NAME_MAX_LENGTH = 99;

    private const DESCRIPTION_MIN_LENGTH = 50;
    private const DESCRIPTION_MAX_LENGTH = 9999;

    private const YEAR_MIN = 999;

    private const QUANTITY_MIN = 1;
    private const QUANTITY_MAX = 99;

    private const IMAGE_FORMATS = "png, jpg";

    private const COUNT_OF_PAGES_MIN = 1;
    private const COUNT_OF_PAGES_MAX = 99999;

    private $_book;
    public $authors;
    public $name;
    public $description;
    public $isbn;
    public $year_of_publication;
    public $count_of_pages;
    public $quantity;
    public $language;
    public $bookbinding;
    public $genre;

    /** @var UploadedFile */
    public $image;

    /**
     * @param int|null $book_id if value is null, we create a new book. When value is a number, we edit the book with the value
     */
    public function __construct(?int $book_id = null)
    {
        if ($book_id) {
            $book = Book::findOne(["id" => $book_id]);
            $this->_book = $book;
            $this->setValues($book);
        }
    }

    /**
     * I added only basic validations, for format and for length.
     * It doesn't have to work 100%, would like to play with it more.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [
                [
                    'name', 'description', 'isbn',
                    'year_of_publication', 'count_of_pages',
                    'quantity', 'language',
                    'bookbinding', 'genre',
                    'image', 'authors'
                ],
                'required',
                'message' => "Tato položka je povinná"
            ],
            [
                ['name'],
                'string',
                'min' => self::NAME_MIN_LENGTH,
                'max' => self::NAME_MAX_LENGTH,
                'tooLong' => 'Délka jména musí být maximálně ' . self::NAME_MAX_LENGTH . ' znaků',
                'tooShort' => 'Délka jméno musí být alespoň ' . self::NAME_MIN_LENGTH . ' znaků'
            ],
            [
                'name',
                'validateName'
            ],
            [
                ['description'],
                'string',
                'min' => self::DESCRIPTION_MIN_LENGTH,
                "max" => self::DESCRIPTION_MAX_LENGTH,
                'tooLong' => "Délka popisu musí být maximálně " . self::DESCRIPTION_MAX_LENGTH . " znaků",
                'tooShort' => "Délka popisu musí být alespoň " . self::DESCRIPTION_MIN_LENGTH . " znaků"
            ],
            [
                'isbn',
                'validateIsbn'
            ],
            [
                ['year_of_publication'],
                'number',
                'min' => self::YEAR_MIN,
                'max' => date("Y"),
                'tooBig' => "Rok nesmí být hodnota větší než aktuální rok (" . date("Y") . ")",
                'tooSmall' => "Rok nesmí být hodnota nižší než rok " . self::YEAR_MIN
            ],
            [
                ['quantity'],
                'number',
                'min' => self::QUANTITY_MIN,
                'max' => self::QUANTITY_MAX,
                'tooBig' => "Počet kusů nesmí být větší než " . self::QUANTITY_MAX,
                'tooSmall' => "Počet kusů nesmí být nižší než " . self::QUANTITY_MIN
            ],
            [
                ['count_of_pages'],
                'number',
                'min' => self::COUNT_OF_PAGES_MIN,
                'max' => self::COUNT_OF_PAGES_MAX,
                'tooBig' => "Počet stran nesmí být větší než " . self::COUNT_OF_PAGES_MAX,
                'tooSmall' => "Počet stran musí být alespoň " . self::COUNT_OF_PAGES_MIN
            ],
            [
                ['image'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => self::IMAGE_FORMATS
            ]
        ];
    }

    public function validateName($attribute, $params)
    {
        // When we create a new book, the name must be unique
        if (!$this->_book) {
            if (Book::countWithName($this->name) !== 0) {
                $this->addError($attribute, "Kniha s tímto jménem již existuje");
            }
        }
    }

    public function validateIsbn($attribute, $params)
    {
        /** @var string $pattern regular expression representing an ISBN $pattern */
        $pattern = "/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/";

        if (!preg_match($pattern, $this->isbn)) {
            $this->addError($attribute, 'Nekorektní formát ISBN');
        }

    }

    /**
     * Creates a new book from the model
     *
     * @return bool
     */
    public function createNewBook(): bool
    {
        if ($this->validate()) {

            $imageName = uniqid("preview_") . "." . $this->image->extension;
            $this->image->saveAs('uploads/' . $imageName);

            $book = new Book();
            $this->setValuesToBook($book);
            $book->image_name = $imageName;

            $book->save();

            return true;
        }
        return false;
    }

    /**
     * Edit book
     *
     * @return bool
     */
    public function editBook(): bool
    {
        if ($this->validate()) {

            // Save the preview image
            $imageName = uniqid("preview_") . "." . $this->image->extension;
            $this->image->saveAs('uploads/' . $imageName);

            // Remove file with image of actual book
            $file_name = $this->_book->image_name;
            unlink(Yii::$app->basePath . '/web/uploads/' . $file_name);

            // Retrieve the values and update the entity
            $book = $this->_book;
            $this->setValuesToBook($book);
            $book->image_name = $imageName;
            $book->save();
            return true;

        }
        return false;
    }

    /**
     * Set values to this model from book
     *
     * @param Book|null $book
     * @return void
     */
    public function setValues(?Book $book): void
    {
        $this->name = $book->name;
        $this->description = $book->description;
        $this->isbn = $book->isbn;
        $this->year_of_publication = $book->year_of_publication;
        $this->count_of_pages = $book->count_of_pages;
        $this->quantity = $book->quantity;
        $this->language = $book->language;
        $this->bookbinding = $book->bookbinding;
        $this->genre = $book->genre;
        $this->authors = implode(", ", json_decode($book->authors));
    }

    /**
     * Set values to book from this model
     *
     * @param Book $book
     * @return void
     */
    public function setValuesToBook(Book $book): void
    {
        $book->name = $this->name;
        $book->description = $this->description;
        $book->isbn = $this->isbn;
        $book->year_of_publication = $this->year_of_publication;
        $book->count_of_pages = $this->count_of_pages;
        $book->quantity = $this->quantity;
        $book->language = $this->language;
        $book->bookbinding = $this->bookbinding;
        $book->genre = $this->genre;

        $book->authors = json_encode(explode(", ", $this->authors));
    }

}