<?php

namespace Docs\Controllers;

use Phalcon\Text;
use Phalcon\Http\ResponseInterface;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

use Docs\Exception\HttpException;

use function Docs\Functions\app_path;
use function Docs\Functions\base_url;
use SplFileInfo;

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

        $canonical = Text::reduceSlashes(base_url("{$language}/{$version}/{$page}"));

        // @todo
        if (strpos($this->request->getURI(), "/api/")) {
            $canonical = base_url("{$language}/{$version}/api/{$page}");
        }

        /**
         * Get the SEO stuff from here
         */
        $this->tag->setTitle($this->getSeoTitle($language, $version, $page));

        $contents = $this->viewSimple->render(
            'index/index',
            [
                'language'  => $language,
                'version'   => $version,
                'sidebar'   => $this->getDocument($language, $version, 'sidebar'),
                'article'   => $article,
                'menu'      => $this->getDocument($language, $version, $page . '-menu'),
                'canonical' => $canonical,
            ]
        );
        $this->response->setContent($contents);

        return $this->response;
    }
}
