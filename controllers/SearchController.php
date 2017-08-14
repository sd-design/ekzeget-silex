<?php

namespace controllers;


use PDO;
use services\URLS;
use Silex\ControllerCollection;

class SearchController extends Controller
{

    protected function defineActions(ControllerCollection $search)
    {
        $search->get(URLS::ALL['SEARCH_SUGGEST'], function(\Application $app, $query) {
            $conn = new PDO('mysql:host=127.0.0.1;port=9306;charset=UTF8');
            $stmt = $conn->prepare("CALL SUGGEST(?, 'Bible')");
            $stmt->execute([trim($query)]);
            return $app->json($stmt->fetchAll(PDO::FETCH_ASSOC));
        });

        $search->get(URLS::ALL['SEARCH'], function(\Application $app, $query) {
            $conn = new PDO('mysql:host=127.0.0.1;port=9306;charset=UTF8');
            $stmt = $conn->prepare(
                "
                SELECT * FROM Bible WHERE MATCH(:query) AND locale = :locale;
                SELECT id, locale, author_id FROM Tradition WHERE MATCH(:query) AND locale = :locale;
                "
            );
            $result = [];
            $stmt->execute([
                ':query' => trim($query),
                ':locale' => $app['current_locale'],
            ]);
            $result['Bible'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->nextRowset();
            $result['Tradition'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->render('result', $result);
        });
    }
}