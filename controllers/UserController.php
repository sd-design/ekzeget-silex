<?php

namespace controllers;


use models\NoteQuery;
use models\User;
use models\UserQuery;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class UserController extends  Controller
{
    //сам пользователь +уведомления, настраиваемые через админку, включая подтверждение email;

    protected function defineActions(ControllerCollection $user)
    {
        $user->get('/', function(\Application $app) {
            return $this->render('profile', [
                'user' => $app['security.token_storage']->getToken()->getUser()
            ]);
        });

        $user->post('/', function(\Application $app, Request $request) {
            if($app['security.token_storage']->getToken()->getUser() !== 'anon.') {
                return $app->json([], 201);
            }

            if (!$app['captcha']->check($request->get('g-recaptcha-response'))) {
                return $app->json([], 401);
            }

            if (UserQuery::create()->findOneByEmail($request->request->get('Email'))) {
                return $app->json([], 400);
            }

            $this->sanitizeUserInput($request);
            $request->request->set('Roles', 'ROLE_USER');
            $user = new User();
            $user->fromArray(
                iterator_to_array($request->request->getIterator())
            );
            $user->save();

            return $app->json([
                'user' => $user->toArray()
            ])
                ->setStatusCode(201);
        });

        $user->put('/', function(\Application $app, Request $request) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            $this->sanitizeUserInput($request);

            $user->fromArray(
                iterator_to_array($request->request->getIterator())
            );
            $user->save();

            return $app->json([
                'user' => $user->toArray()
            ]);
        });

        $user->delete('/', function(\Application $app) {
            $app['security.token_storage']->getToken()->getUser()->delete();
            return $app->json([]);
        });



        $user->get('/{entity}/list/', function(\Application $app, $entity) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            $getter = 'get' . ucfirst($entity) . 's';
            return $this->render($entity . 's', [
                $entity . 's' => $user->$getter()
            ]);
        })
        ->assert('entity', 'favourite|bookmark');

        $user->post('/{entity}/', function(\Application $app, Request $request, $entity) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            $entityCls = 'models\\'. ucfirst($entity);
            $entityObj = new $entityCls();
            $entityObj->fromArray(iterator_to_array($request->request->getIterator()));
            $entityObj->setUser($user);
            $entityObj->save();


            return $app->json([
                $entity => $entityObj->toArray()
            ])
                ->setStatusCode(201);
        })
            ->assert('entity', 'favourite|bookmark|note');

        $user->delete('/{entity}/{id}/', function(\Application $app, $entity, $id) {
            $user =  $app['security.token_storage']->getToken()->getUser();
            $queryCls = 'models\\'. ucfirst($entity) . 'Query';
            $entityObj = $queryCls::create()->filterByUser($user)->findOneById($id);

            if (!isset($entityObj)) {
                return $app->json([])->setStatusCode(404);
            }

            $entityObj->delete();

            return $app->json([]);
        })
            ->assert('entity', 'favourite|bookmark|note');




        $user->get('/note/list/', function(\Application $app) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            return $this->render('notes', [
                'notes' => NoteQuery::create()->select(['Id', 'Pointer'])->filterByUser($user)->find()
            ]);
        });

        $user->get('/note/{id}/', function(\Application $app, $id) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            return $this->render('note', [
                'note' => NoteQuery::create()->filterByUser($user)->findOneById($id)
            ]);
        });

        $user->put('/note/{id}/', function(\Application $app, Request $request, $id) {
            /* @var User $user */
            $user = $app['security.token_storage']->getToken()->getUser();
            $note = NoteQuery::create()->filterByUser($user)->findOneById($id);
            if (!isset($note)) {
                return $app->json([])->setStatusCode(404);
            }

            $note->fromArray(
                iterator_to_array($request->request->getIterator())
            );
            $note->save();

            return $app->json([
                'note' => $note->toArray()
            ]);
        });
    }

    private function sanitizeUserInput(Request $request)
    {
        $request->request->remove('Roles');
        $request->request->remove('IsApproved');
        $request->request->remove('CreatedAt');
        $request->request->remove('LastLogin');
        $request->request->remove('Id');
    }
}
