<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddAddresses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            [
                'building' => 'Žilinská univerzita',
                'street' => 'Univerzitná',
                'number' => 8215,
                'postal_code' => '01026',
                'city' => 'Žilina'
            ],
            [
                'building' => 'Slovenská technická univerzita',
                'street' => 'Vazovová',
                'number' => 5,
                'postal_code' => '80107',
                'city' => 'Bratislava'
            ],
            [
                'building' => 'Študenské centrum UKF',
                'street' => 'Dražovská',
                'number' => 2,
                'postal_code' => '94901',
                'city' => 'Nitra'
            ]
        ];

        foreach ($addresses as $addressData) {
            $address = new Address();
            $address->building = $addressData['building'];
            $address->street = $addressData['street'];
            $address->number = $addressData['number'];
            $address->postal_code = $addressData['postal_code'];
            $address->city = $addressData['city'];
            $address->save();
        }
    }
}
