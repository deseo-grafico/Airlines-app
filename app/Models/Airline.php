<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Airline extends Model
{
    use HasFactory;

    protected $url = 'https://api.instantwebtools.net/v1/airlines';
    protected $fillable = ['id','name', 'country', 'logo', 'slogan', 'head_quaters', 'website', 'established'];


    // Fake Initial Array
    protected $airlines = [
        [
            'id' => 1,
            'name' => 'Quatar Airways',
            'country' => 'Quatar',
            'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/9/9b/Qatar_Airways_Logo.svg/300px-Qatar_Airways_Logo.svg.png',
            'slogan' => 'Going Places Together',
            'head_quaters' => 'Qatar Airways Towers, Doha, Qatar',
            'website' => 'www.qatarairways.com',
            'established' => '1994',
        ],
        [
            'id' => 2,
            'name' => 'Singapore Airlines',
            'country' => 'Singapore',
            'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/250px-Singapore_Airlines_Logo_2.svg.png',
            'slogan' => 'A Great Way to Fly',
            'head_quaters' => 'Airline House, 25 Airline Road, Singapore 819829',
            'website' => 'www.singaporeair.com',
            'established' => '1947',
        ],
        [
            'id' => 5,
            'name' => 'Eva Air',
            'country' => 'Taiwan',
            'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/ed/EVA_Air_logo.svg/250px-EVA_Air_logo.svg.png',
            'slogan' => 'Sharing the World, Flying Together',
            'head_quaters' => '376, Hsin-Nan Rd., Sec. 1, Luzhu, Taoyuan City, Taiwan',
            'website' => 'www.evaair.com',
            'established' => '1989',
        ],
        [
            'id' => 6,
            'name' => 'Qantas',
            'country' => 'Australia',
            'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/02/Qantas_Airways_logo_2016.svg/300px-Qantas_Airways_logo_2016.svg.png',
            'slogan' => 'Spirit of Australia',
            'head_quaters' => 'Mascot, Sydney, Australia',
            'website' => 'qantas.com',
            'established' => '1920',
        ],
    ];
    




// Weird Request to avoid CURL 28 Error
    public static function getAll()
    {
        try {
            $response = Http::timeout(80)->get('https://api.instantwebtools.net/v1/airlines');
            $data = $response->json();
            $airlines = collect();

            foreach ($data as $airlineData) {
                $airline = new Airline();
                $airline->fill($airlineData);
                $airlines->push($airline);
            }

            return $airlines;
        } catch (\Exception $e) {
            


            return $airlines;
        }
    }
}
