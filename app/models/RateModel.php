<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/18/14
 * Time: 7:38 PM
 */

class RateModel extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rate';
    protected $primaryKey = 'rateID';
    protected $fillable = array('IP', 'objectID', 'objectType', 'score');

}
