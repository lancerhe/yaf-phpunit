<?php
/**
 * User Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
Class Model_User extends \Core\Model {

    /**
     * 根据ID返回行
     * @param  interger  $id
     * @return array
     */
    public function fetchRowById($id) {
        // So connect to mysql

        $row = array(
            'id'   => "5",
            'name' => 'Lancer He',
            'sex'  => "1",
        );
        return $row;
    }


    /**
     * 返回计算行
     * @return int
     */
    public function fetchCount() {
        // So connect to mysql
        return 1600;
    }
}