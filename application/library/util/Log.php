<?php
/**
 * Util_Log
 *
 * @category Library
 * @package  Util
 * @author   Lancer <lancer.he@gmail.com>
 * @since    2014-06-15
 * @version  1.0 
 */
class Util_Log {

    public static $log_path = "/tmp/wwwlogs/";

    /**
     * Write log to file. log folder: /tmp/log/
     * @param  string  $output   output message.
     * @param  string  $log_file output file, ex: /db/query.log
     * @return void
     */
    public static function write($output, $log_file) {
        $log_file   = self::$log_path . ltrim($log_file, '/');
        $path_parts = pathinfo($log_file);
        $log_folder = $path_parts["dirname"];
        if ( ! is_dir($log_folder) ) {
            mkdir($log_folder, 0700, true);
        }

        $handle = fopen($log_file, "a+");
        fwrite($handle, $output . PHP_EOL );
        fclose($handle);
    }
}