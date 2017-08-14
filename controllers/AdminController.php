<?php

namespace controllers;

use models\PageQuery;
use models\User;
use PDOCrud;
use ReflectionClass;
use services\URLS;
use Silex\ControllerCollection;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;



//унификация
//password
// динамически подгружать перевод полей, если язык русский
//поддержка временных таблиц для обычных пользователей
//загрузка файлов
/*
 * page - description, меню админки, визуальный редактор
исследователь - tooltip
выпадающий список от стиха - до стиха
исследователь - напротив каждого фрагмента
 */

class AdminController extends Controller
{
    protected $layout = 'admin';

    /* @var  PDOCrud $pdoCrud */
    protected $pdoCrud;

    /* @var  PDOCrud $pdoCrud_i18n */
    protected $pdoCrud_i18n;

    protected function load($controllerSegment)
    {
        require_once __DIR__ . '/../admin/script/pdocrud.php';

        $this->pdoCrud = new PDOCrud();
        $this->pdoCrud->crudRemoveCol(['id', 'text', 'contents', 'description']);
        $this->pdoCrud->formRemoveFields(['id']);
        $this->pdoCrud->setPK("id");
        $this->pdoCrud->addPlugin("ckeditor");

        $pointerTooltip = 'Указатель на стих в формате 04012005 - 3 группы чисел. Первая группа соответствует номеру книги, вторая - номеру главы, третья - номеру стиха. Притом старшие разряды каждой группы в случае отсутствия заполняются нулями.';
        $this->pdoCrud->fieldTooltip("start_pointer", $pointerTooltip);
        $this->pdoCrud->fieldTooltip("end_pointer", $pointerTooltip);
        $this->pdoCrud->fieldTooltip("to_start_pointer", $pointerTooltip);
        $this->pdoCrud->fieldTooltip("to_end_pointer", $pointerTooltip);
        $this->pdoCrud->fieldTooltip("pointer", $pointerTooltip);


        $this->pdoCrud
            ->fieldRenameLable('text', 'содержимое')
            ->fieldRenameLable('contents', 'содержимое')
            ->fieldRenameLable('description', 'описание')
            ->fieldRenameLable('pointer', 'адрес стиха')
            ->fieldRenameLable('chapter', 'глава')
            ->fieldRenameLable('book_number', 'номер книги')
            ->fieldRenameLable('verse_number', 'стих')
            ->fieldRenameLable('start_pointer', 'от стиха')
            ->fieldRenameLable('end_pointer', 'до стиха')
            ->fieldRenameLable('slug', 'сегмент url')
            ->fieldRenameLable('is_research', 'исследование?')
            ->fieldRenameLable('news', 'новости')
            ->fieldRenameLable('date', 'дата')
            ->fieldRenameLable('title', 'заголовок')
            ->fieldRenameLable('is_approved', 'подтверждён?')
            ->fieldRenameLable('about', 'о себе')
            ->fieldRenameLable('page_code', 'код страницы')
            ->fieldRenameLable('area', 'область страницы')
            ->fieldRenameLable('locale', 'локаль');

        $app = get_app();
        $this->pdoCrud_i18n = new PDOCrud();

        $this->pdoCrud_i18n
            ->fieldRenameLable('text', 'содержимое')
            ->fieldRenameLable('contents', 'содержимое')
            ->fieldRenameLable('description', 'описание');

        $this->pdoCrud_i18n->formFields(['id', 'locale', 'name', 'title', 'slug', 'description', 'contents'])
            ->fieldCssClass('id', ['id-field', 'hidden'])
            ->fieldCssClass('locale', ['locale-field', 'hidden'])
            ->fieldHideLable('id')
            ->fieldHideLable('locale')
            ->formFieldValue('locale', $app['current_locale'])
            ->fieldRenameLable('slug', 'сегмент url')
            ->setPK("locale` = '{$app['current_locale']}' AND `id"); // sql injection to select by composite key(id, locale)
        parent::load($controllerSegment);
    }

    private function add_i18n_SelectControl(PDOCrud $pdoCrud, string $entity, string $formField = null)
    {
        $formField = ($formField ?? $entity . '_id');
        $pdoCrud->fieldTypes($formField, 'select');

        $queryCls = 'models\\' . ucfirst($entity) . 'I18nQuery';
        $dataSource = $queryCls::create()->orderByName()->findByLocale(get_app()['current_locale']);
        $elements = [];
        foreach ($dataSource as $element) {
            $elements[$element->getId()] = $element->getName();
        }

        $pdoCrud->fieldDataBinding($formField, $elements, '', '', 'array');
    }

    protected function defineActions(ControllerCollection $admin)
    {
        $admin->before(function () {

        });

        $admin->match(URLS::ALL['ADMIN_GALLERY'], function (\Application $app, Request $request) {
            if (!$this->checkAccess($app, 'file')) {
                throw new AccessDeniedException();
            }

            $form = $app['form.factory']->createBuilder(FormType::class)
                ->setMethod('POST')
                ->add('image', FileType::class, array(
                    'label' => 'image ',
                    'multiple' => true,
                ))
                ->add('OK', SubmitType::class)
                ->getForm();

            if ($request->isMethod('POST')) {
                $form->handleRequest($request);

                if ($form->isValid()) {
                    $files = $request->files->get($form->getName());
                    foreach ($files['image'] as $file) {
                        $filename = $file->getClientOriginalName();
                        $file->move($app['uploads.root'], $filename);
                    }
                }
            }

            return $this->render('gallery', [
                'form' => $form,
                'images' => array_merge(glob($app['uploads.root'] . '/*.png'), glob($app['uploads.root'] . '/*.jpg'), glob($app['uploads.root'] . '/*.gif')),
            ]);
        });

        $admin->get('/book/', function(\Application $app) {
            return $this->pdoCrud->dbTable('book')->setPK('number')->render();

        });

        $admin->get('/book_i18n/', function(\Application $app) {
            return $this->pdoCrud->dbTable('book_i18n')->setPK("number")->render();

        });

        $admin->get('/page/', function (\Application $app) {
            return $this->pdoCrud->dbTable('page')->render();
        });

        $admin->get('/widget/', function (\Application $app) {
            $pagesSource = PageQuery::create()->groupByCode()->find();
            $pages = [];
            foreach ($pagesSource as $page) {
                $pages[$page->getId()] = $page->getTitle();
            }
            return $this->pdoCrud->dbTable('page_widget')
                ->fieldTypes('page_code', 'select')
                ->fieldDataBinding('page_code', $pages, '', '', 'array')
                ->fieldTypes('area', 'select')
                ->fieldDataBinding('area', ['RIGHT' => 'RIGHT', 'LEFT' => 'LEFT', 'TOP' => 'TOP', 'BOTTOM' => 'BOTTOM'], '', '', 'array')
                ->render();
        });

        $admin->get('/user/', function (\Application $app) {
            if (!$this->checkAccess($app, 'user')) {
                throw new AccessDeniedException();
            }

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('user')->crudRemoveCol(['password', 'about'])
                            ->bulkCrudUpdate('name', 'inputtext')
                            ->bulkCrudUpdate('email', 'email')
                            ->fieldTypes('roles', 'select')
                            ->fieldDataBinding('roles', [User::ROLE_USER => User::ROLE_USER, User::ROLE_EDITOR => User::ROLE_EDITOR, User::ROLE_ADMIN => User::ROLE_ADMIN], '', '', 'array')
                            ->bulkCrudUpdate('country', 'inputtext')
                            ->bulkCrudUpdate('city', 'inputtext')
                            ->bulkCrudUpdate('is_approved', 'checkbox')
                            ->formRemoveFields(['last_login', 'created_at'])
           ]);
        });

        $admin->get('/news/', function (\Application $app) {
            if (!$this->checkAccess($app, 'news')) {
                throw new AccessDeniedException();
            }

            return $this->render('common', [
                'page' => $this->pdoCrud->setPK('date')->dbTable('news')->bulkCrudUpdate('title', 'inputtext')
            ]);

        });

        $admin->get(URLS::ALL['ADMIN_TABLE'], function (\Application $app, $table) {
            if (!$this->checkAccess($app, $table)) {
                throw new AccessDeniedException();
            }

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable($table)
            ]);
        });


        $admin->get(URLS::ALL['ADMIN_COMMENTARY_ADD'], function (\Application $app) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'author');

            return $this->render('common', [
                'page_i18n' => $this->pdoCrud_i18n->dbTable('Tradition_i18n')->render('insertform'),
                'page' => $this->pdoCrud->dbTable('Tradition')->render('insertform')
            ]);
        });

        $admin->get(URLS::ALL['ADMIN_COMMENTARY_EDIT'], function (\Application $app, $id) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'author');

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('Tradition')->render('editform', ['id' => $id]),
                'page_i18n' => $this->pdoCrud_i18n->dbTable("Tradition_i18n")->render('editform', ["id" => $id])
            ]);
        });


        $admin->get(URLS::ALL['ADMIN_AUTHOR_ADD'], function (\Application $app) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'authorType', 'type_id');

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('author')->render('insertform'),
                'page_i18n' => $this->pdoCrud_i18n->dbTable('author_i18n')->render('insertform')
            ]);
        });

        $admin->get(URLS::ALL['ADMIN_AUTHOR_EDIT'], function (\Application $app, $id) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'authorType', 'type_id');
            $this->add_i18n_SelectControl($this->pdoCrud, 'author');

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('author')->render('editform', ["id" => $id]),
                'page_i18n' => $this->pdoCrud_i18n->dbTable('author_i18n')->render('editform', ["id" => $id])
            ]);
        });

        $admin->get(URLS::ALL['ADMIN_COMMENTARY_BOOK_ADD'], function (\Application $app) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'author');
            $this->add_i18n_SelectControl($this->pdoCrud, 'book', 'book_number');

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('book_commentary')->render('insertform'),
                'page_i18n' => $this->pdoCrud_i18n->dbTable('book_commentary_i18n')->render('insertform')
            ]);
        });

        $admin->get(URLS::ALL['ADMIN_COMMENTARY_BOOK_EDIT'], function (\Application $app, $id) {
            $this->add_i18n_SelectControl($this->pdoCrud, 'author');
            $this->add_i18n_SelectControl($this->pdoCrud, 'book', 'book_number');

            return $this->render('common', [
                'page' => $this->pdoCrud->dbTable('book_commentary')->render('editform', ['id' => $id]),
                'page_i18n' => $this->pdoCrud_i18n->dbTable("book_commentary_i18n")->render('editform', ["id" => $id])
            ]);
        });



        $admin->post('/script/{script}', function (\Application $app, Request $request, $script) {
            if (!$this->checkAccess($app, $this->locateTableName($app, $request))) {
                throw new AccessDeniedException();
            }

            if ($script === 'pdocrud.php') {
                require_once __DIR__ . '/../admin/script/pdocrud.php';
                return '';
            }
            throw new AccessDeniedException();
        });
    }

    private function locateTableName(\Application $app, Request $request) : string
    {
        $pdoCrud = unserialize($_SESSION["pdocrud_sess"][$request->get('pdocrud_instance')]);
        $class = new ReflectionClass($pdoCrud);
        $property = $class->getProperty('tableName');
        $property->setAccessible(true);
        return $property->getValue($pdoCrud);
    }

    private function checkAccess(\Application $app, string $table) {
        return $app['security.authorization_checker']->isGranted(User::ROLE_ADMIN)
            || in_array($table, $app['editor.allowed_tables']);
    }
}