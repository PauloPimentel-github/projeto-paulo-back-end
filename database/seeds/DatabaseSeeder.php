<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'customer_name' => 'Paulo Pimentel',
            'customer_cpf' => '38684383869',
            'customer_endereco' => 'Rua vinte e cinco',
            'customer_cep' => '07263725'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
