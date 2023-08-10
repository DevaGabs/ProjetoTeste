<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                "name" => "Tech Solutions Ltda",
                "cnpj" => "12.345.678/0001-01",
                "email" => "contato@techsolutions.com",
                "representantive_user" => "João Silva",
                "city_id" => "São Paulo",
                "state_id" => "SP",
                "latitude" => -23.550520,
                "longitude" => -46.633308,
                "category_id" => "Tecnologia da Informação (TI)",
                'whatsapp_phone' => '21999999991'
            ],
            [
                "name" => "Saúde Total S.A.",
                "cnpj" => "98.765.432/0001-02",
                "email" => "contato@saudetotal.com",
                "representantive_user" => "Maria Santos",
                "city_id" => "Rio de Janeiro",
                "state_id" => "RJ",
                "latitude" => -22.906847,
                "longitude" => -43.172897,
                "category_id" => "Saúde e Bem-Estar",
                'whatsapp_phone' => '21999999992'
            ],
            [
                "name" => "EducaMais Ltda",
                "cnpj" => "55.789.123/0001-03",
                "email" => "contato@educamais.com",
                "representantive_user" => "Pedro Souza",
                "city_id" => "Belo Horizonte",
                "state_id" => "MG",
                "latitude" => -19.922731,
                "longitude" => -43.945094,
                "category_id" => "Educação",
                'whatsapp_phone' => '21999999993'
            ],
            [
                "name" => "Delícias Gourmet Ltda",
                "cnpj" => "23.456.789/0001-04",
                "email" => "contato@deliciasgourmet.com",
                "representantive_user" => "Ana Oliveira",
                "city_id" => "Salvador",
                "state_id" => "BA",
                "latitude" => -12.971598,
                "longitude" => -38.501743,
                "category_id" => "Alimentação e Bebidas",
                'whatsapp_phone' => '21999999994'
            ],
            [
                "name" => "MegaMart Inc.",
                "cnpj" => "87.654.321/0001-05",
                "email" => "contato@megamart.com",
                "representantive_user" => "Carlos Ferreira",
                "city_id" => "Fortaleza",
                "state_id" => "CE",
                "latitude" => -3.731861,
                "longitude" => -38.526670,
                "category_id" => "Varejo",
                'whatsapp_phone' => '21999999995'
            ],
            [
                "name" => "MoneyBank S.A.",
                "cnpj" => "11.223.334/0001-06",
                "email" => "contato@moneybank.com",
                "representantive_user" => "Laura Costa",
                "city_id" => "Brasília",
                "state_id" => "DF",
                "latitude" => -15.780148,
                "longitude" => -47.929170,
                "category_id" => "Finanças e Serviços Financeiros",
                'whatsapp_phone' => '21999999996'
            ],
            [
                "name" => "EnergiTech Soluções Ltda",
                "cnpj" => "98.765.432/0001-07",
                "email" => "contato@energitech.com",
                "representantive_user" => "Gabriel Santos",
                "city_id" => "Porto Alegre",
                "state_id" => "RS",
                "latitude" => -30.034647,
                "longitude" => -51.217658,
                "category_id" => "Energia e Sustentabilidade",
                'whatsapp_phone' => '21999999997'
            ],
            [
                "name" => "AutoFast Peças Automotivas Ltda",
                "cnpj" => "56.789.123/0001-08",
                "email" => "contato@autofast.com",
                "representantive_user" => "Sofia Lima",
                "city_id" => "Recife",
                "state_id" => "PE",
                "latitude" => -8.047563,
                "longitude" => -34.876964,
                "category_id" => "Indústria Automobilística",
                'whatsapp_phone' => '21999999998'
            ],
            [
                "name" => "Viagens&Lazer Turismo Ltda",
                "cnpj" => "12.345.678/0001-09",
                "email" => "contato@viagenselazer.com",
                "representantive_user" => "Rafaela Pereira",
                "city_id" => "Florianópolis",
                "state_id" => "SC",
                "latitude" => -27.594870,
                "longitude" => -48.548219,
                "category_id" => "Turismo e Hotelaria",
                'whatsapp_phone' => '21999999999'
            ],
            [
                "name" => "PlayNow Entretenimento Ltda",
                "cnpj" => "98.765.432/0001-10",
                "email" => "contato@playnow.com",
                "representantive_user" => "Lucas Almeida",
                "city_id" => "Manaus",
                "state_id" => "AM",
                "latitude" => -3.119028,
                "longitude" => -60.021731,
                "category_id" => "Entretenimento e Mídia",
                'whatsapp_phone' => '21999999990'
            ],
        ];

        foreach ($companies as $company) {
            $company['state_id'] = State::where('letter', $company['state_id'])->first()->id;
            $company['city_id'] = City::where('title', $company['city_id'])
                ->where('state_id', $company['state_id'])
                ->first()
                ->id;

            $company['category_id'] = Category::where('name', $company['category_id'])
                ->first()
                ->id;
                
            Company::create($company);
        }
            
    }
}
