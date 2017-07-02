<?php

namespace Docs\Controllers;

use Phalcon\Text;
use Docs\Exception\HttpException;
use Phalcon\Http\ResponseInterface;
use function Docs\Functions\base_url;

/**
 * Docs\Controllers\DocsController
 *
 * @package Docs\Controllers
 */
class DocsController extends BaseController
{
    /**
     * Performs necessary redirection
     *
     * @return ResponseInterface
     */
    public function redirectAction(): ResponseInterface
    {
        return $this->response->redirect(base_url($this->getVersion('/en/')));
    }

    /**
     * @param null|string $language
     * @param null|string $version
     * @param string      $page
     *
     * @return ResponseInterface
     * @throws HttpException
     */
    public function mainAction(string $language = null, string $version = null, string $page = ''): ResponseInterface
    {
        if (empty($language)) {
            return $this->response->redirect(base_url($this->getVersion('/en/')));
        }

        $language = $this->getLanguage($language);

        if (empty($version)) {
            return $this->response->redirect(base_url($this->getVersion('/' . $language . '/')));
        }

        $version = $this->getVersion('', $version);

        if (empty($page)) {
            $page = 'introduction';
        }

        if (!$article = $this->getDocument($language, $version, $page)) {
            throw new HttpException('Not Found', 404);
        }

        $slug     = str_replace(['/' . $language, '/' . $version], ['', ''], $this->request->getURI());

        $contents = $this->viewSimple->render(
            'index/index',
            [
                'language'  => $language,
                'version'   => $version,
                'sidebar'   => $this->getDocument($language, $version, 'sidebar'),
                'article'   => $article,
                'menu'      => $this->getDocument($language, $version, $page . '-menu'),
                'slug'      => $slug,
                'canonical' => Text::reduceSlashes(base_url("$language/$version") . ($slug ? "/$slug" : "")),
            ]
        );
        $this->response->setContent($contents);

        return $this->response;
    }
}
