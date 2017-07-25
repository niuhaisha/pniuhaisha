<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        for ($i=1; $i <= 30; $i++) { 
        
	        DB::table('user')->insert([
	            'username' => str_random(10),
	            'password' => Hash::make('justdoit'),
	            'email' => str_random(10).'@qq.com',
	            'phone'=> '13'.rand(111111111,999999999),
	            'profile'=>'/uploads/74751500538153.jpg',
	            'status'=>'1'
	        ]);
        }
    }
}
