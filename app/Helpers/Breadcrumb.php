<?php

namespace App\Helpers;

class Breadcrumb
{
    protected static $crumbs = [];

    /**
     * get breadcrum data
     * @return array
     */
    public static function get()
    {
        return self::$crumbs;
    }

    /**
     * set breadcrumb data
     * @param array $crumb
     */
    public static function set(array $crumb)
    {
        if (isset($crumb['name'], $crumb['href'])) {
            self::$crumbs[] = $crumb;
        }
    }
}
