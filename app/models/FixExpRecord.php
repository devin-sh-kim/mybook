<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FixExpRecord extends Eloquent {

    protected $table = 'fix_exp_records';
	use SoftDeletingTrait;

}
?>