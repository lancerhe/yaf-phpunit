<?php
/**
 * New Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
Class Model_New extends \Core\Model {

    /**
     * 插入行
     */
    public function addRow() {
        // so insert to mysql.
        $result = false;
        if ( ! $result ) {
            throw new \Core\Exception\DatabaseException();
        }
    }


    /**
     * 删除行
     */
    public function deleteRow() {
        // so delelt from mysql table.
        $result = false;
        if ( ! $result ) {
            throw new \Core\Exception\DatabaseWriteException();
        }
    }


    /**
     * 默认异常处理机制
     * @param  \Exception  $exception
     * @return mixed
     */
    public static function defaultExceptionHandler( \Exception $exception ) {
        echo "<pre>";
        echo $exception->getMessage();
        echo " so we need to log it.";
        echo "</pre>";
    }
}