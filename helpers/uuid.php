<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.09.2016
 * Time: 21:04
 */

namespace app\helpers;


use p2made\helpers\Uuid\UuidHelpers;

/**
 * Class uuid
 * @package app\helpers
 */
class uuid extends UuidHelpers
{
    /**
     * @param int $subDomain
     * @return string
     */
    public static function binUuid($subDomain = self::SUBDOMAIN_DEFAULT){
        return pack("h*", str_replace('-', '', parent::uuid($subDomain)));
    }

    /**
     * @param $uuid
     * @return string
     */
    public static function uuid2bin($uuid){
        return pack("h*", str_replace('-', '', $uuid));
    }

    /**
     * @param $bin
     * @return mixed
     */
    public static function bin2uuid($bin){
        $uuid = unpack("h*",$bin);
        $uuid = preg_replace("/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/", "$1-$2-$3-$4-$5", $uuid);
        $uuid = array_merge($uuid);
        return $uuid[0];
    }

    /**
     * @param $uuid
     * @return int
     */
    public static function isUuid($uuid) {
        return preg_match("/([0-9a-f]{8})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{12})/", $uuid);
    }

    /**
     * @param $bin
     * @return int
     */
    public static function isBinUuid($bin) {
        $uuid = self::bin2uuid($bin);
        return self::isUuid($uuid);
    }
}