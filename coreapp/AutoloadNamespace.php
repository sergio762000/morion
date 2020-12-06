<?php


namespace coreapp;


class AutoloadNamespace
{
    protected $namespaceList = array();

    public function addNamespace($namespace, $rootDir)
    {
        $result = false;
        if (is_dir($rootDir)) {
            $this->namespaceList[$namespace] = $rootDir;
            $result = true;
        }

        return $result;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    protected function autoload($class)
    {
        $pathClass = explode('\\', $class);

        if (is_array($pathClass)) {
            $namespace = array_shift($pathClass);

            if (!empty($this->namespaceList[$namespace])) {
                $filePath = $this->namespaceList[$namespace] . '/' . implode($pathClass) . '.php';
                require_once $filePath;
                return true;
            }
        }
        return false;
    }
}
