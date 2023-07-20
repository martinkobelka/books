<?php

namespace app\controllers;

use app\models\BookForm;
use app\models\Book;
use app\models\Borrow;
use app\models\User;
use DateInterval;
use DateTime;
use Throwable;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\UploadedFile;

/**
 * Main controller. For the sake of simplicity,
 * I placed all actions in a single controller. In a real project,
 * I would split it into multiple controllers (or modules...)
 */
class SiteController extends Controller
{

    /** @var int number of books / borrows per page, for the pagination component */
    private const PAGE_SIZE = 6;

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('homepage');
    }

    /**
     * Displays list of all books
     *
     * @param int $page Active page
     * @return string
     * @throws Throwable
     * @throws Exception
     */
    public function actionBooks(int $page = 1): string
    {
        /** @var User $active_user Currently logged-in user */
        $active_user = Yii::$app->getUser()->getIdentity();

        /** @var int $count_of_books total number of books */
        $count_of_books = Book::countOfBooks();

        $pages = new Pagination(['totalCount' => $count_of_books, 'pageSize' => self::PAGE_SIZE]);

        $books_to_show = Book::getBooksFromPage($pages->pageSize, $page);

        return $this->render('books', [
            'books' => $books_to_show,
            'pages' => $pages,
            'user' => $active_user
        ]);
    }

    /**
     * Display single book
     *
     * @param $id
     * @return string
     * @throws Throwable
     */
    public function actionBook($id): string
    {
        /** @var User $active_user Currently logged-in user */
        $active_user = Yii::$app->getUser()->getIdentity();

        /** @var Book $book Book to show */
        $book = Book::findOne(["id" => $id]);

        if (!$book) {
            throw new HttpException(404, 'Nepodařilo se nám nalézt zadanou knihu');
        }

        /** @var Borrow|null $borrow active borrow or null */
        $borrow = $active_user ? Borrow::getUserBorrow($active_user->getId(), $book['id']) : null;

        /** @var int $count_of_borrows the number of currently borrowed pieces */
        $count_of_borrows = Borrow::countWithBook($id);

        /** @var string|null $when_available Nearest title return date */
        $when_available = $count_of_borrows > 0 ? Borrow::whenBookAvailable($id) : null;

        return $this->render('book', [
            'book' => $book,
            'borrow' => $borrow,
            'user' => $active_user,
            'count_of_available' => $book->quantity - $count_of_borrows,
            'when_available' => $when_available
        ]);
    }

    /**
     * The action causes the book to be borrowed
     *
     * @param $id
     * @return Response
     */
    public function actionBorrow($id): Response
    {
        if (!Yii::$app->user->isGuest
            && !Borrow::getUserBorrow(Yii::$app->getUser()->getId(), $id)) {

            $userId = Yii::$app->getUser()->getId();

            $borrow = new Borrow();
            $borrow->user_id = $userId;
            $borrow->book_id = $id;

            $date = new DateTime();
            $date->add(new DateInterval('P30D'));

            $borrow->end = $date->format('Y-m-d');
            $borrow->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Display all borrows
     *
     * @param int $page
     * @return string|Response
     * @throws Exception|Throwable
     */
    public function actionBorrows(int $page = 1)
    {
        // Check if user is admin
        if (Yii::$app->user->isGuest || !Yii::$app->getUser()->getIdentity()->admin) {
            return $this->goHome();
        }
        $count_of_borrows = Borrow::countAll();

        $pages = new Pagination(['totalCount' => $count_of_borrows, 'pageSize' => self::PAGE_SIZE]);

        $borrows = Borrow::allWithRelationsPaginate($pages->pageSize, $page);

        return $this->render('borrows', [
            'borrows' => $borrows,
            'count' => $count_of_borrows,
            'pages' => $pages
        ]);
    }

    /**
     * The action adds a new book
     *
     * @return string|Response
     * @throws Throwable
     */
    public function actionAdd()
    {
        // Check if user is admin
        if (Yii::$app->user->isGuest || !Yii::$app->getUser()->getIdentity()->admin) {
            return $this->goHome();
        }

        $model = new BookForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->createNewBook()) {
                $this->redirect(["/site/books"]);
            }

        }

        return $this->render('add', ['model' => $model]);
    }

    /**
     * Will display statistics
     *
     * @return string
     */
    public function actionStats(): string
    {
        $books = Book::booksStats();

        return $this->render('stats', [
            'books' => $books
        ]);
    }

    /**
     *
     *
     * @param $id
     * @return string|Response
     * @throws Throwable
     */
    public function actionEdit($id): string
    {
        // Check if the user is an administrator. If not, redirect it back
        if (Yii::$app->user->isGuest || !Yii::$app->getUser()->getIdentity()->admin) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model = new BookForm($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->editBook()) {
                $this->redirect(["/site/books"]);
            }

        }

        return $this->render('edit', ['model' => $model]);

    }

    /**
     * Remove book from system
     * !! Cascade deletes all borrowings !!
     *
     * @param $id
     * @return void|Response
     * @throws Throwable
     */
    public function actionRemove($id)
    {
        // Check if user is administrator
        if (Yii::$app->user->isGuest || !Yii::$app->getUser()->getIdentity()->admin) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        // Remove file with image of book
        $file_name = Book::findOne(['id' => $id])->image_name;
        unlink(Yii::$app->basePath . '/web/uploads/' . $file_name);

        Book::deleteAll(['id' => $id]);

        $this->redirect(["/site/books"]);
    }

    /**
     * Return the borrowed book
     *
     * @param $id
     * @return Response
     * @throws Exception
     * @throws Throwable
     */
    public function actionReturn($id): Response
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->getUser()->getIdentity()->admin) {
                // Admin can return any book
                Yii::$app->db->createCommand()
                    ->update('borrows', ['returned' => 1], [
                        "id" => $id,
                    ])->execute();
            } else {
                // Basic user can only return his borrowed book
                Yii::$app->db->createCommand()
                    ->update('borrows', ['returned' => 1], [
                        "id" => $id,
                        "user_id" => Yii::$app->getUser()->getIdentity()->getId()
                    ])->execute();
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
