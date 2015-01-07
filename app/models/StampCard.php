<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StampCard extends Eloquent {

    protected $table = 'stamp_cards';

	//protected $softDelete = true;
	use SoftDeletingTrait;

    
}
?>
