<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'id' => (1),
            'manNumber' => (1111),
            'firstName' => ('John'),
            'lastName' => ('Doe'),
            'otherName' => ('Fire'),
            'phoneNumber' => ('0977123456'),
            'department' => (1),
            'timestamps' => ('')
        ]);
    }
}
