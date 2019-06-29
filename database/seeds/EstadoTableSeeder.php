<?php

use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \Illuminate\Support\Facades\DB::table('estados')->insert([
        ["ds_uf" => 'AC'],
        ["ds_uf" => 'AL'],
        ["ds_uf" => 'AM'],
        ["ds_uf" => 'AP'],
        ["ds_uf" => 'BA'],
        ["ds_uf" => 'CE'],
        ["ds_uf" => 'DF'],
        ["ds_uf" => 'ES'],
        ["ds_uf" => 'GO'],
        ["ds_uf" => 'MA'],
        ["ds_uf" => 'MG'],
        ["ds_uf" => 'MS'],
        ["ds_uf" => 'MT'],
        ["ds_uf" => 'PA'],
        ["ds_uf" => 'PB'],
        ["ds_uf" => 'PE'],
        ["ds_uf" => 'PI'],
        ["ds_uf" => 'PR'],
        ["ds_uf" => 'RJ'],
        ["ds_uf" => 'RN'],
        ["ds_uf" => 'RO'],
        ["ds_uf" => 'RR'],
        ["ds_uf" => 'RS'],
        ["ds_uf" => 'SC'],
        ["ds_uf" => 'SE'],
        ["ds_uf" => 'SP'],
      ]);
    }
}
