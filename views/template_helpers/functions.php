<?php
/**
 * Common shop module functions that used in template.
 *
 *
 * Created by Amin Keshavarz
 * Date: 23/03/2017
 * Time: 11:03 AM
 * Created in telbit project
 */

/**
 * Return value of an array if exist or return null if not exist.
 * @param string $key key name
 * @param array $args arguments as array
 * @param mixed $return_if_failure Return value if args not exist.
 * @return mixed|null
 */
function get_args_value($key, $args=[], $return_if_failure=null){
    if(key_exists($key, $args)){
        return $args[$key];
    }
    return $return_if_failure;
}