<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 09/04/2018
 * Time: 16:13
 */

namespace AppBundle\Utils;


class Slugger
{
    public static function slugify(string $string): string
    {
        return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
    }
}