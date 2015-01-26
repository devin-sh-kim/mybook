<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('SettingDefTableSeeder');
		// $this->call('UserSettingTableSeeder');
		// $this->call('UserTableSeeder');
		$this->call('MoneybookCategoriesTableSeeder');
	}

}
