<?php

use App\parameter;
use App\ParameterValue;
use Illuminate\Database\Seeder;

class ParameterValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (parameter::count()==0){
            $param=parameter::create([
                'name'=>'Redes Sociales',
                'description'=>'Redes Sociales',
                'extra'=>'3,141592',
            ]);
            $param->parametersValues()->saveMany([
                new ParameterValue(['name'=>'facebook','description'=>'']),
                new ParameterValue(['name'=>'Instagram','description'=>'']),
                new ParameterValue(['name'=>'Twitter','description'=>'']),
            ]);
            $param=parameter::create([
                'name'=>'informacion Corporativa',
                'description'=>'informacion Corporativa',
                'extra'=>'2,71828',
            ]);
            $param->parametersValues()->saveMany([
                new ParameterValue(['name'=>'Nombre empresa','description'=>'DevelopApp'])
            ]);

            $param = parameter::create([
                'name' => 'Tipo Slider',
                'description' => 'Tipos de slider',
                'extra' => '',
            ]);
            $param->parametersValues()->saveMany([
                new ParameterValue(['name' => 'Móvil', 'description' => '']),
                new ParameterValue(['name' => 'Web', 'description' => '']),
            ]);
        }

        factory(parameter::class,1)->create()->each(function ($parameter) {
            $parameter->parametersValues()->saveMany(factory(ParameterValue::class,3)->make());
        });
    }
}
