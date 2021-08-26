<?php
if (! function_exists('themeAsset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function themeAsset($path, $secure = null)
    {
        return app('url')->asset('/public/admin/'.$path, $secure); // public/admin
    }
}
if (! function_exists('themeUrl')) {
    function themeUrl($path, $secure = null)
    {
        return app('url')->asset('/public/'.$path, $secure);
    }
}