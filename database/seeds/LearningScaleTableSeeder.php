<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningScaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('learning_scale_type_tbls')->insert(array(
        	array(
                'learning_scale_name' => "Pre basic",
        	),
        	array(
                'learning_scale_name' => "Basic",
        	),
        	array(
                'learning_scale_name' => "Pre Elementary",
        	),
        	array(
                'learning_scale_name' => "Elementary",
        	),
        	array(
                'learning_scale_name' => "Pre Intermediate",
        	),
        	array(
                'learning_scale_name' => "Intermediate",
        	),
        	array(
                'learning_scale_name' => "Upper Intermediate",
        	),
        	array(
                'learning_scale_name' => "Advanced",
        	)
        ));
    }
}
