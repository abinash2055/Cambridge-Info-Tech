<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            // Include your 77 districts here
            "Achham",
            "Arghakhanchi",
            "Baglung",
            "Baitadi",
            "Bajhang",
            "Bajura",
            "Banke",
            "Bara",
            "Bardiya",
            "Bhaktapur",
            "Bhojpur",
            "Chitwan",
            "Dadeldhura",
            "Dailekh",
            "Dang",
            "Darchula",
            "Dhading",
            "Dhankuta",
            "Dhanusha",
            "Dolakha",
            "Dolpa",
            "Doti",
            "Eastern Rukum",
            "Gorkha",
            "Gulmi",
            "Humla",
            "Ilam",
            "Jajarkot",
            "Jhapa",
            "Jumla",
            "Kailali",
            "Kalikot",
            "Kanchanpur",
            "Kapilvastu",
            "Kaski",
            "Kathmandu",
            "Kavrepalanchok",
            "Khotang",
            "Lalitpur",
            "Lamjung",
            "Mahottari",
            "Makwanpur",
            "Manang",
            "Morang",
            "Mugu",
            "Mustang",
            "Myagdi",
            "Nawalpur",
            "Nuwakot",
            "Okhaldhunga",
            "Palpa",
            "Panchthar",
            "Parasi",
            "Parbat",
            "Parsa",
            "Pyuthan",
            "Ramechhap",
            "Rasuwa",
            "Rautahat",
            "Rolpa",
            "Rupandehi",
            "Salyan",
            "Sankhuwasabha",
            "Saptari",
            "Sarlahi",
            "Sindhuli",
            "Sindhupalchok",
            "Siraha",
            "Solukhumbu",
            "Sunsari",
            "Surkhet",
            "Syangja",
            "Tanahun",
            "Taplejung",
            "Terhathum",
            "Udayapur",
            "Western Rukum",
        ];

        foreach ($districts as $district) {
            District::create([
                'name' => $district
            ]);
        }
    }
}
