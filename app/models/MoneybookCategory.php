<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MoneybookCategory extends Eloquent {

    protected $table = 'moneybook_categories';

	//protected $softDelete = true;
	use SoftDeletingTrait;

}
?>
