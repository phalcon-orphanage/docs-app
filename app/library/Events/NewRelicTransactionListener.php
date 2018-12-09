<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Events;

use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use function GuzzleHttp\Psr7\parse_query;

final class NewRelicTransactionListener
{
    public function afterExecuteRoute(Event $event, Micro $app, array $data = null)
    {
        if (!extension_loaded('newrelic')) {
            return;
        }

        $params  = $app->getRouter()->getParams();
        $handler = $app->getActiveHandler();

        if (is_array($handler) && isset($handler[1]) && 'searchAction' === $handler[1]) {
            $this->setTransactionName('search');

            $query = parse_query($_SERVER['QUERY_STRING']);
            if (!empty($query['q'])) {
                $this->addTransactionParameter('query', $query['q']);
            }
        } elseif (!empty($params)) {
            $lang = 'en';
            if (!empty($params['l'])) {
                $lang = $params['l'];
            }

            $version = 'latest';
            if (!empty($params['v'])) {
                $version = $params['v'];
            }

            $page = 'introduction';
            if (!empty($params['p'])) {
                $page = $params['p'];
            }

            $this->addTransactionParameter('lang', $lang);
            $this->addTransactionParameter('version', $version);

            $this->setTransactionName($page);
        } else {
            $this->setTransactionName('');
            $this->addTransactionParameter('uri', $_SERVER['REQUEST_URI']);
        }
    }

    /**
     * @param string $name
     */
    private function setTransactionName($name)
    {
        \newrelic_name_transaction('/' . trim($name, "\t\n\r\0\x0B\\/"));
    }

    /**
     * @param string $parameter
     * @param string $value
     */
    private function addTransactionParameter($parameter, $value)
    {
        \newrelic_add_custom_parameter($parameter, trim($value, "\t\n\r\0\x0B\\/"));
    }
}
