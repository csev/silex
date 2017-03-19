<?php

/**
 * Loads a template from a class path
 *
 * This should be last in the chain as classes that do not exist are fatal, 
 * not excpetions so calling our exist() with a class that does not exist or
 * cannot be autoloaded, will be fatal, not simply return false :(
 */
final class Twig_Loader_Class implements Twig_LoaderInterface, Twig_ExistsLoaderInterface, Twig_SourceContextLoaderInterface
{

    public function getSourceContext($name)
    {
        $name = (string) $name;
        $view = $this->getCacheKey($name);
        return new Twig_Source($view, $name);
    }

    public function exists($name)
    {
        $name = (string) $name;
        if ( strpos($name, '\\') !== 0 ) return false;
        try {
            $view = $this->getCacheKey($name);
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    // Understand that the loading of a class is a *Fatal* error, not an exception
    // So we need to be last in the chain without a bit more autoloader magic here
    public function getCacheKey($name)
    {
        $name = (string) $name;
        try {
            $class = new $name();
            return $class->view;
        } catch(Exception $e) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }
    }

    public function isFresh($name, $time)
    {
        $name = (string) $name;
        $this->getCacheKey();
        return true;
    }
}
