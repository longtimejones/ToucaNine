<?php
namespace App\Helper;

/**
 * HTML Purifier Helper
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Filter
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */
final class Html
{
    /**
     * HTML Purifier objects
     *
     * @var \HTMLPurifier
     */
    private static $_instances = array();

    /**
     * Constructor
     *
     * @return void
     *
     * @throws \OutOfBoundsException if mamespace for HTML Purifier is not present
     *
     * @access public
     */
    public function __construct()
    {
        $namespaces = include PRO_PATH . '/vendor/composer/autoload_namespaces.php';

        if (!isset($namespaces['HTMLPurifier']))
            throw new \OutOfBoundsException('Namespace for HTML Purifier is not present, please run composer dump-autoload --optimize.');

        require $namespaces['HTMLPurifier'][0] . '/HTMLPurifier.includes.php';
        require $namespaces['HTMLPurifier'][0] . '/HTMLPurifier.autoload.php';
    }

    /**
     * Returns HTML Purifier instance
     *
     * @param array $config Local HTML Purifier configuration
     *
     * @return \HTMLPurifier
     *
     * @access public
     */
    public function purifier(array $config = array())
    {
        return self::__instance($config);
    }

    /**
     * Returns HTML Purifier instance matching the configuration
     *
     * @param array $local_config Local HTML Purifier configuration
     *
     * @return \HTMLPurifier
     *
     * @access private
     *
     * @static
     */
    private static function __instance(array $config)
    {
        $config_key = md5(json_encode($config));

        if (!isset(self::$_instances[$config_key])) {

            /**
             * Grab HTML Purifier default configuration
             */
            $hp_default_config = \HTMLPurifier_Config::createDefault();

            /**
             * Grab HTML Purifier user configuration (global and local)
             */
            $hp_user_config = json_decode(HTML_PURIFIER_CONFIG, true);
            $hp_user_config+= $config;

            /**
             * Add HTML Purifier user configuration
             */
            foreach ($hp_user_config as $key => $value)
                if (is_array($value))
                    call_user_func_array(array($hp_default_config, 'set'), (array($key) + $value));
                else
                    $hp_default_config->set($key, $value);

            self::$_instances[$config_key] = new \HTMLPurifier($hp_default_config);

        }

        return self::$_instances[$config_key];
    }
}

/**
 * END App/Helper/Html.php
 */