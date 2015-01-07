<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Stamp extends Eloquent {

    protected $table = 'stamps';

	//protected $softDelete = true;
	use SoftDeletingTrait;

}
?>
