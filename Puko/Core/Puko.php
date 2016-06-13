<?php

/**
 * Global namespace
 */
namespace Puko {

    define('CONTROLLERS', '/Controllers/');
    define('ASSETS', 'Assets/html/');
    define('MASTER', 'Assets/global/');

    define('PRODUCTION', 'live');
    define('DEVELOPMENT', 'dev');

    function _VariableDump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}

namespace Puko\Core {

    use Puko\Core\Presentation\Html\HtmlParser;
    use Puko\Core\Presentation\Html\View;
    use Puko\Core\Presentation\Json\JSONParser;
    use Puko\Core\Presentation\Json\Service;
    use Puko\Core\Router\RouteParser;
    use ReflectionClass;

    class Puko
    {

        /**
         * @var object
         */
        private static $PukoInstance;

        /**
         * @var string
         */
        public static $Environment;

        /**
         * @var bool
         */
        private static $VariableDump;

        /**
         * @param $environment
         * @return object|Puko
         */
        public static function Init($environment)
        {
            self::$Environment = $environment;
            self::Autoload();
            if (!is_object(self::$PukoInstance)) {
                self::$PukoInstance = new Puko();
            }
            return self::$PukoInstance;
        }
        
        private function Autoload()
        {
            spl_autoload_register(array('\Puko\Core\Puko', 'ClassLoader'));
        }

        /**
         * @param $className
         */
        private static function ClassLoader($className)
        {
            $className .= '.php';
            if (file_exists($className)) {
                require_once($className);
            }
        }
        
        public function Start()
        {
            $start = microtime(true);

            $view = new ReflectionClass(View::class);
            $service = new ReflectionClass(Service::class);

            $router = new RouteParser($this->GetRouter());
            $routerObj = $router->InitializeClass();
            $returnVars = $router->InitializeFunction($routerObj);

            if(self::$VariableDump && strcmp(self::$Environment, 'dev') == 0) {
                \Puko\_VariableDump($returnVars);
                //\Puko\_VariableDump(Authentication::GetInstance($authCode)->GetUserData());
            }

            $routeResult = new ReflectionClass($routerObj);

            //todo : processing docs comments
            $classDocs = $routeResult->getDocComment();
            $fnDocs = $routeResult->getMethod($router->FunctionNames)->getDocComment();

            $router->DocParser($fnDocs);

            if ($routeResult->isSubclassOf($view)) {
                $template = new HtmlParser(ASSETS . $router->ClassName . '/' . $router->FunctionNames . ".html");
                $template->setArrays($returnVars);
                $template->StyleRender($router->ClassName, $router->FunctionNames);
                $template->ScriptRender($router->ClassName, $router->FunctionNames);
                echo $template->output();
            } elseif ($routeResult->isSubclassOf($service)) {
                $service = new JSONParser($returnVars, $start);
                echo json_encode($service->output());
            } else {
                if (strcmp(self::$Environment, 'dev') == 0) {
                    die('Controller must extends its type');
                } else {
                    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
                    include 'Assets/global/notfound.html';
                    die();
                }
            }
        }

        /**
         * @return string
         */
        private function GetRouter()
        {
            $clause = isset($_GET['query']) ? $_GET['query'] : 'main/main/';
            $ClauseTail = substr($clause, -1);
            if ($ClauseTail != '/') {
                $clause .= '/';
            }
            return $clause;
        }

        /**
         * @param bool $option
         * @return object
         */
        public static function VariableDump($option = false)
        {
            self::$VariableDump = $option;
            return self::$PukoInstance;
        }
    }
}