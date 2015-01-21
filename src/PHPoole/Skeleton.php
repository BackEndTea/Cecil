<?php
/*
 * This file is part of the PHPoole package.
 *
 * Copyright (c) Arnaud Ligny <arnaud@ligny.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPoole;

use Exception;

/**
 * Class Skeleton
 * @package PHPoole
 */
class Skeleton
{
    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createConfigFile(PHPoole $phpoole)
    {
        $content = <<<'EOT'
[site]
name        = "PHPoole"
baseline    = "Light and easy static website generator!"
description = "PHPoole is a light and easy static website / blog generator written in PHP. It parses your content written with Markdown, merge it with layouts and generates static HTML files."
base_url    = "http://localhost:8000"
language    = "en"
[author]
name  = "Arnaud Ligny"
email = "arnaud+phpoole@ligny.org"
home  = "http://narno.org"
[deploy]
repository = "https://github.com/Narno/PHPoole.git"
branch     = "gh-pages"
EOT;
        if (!@file_put_contents($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::CONFIG_FILENAME, $content)) {
            throw new Exception('Cannot create the config file');
        }
        return 'Config file';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createStaticDir(PHPoole $phpoole)
    {
        if (!@mkdir($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::STATIC_DIRNAME)) {
            throw new Exception('Cannot create the static directory');
        }
        return 'Static directory';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createLayoutsDir(PHPoole $phpoole)
    {
        if (!@mkdir($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::LAYOUTS_DIRNAME)) {
            throw new Exception('Cannot create the layouts directory');
        }
        return 'Layouts directory';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createLayoutDefaultFile(PHPoole $phpoole)
    {
        $content = <<<'EOT'
<!DOCTYPE html>
<html lang="{{ site.language }}">
  <head>
    <meta charset="utf8" />
    <title>{{ site.name}} - {{ page.title }}</title>
    <meta name="description" content="{{ site.description }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
html, body {
  font: sans-serif;
  background-color: #fcfcfc;
  color: #444;
}
#main {
  width: 760px;
  margin: 50px auto;
}
h1 {
  font-weight: 300;
  font-size: 56px;
}
h2 {
  font-weight: 200;
  font-size: 42px;
}
#footer {
  font-size: 14px;
}
a, a:visited {
  color: #d23;
  text-decoration: none;
  border-bottom: 1px dotted #fcc;
}
a:hover {
  color: #f78;
}
@media (max-width: 800px) {
  #main {
    width: 100%;
  }
  p {
    padding: 0 0 0 15px;
    min-width: 250px;
  }
}
@media (max-width: 480px) {
  #main {
    margin-top: 20px;
  }
  h1, h2 {
    text-align: center;
  }
}
    </style>
  </head>
  <body>
    <div id="main">
      <h1><a href="{{ site.base_url}}">{{ site.name }}</a></h1>
      <h2>{{ site.baseline }}</h2>
      <p>{{ page.content }}</p>
      <div id="footer">Powered by <a href="http://phpoole.narno.org">PHPoole</a>, coded by <a href="{{ site.author.home }}">{{ site.author.name }}</a></div>
    </div>
  </body>
</html>
EOT;
        if (!@file_put_contents($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::LAYOUTS_DIRNAME . '/default.html', $content)) {
            throw new Exception('Cannot create the default layout file');
        }
        return 'Default layout file';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createAssetsDir(PHPoole $phpoole)
    {
        $subDirList = array(
            PHPoole::ASSETS_DIRNAME,
            PHPoole::ASSETS_DIRNAME . '/css',
            PHPoole::ASSETS_DIRNAME . '/img',
            PHPoole::ASSETS_DIRNAME . '/js',
        );
        foreach ($subDirList as $subDir) {
            if (!@mkdir($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . $subDir)) {
                throw new Exception('Cannot create the assets directory');
            }
        }
        return 'Assets directory';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createContentDir(PHPoole $phpoole)
    {
        $subDirList = array(
            PHPoole::CONTENT_DIRNAME,
        );
        foreach ($subDirList as $subDir) {
            if (!@mkdir($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . $subDir)) {
                throw new Exception('Cannot create the content directory');
            }
        }
        return 'Content directory';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createContentDefaultFile(PHPoole $phpoole)
    {
        $content = <<<'EOT'
<!--
title = Home
layout = default
menu = nav
-->
PHPoole is a light and easy static website / blog generator written in PHP.
It parses your content written with Markdown, merge it with layouts and generates static HTML files.

PHPoole = [PHP](http://www.php.net) + [Poole](http://en.wikipedia.org/wiki/Strange_Case_of_Dr_Jekyll_and_Mr_Hyde#Mr._Poole)

Go to the [dedicated website](http://phpoole.narno.org) for more details.
EOT;
        if (!@file_put_contents($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::CONTENT_DIRNAME . '/index.md', $content)) {
            throw new Exception('Cannot create the default content file');
        }
        return 'Default content file';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createRouterFile(PHPoole $phpoole)
    {
        $content = <<<'EOT'
<?php
date_default_timezone_set("UTC");
define("DIRECTORY_INDEX", "index.html");
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$ext = pathinfo($path, PATHINFO_EXTENSION);
if (empty($ext)) {
    $path = rtrim($path, "/") . "/" . DIRECTORY_INDEX;
}
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path)) {
    return false;
}
http_response_code(404);
echo "404, page not found";
EOT;
        if (!@file_put_contents($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/router.php', $content)) {
            throw new Exception('Cannot create the router file');
        }
        return 'Router file';
    }

    /**
     * @param PHPoole $phpoole
     * @return string
     * @throws Exception
     */
    public static function createReadmeFile(PHPoole $phpoole)
    {
        $content = <<<'EOT'
Powered by [PHPoole](http://phpoole.narno.org).
EOT;

        if (is_file($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::STATIC_DIRNAME . '/README.md')) {
            if (!@unlink($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::STATIC_DIRNAME . '/README.md')) {
                throw new Exception('Cannot create the README file');
            }
        }
        if (!@file_put_contents($phpoole->getWebsitePath() . '/' . PHPoole::PHPOOLE_DIRNAME . '/' . PHPoole::STATIC_DIRNAME . '/README.md', $content)) {
            throw new Exception('Cannot create the README file');
        }
        return 'README file';
    }
}