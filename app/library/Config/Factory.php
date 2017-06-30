<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 20111-2017 Phalcon Team (https://phalconphp.com)         |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs\Config;

use League\Flysystem\Filesystem;
use Phalcon\Config;
use Phalcon\Di;
use function Docs\Functions\cache_path;
use function Docs\Functions\config_path;
use function Docs\Functions\environment;

class Factory
{
    /**
     * Create configuration object.
     *
     * @param  string $path Path to the config files
     *
     * @return Config
     */
    public static function create(string $path)
    {
        /** @var Filesystem $filesystem */
        $filesystem = Di::getDefault()->get('filesystem', [$path]);

        $files = array_filter($filesystem->listContents(), function ($metadata) {
            return isset($metadata['type']) &&
                $metadata['type'] == 'file' &&
                isset($metadata['extension']) &&
                $metadata['extension'] == 'php';
        });

        return self::load($files);
    }

    /**
     * Load all configuration.
     *
     * @param  array $files
     *
     * @return Config
     */
    protected static function load(array $files)
    {
        $config = new Config();
        $merge  = self::merge();

        /** @var Filesystem $filesystem */
        $filesystem = Di::getDefault()->get('filesystem', [cache_path('config')]);

        if ($filesystem->has('cached.php') && !environment('development')) {
            $merge($config, cache_path('config/cached.php'));

            return $config;
        }

        foreach ($files as $file) {
            $merge($config, config_path($file['path']), $file['filename']);
        }

        if (environment('production') && !$filesystem->has('cached.php')) {
            self::dump($filesystem, 'cached.php', $config->toArray());
        }

        return $config;
    }

    protected static function merge()
    {
        return function (Config &$config, $path, $node = null) {
            /** @noinspection PhpIncludeInspection */
            $toMerge = include($path);

            if (is_array($toMerge)) {
                $toMerge = new Config($toMerge);
            }

            if ($toMerge instanceof Config) {
                if (!$node) {
                    return $config->merge($toMerge);
                }

                if (!$config->offsetExists($node) || !$config->{$node} instanceof Config) {
                    $config->offsetSet($node, new Config());
                }

                return $config->get($node)->merge($toMerge);
            }

            return null;
        };
    }

    protected static function dump(Filesystem $filesystem, $path, array $data)
    {
        $header   = <<<HEAD
/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 20111-2017 Phalcon Team (https://phalconphp.com)         |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/
HEAD;
        $contents = '<?php' . PHP_EOL . PHP_EOL . $header . PHP_EOL;
        $contents .= 'return ' . var_export($data, true) . ';' . PHP_EOL;

        $filesystem->put($path, $contents, $data);
    }
}
