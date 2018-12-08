<?php

namespace Docs\Events;

use function GuzzleHttp\Psr7\parse_query;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;

final class NewRelicTransactionListener
{
    public function afterExecuteRoute(Event $event, Micro $app, array $data = null)
    {
        if (!extension_loaded('newrelic')) {
            return;
        }

        $params = $app->getRouter()->getParams();
        $page = null;

        // Assume that this URI matched /<lang>/<version>/<page>
        if (!empty($params[1])) {
            $this->addTransactionParameter('lang', $params[0]);
            $this->addTransactionParameter('version', $params[1]);

            // In accordance with the routing we should look
            // for page name in the $params[2]
            if (!empty($params[2])) {
                $page = $params[2];
            } else {
                $page = '';
            }
        } elseif (!empty($params[0])) {
            $this->addTransactionParameter('lang', $params[0]);
            $this->addTransactionParameter('version', 'latest');
        }

        if (null === $page) {
            $handler = $app->getActiveHandler();
            if (is_array($handler) && isset($handler[1]) && 'searchAction' === $handler[1]) {
                $page = 'search';

                $query = parse_query($_SERVER['QUERY_STRING']);
                if (!empty($query['q'])) {
                    $this->addTransactionParameter('query', $query['q']);
                }
            } else {
                $page = $_SERVER['REQUEST_URI'];
            }
        }

        $this->setTransactionName($page);
    }

    private function setTransactionName($name)
    {
        \newrelic_name_transaction("/{$name}");
    }

    private function addTransactionParameter($parameter, $value)
    {
        \newrelic_add_custom_parameter($parameter, $value);
    }
}
