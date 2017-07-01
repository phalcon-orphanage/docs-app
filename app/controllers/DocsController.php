<?php

namespace Docs\Controllers;

use Phalcon\Http\ResponseInterface;

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
     * @return \Phalcon\Http\ResponseInterface
     */
    public function redirectAction(): ResponseInterface
    {
        return $this->response->redirect($this->getVersion('/en/'));
    }

    /**
     * @param null|string $language
     * @param null|string $version
     * @param string      $page
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function mainAction(string $language = null, string $version = null, string $page = ''): ResponseInterface
    {
        if (empty($language)) {
            return $this->response->redirect($this->getVersion('/en/'));
        }

        $language = $this->getLanguage($language);

        if (empty($version)) {
            return $this->response->redirect($this->getVersion('/' . $language . '/'));
        }

        if (strtolower($version) === 'latest') {
            $version = $this->getVersion();
        }

        if (empty($page)) {
            $page = 'introduction';
        }

        $slug     = str_replace(['/' . $language, '/' . $version], ['', ''], $this->request->getURI());
        $contents = $this->viewSimple->render(
            'index/index',
            [
                'language' => $language,
                'version'  => $version,
                'sidebar'  => $this->getDocument($language, $version, 'sidebar'),
                'article'  => $this->getDocument($language, $version, $page),
                'menu'     => $this->getDocument($language, $version, $page . '-menu'),
                'slug'     => $slug,
            ]
        );
        $this->response->setContent($contents);

        return $this->response;
    }
}
