<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Airline;





class AirlinesController extends Controller
{


    // GET METHOD
    //OLD, we need the Array beforehand in Models.
    // public function showAll()
    // {
    //     //
    //     // fetch, Array Operations...
    //     //
    //     $responseAll = Http::timeout(60)->get('https://api.instantwebtools.net/v1/airlines');
    //     if ($responseAll->ok()) {
    //         // If the request was successfull, convert data to a JSON
    //         $data = $responseAll->json();
    //         // ...
    //         return $data;
    //     } else {
    //         // If we couldn't fetch data, make an exception
    //         // PROBLEM (Sometimes): timeout, already present on the REST API (url was copied and pasted)
    //         $json_str = '[{"id":1,"name":"Quatar Airways","country":"Quatar","logo":"https://upload.wikimedia.org/wikipedia/en/thumb/9/9b/Qatar_Airways_Logo.svg/300px-Qatar_Airways_Logo.svg.png","slogan":"Going Places Together","head_quaters":"Qatar Airways Towers, Doha, Qatar","website":"www.qatarairways.com","established":"1994"},{"id":2,"name":"Singapore Airlines","country":"Singapore","logo":"https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/250px-Singapore_Airlines_Logo_2.svg.png","slogan":"A Great Way to Fly","head_quaters":"Airline House, 25 Airline Road, Singapore 819829","website":"www.singaporeair.com","established":"1947"},{"id":5,"name":"Eva Air","country":"Taiwan","logo":"https://upload.wikimedia.org/wikipedia/en/thumb/e/ed/EVA_Air_logo.svg/250px-EVA_Air_logo.svg.png","slogan":"Sharing the World, Flying Together","head_quaters":"376, Hsin-Nan Rd., Sec. 1, Luzhu, Taoyuan City, Taiwan","website":"www.evaair.com","established":"1989"},{"id":6,"name":"Qantas","country":"Austrailia","logo":"https://upload.wikimedia.org/wikipedia/en/thumb/0/02/Qantas_Airways_logo_2016.svg/300px-Qantas_Airways_logo_2016.svg.png","slogan":"Spirit of Australia","head_quaters":"Mascot, Sydney, Australia","website":"qantas.com","established":"1920"}]';

    //         $airlines =json_decode($json_str, true);


    //         return $airlines;
    //     }
    // }




    //Fetching array from Airline Model. 
    //Probably should use a different controller for Storing resources
    public function showAll()
    {
        //
        // fetch, Array Operations...
        //
        $airlines = Airline::getAll();
        return $airlines;
    }




    // GET by ID METHOD 
    // // OLD: WE NEED TO USE ARRAY METHOD (THis Works)
    // public function showOne(string $id)
    // {
    //     $responseSingle = Http::get('https://api.instantwebtools.net/v1/airlines/' . $id);
    //     if ($responseSingle->ok()) {
    //         // If the request was successfull, convert data to a JSON
    //         $data = $responseSingle->json();
    //         // ...
    //         return $data;
    //     } else {

    //         return [
    //             "We couldn't fetch Single Airline"
    //         ];
    //     }
    // }


    //Fetching array from Airline Model. 
    //Probably should use a different controller for Storing resources 
    // and then find the lement in the array
    public function showOne($id)
    {
        $airline = Airline::getAll()->firstWhere('id', $id);
        return $airline;
    }


    // POST METHOD
    public function create(Request $request)
    {

        // we put alll values from our Postman request in $newAirline

        //PROOBLEM: SQLSTATE[42S02]: Base table or view not found: 1146 Table &#039;airplane_app.airlines&#039; doesn&#039;t exist (Connection: mysql, 
        // SQL: insert into `airlines` (`id`, `name`, `country`, `logo`, `slogan`, `head_quaters`, `website`, `established`, `updated_at`, `created_at`) 
        // values (12, Sri Lankan Airways, Sri Lanka, https://upload.wikimedia.org/wikipedia/en/thumb/9/9b/Qatar_Airways_Logo.svg/sri_lanka.png, From Sri Lanka,
        //  Katunayake, Sri Lanka, www.srilankaairways.com, 1990, 2023-03-10 02:33:39, 2023-03-10 02:33:39)) in file /var/www/html/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 760 
        
        // Im guessing I need a proper Database to save it

        $newAirline = new Airline();
        $newAirline->id=$request->id;
        $newAirline->name=$request->name;
        $newAirline->country=$request->country;
        $newAirline->logo=$request->logo;
        $newAirline->slogan=$request->slogan;
        $newAirline->head_quaters=$request->head_quaters;
        $newAirline->website=$request->website;
        $newAirline->established=$request->established;
        //$request->all();
        $result = $newAirline->save();
        
        if ($result) {

            //We return this new Airline with a Created Status
            return response($newAirline, 201);
        } else {
            return ["Result" => "Something went wrong"];
        }
    }

    // PUT METHOD: Problem: my base array form AirlineModels is fake and tiny, 
    // it would work only with the first 6 since im not triggering getAll

    public function editName(Request $request, string $id,)
    {
        $airline = Airline::findOrFail($id);

        $airline->name = $request->input('name');

        $result = $airline->save();

        if ($result) {

            //We return this new Airline with a Created Status
            return response($airline, 201);
        } else {
            return ["Result" => "Something went wrong with the Name Change"];
        }
    }
}
