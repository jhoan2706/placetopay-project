<?php

use Illuminate\Database\Seeder;

class TiposDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documento_tipos=[
            'CC' => 'Cédula de ciudanía colombiana',
            'CE' => 'Cédula de extranjería',
            'TI' => 'Tarjeta de identidad',
            'PPN' => 'Pasaporte',
            'NIT' => 'Número de identificación tributaria',
            'SSN' => 'Social Security Number',
        ];
        foreach ($documento_tipos as $key => $value) {
            DB::table('document_types')->insert([
                'name' => $key,
                'description' => $value
            ]);
        }
    }
}
