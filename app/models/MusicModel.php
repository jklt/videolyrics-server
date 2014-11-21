<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/18/14
 * Time: 7:38 PM
 */

class MusicModel extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'music';
    protected $primaryKey = 'musicID';

    public function lookUp() {

    }

}
