<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Kantin & Restoran
            ['name' => "Bakmi Effata", 'floor_number' => 0],
            ['name' => "Cerita Cinta",  'floor_number' => 0],
            ['name' => "Rasa Sayange", 'floor_number' => 0],
            ['name' => "Chicken Oriental", 'floor_number' => 0],
            ['name' => "Good Waffle", 'floor_number' => 0],
            ['name' => "Rasela", 'floor_number' => 0],
            ['name' => "Yoshinoya", 'floor_number' => 0],
            ['name' => "Bicasa Coffee", 'floor_number' => 0],
            ['name' => "Yoshinoya", 'floor_number' => 1],
            ['name' => "Hokben", 'floor_number' => 1],
            ['name' => "A&W", 'floor_number' => 1],
            
            // Lantai 2
            ['name' => "Kelas 201", 'floor_number' => 2],
            ['name' => "Kelas 203", 'floor_number' => 2],
            
            // Lantai 3 
            ['name' => "Kelas 301", 'floor_number' => 3],
            ['name' => "Kelas 302", 'floor_number' => 3],
            ['name' => "Kelas 303", 'floor_number' => 3],
            ['name' => "Kelas 304",'floor_number' => 3],
            ['name' => "Kelas 305", 'floor_number' => 3],
            ['name' => "Kelas 306", 'floor_number' => 3],
            ['name' => "Kelas 307", 'floor_number' => 3],
            ['name' => "Kelas 308", 'floor_number' => 3],
            ['name' => "Kelas 309", 'floor_number' => 3],
            ['name' => "Kelas 310", 'floor_number' => 3],
            ['name' => "Kelas 311", 'floor_number' => 3],
            ['name' => "Kelas 312", 'floor_number' => 3],
            ['name' => "Kelas 313", 'floor_number' => 3],
            ['name' => "Kelas 314", 'floor_number' => 3],
            ['name' => "Kelas 315", 'floor_number' => 3],
            ['name' => "Kelas 321", 'floor_number' => 3],
            ['name' => "Kelas 322", 'floor_number' => 3],
            ['name' => "Kelas 323", 'floor_number' => 3],
            ['name' => "Kelas 324", 'floor_number' => 3],
            ['name' => "Kelas 325", 'floor_number' => 3],
            ['name' => "Kelas 326", 'floor_number' => 3],
            ['name' => "Kelas 327", 'floor_number' => 3],
            ['name' => "Kelas 328", 'floor_number' => 3],
            ['name' => "Kelas 329", 'floor_number' => 3],
            ['name' => "Kelas 330", 'floor_number' => 3],
            ['name' => "Kelas 330A", 'floor_number' => 3],

            // Lantai 4
            ['name' => "Kelas 401", 'floor_number' => 4],
            ['name' => "Kelas 402", 'floor_number' => 4],
            ['name' => "Kelas 403",'floor_number' => 4],
            ['name' => "Kelas 404", 'floor_number' => 4],
            ['name' => "Kelas 405", 'floor_number' => 4],
            ['name' => "Kelas 406", 'floor_number' => 4],
            ['name' => "Kelas 407", 'floor_number' => 4],
            ['name' => "Kelas 408", 'floor_number' => 4],
            ['name' => "Kelas 409", 'floor_number' => 4],
            ['name' => "Kelas 410",'floor_number' => 4],
            ['name' => "Kelas 411", 'floor_number' => 4],
            ['name' => "Kelas 412", 'floor_number' => 4],
            ['name' => "Kelas 413", 'floor_number' => 4],
            ['name' => "Kelas 414", 'floor_number' => 4],
            ['name' => "Kelas 415", 'floor_number' => 4],
            ['name' => "Kelas 421", 'floor_number' => 4],
            ['name' => "Kelas 422", 'floor_number' => 4],
            ['name' => "Kelas 423", 'floor_number' => 4],
            ['name' => "Kelas 424", 'floor_number' => 4],
            ['name' => "Kelas 425", 'floor_number' => 4],
            ['name' => "Kelas 426", 'floor_number' => 4],
            ['name' => "Kelas 427", 'floor_number' => 4],
            ['name' => "Kelas 428", 'floor_number' => 4],
            ['name' => "Kelas 429", 'floor_number' => 4],
            ['name' => "Kelas 430", 'floor_number' => 4],
            ['name' => "Kelas 431", 'floor_number' => 4],
            
            // Lantai 5
            ['name' => "Kelas 501", 'floor_number' => 5],
            ['name' => "Kelas 502", 'floor_number' => 5],
            ['name' => "Kelas 503", 'floor_number' => 5],
            ['name' => "Kelas 504", 'floor_number' => 5],
            ['name' => "Kelas 505", 'floor_number' => 5],
            ['name' => "Kelas 506", 'floor_number' => 5],
            ['name' => "Kelas 507", 'floor_number' => 5],
            ['name' => "Kelas 508", 'floor_number' => 5],
            ['name' => "Kelas 509", 'floor_number' => 5],
            ['name' => "Kelas 510", 'floor_number' => 5],
            ['name' => "Kelas 512", 'floor_number' => 5],
            ['name' => "Kelas 513", 'floor_number' => 5],
            ['name' => "Kelas 514", 'floor_number' => 5],
            ['name' => "Kelas 515", 'floor_number' => 5],
            ['name' => "Kelas 521", 'floor_number' => 5],
            ['name' => "Kelas 522", 'floor_number' => 5],
            ['name' => "Kelas 523", 'floor_number' => 5],
            ['name' => "Kelas 524", 'floor_number' => 5],
            ['name' => "Kelas 525", 'floor_number' => 5],
            ['name' => "Kelas 526", 'floor_number' => 5],
            ['name' => "Kelas 527", 'floor_number' => 5],
            ['name' => "Kelas 528", 'floor_number' => 5],
            ['name' => "Kelas 529", 'floor_number' => 5],

            // Lantai 6
            ['name' => "Kelas 601", 'floor_number' => 6],
            ['name' => "Kelas 602", 'floor_number' => 6],
            ['name' => "Kelas 603", 'floor_number' => 6],
            ['name' => "Kelas 604", 'floor_number' => 6],
            ['name' => "Kelas 605", 'floor_number' => 6],
            ['name' => "Kelas 606", 'floor_number' => 6],
            ['name' => "Kelas 607", 'floor_number' => 6],
            ['name' => "Kelas 608", 'floor_number' => 6],
            ['name' => "Kelas 609", 'floor_number' => 6],
            ['name' => "Kelas 610", 'floor_number' => 6],
            ['name' => "Kelas 621", 'floor_number' => 6],
            ['name' => "Kelas 622", 'floor_number' => 6],
            ['name' => "Kelas 623", 'floor_number' => 6],
            ['name' => "Kelas 624", 'floor_number' => 6],
            ['name' => "Kelas 625", 'floor_number' => 6],
            ['name' => "Kelas 626", 'floor_number' => 6],
            ['name' => "Kelas 627", 'floor_number' => 6],
            ['name' => "Kelas 628", 'floor_number' => 6],
            ['name' => "Kelas 629", 'floor_number' => 6],
            ['name' => "Kelas 630", 'floor_number' => 6],
            ['name' => "Kelas 631", 'floor_number' => 6],
            
            // Lantai 7
            ['name' => "Kelas 701", 'floor_number' => 7],
            ['name' => "Kelas 702", 'floor_number' => 7],
            ['name' => "Kelas 703", 'floor_number' => 7],
            ['name' => "Kelas 704", 'floor_number' => 7],
            ['name' => "Kelas 705", 'floor_number' => 7],
            ['name' => "Kelas 706", 'floor_number' => 7],
            ['name' => "Kelas 707", 'floor_number' => 7],
            ['name' => "Kelas 708", 'floor_number' => 7],
            ['name' => "Kelas 709", 'floor_number' => 7],
            ['name' => "Kelas 710", 'floor_number' => 7],
            ['name' => "Kelas 711A", 'floor_number' => 7],
            ['name' => "Kelas 711B",  'floor_number' => 7],
            ['name' => "Kelas 711C",  'floor_number' => 7],
            ['name' => "Kelas 721",  'floor_number' => 7],
            ['name' => "Kelas 722",  'floor_number' => 7],
            ['name' => "Kelas 723",  'floor_number' => 7],
            ['name' => "Kelas 724",  'floor_number' => 7],
            ['name' => "Kelas 725",  'floor_number' => 7],
            ['name' => "Kelas 727", 'floor_number' => 7],
            ['name' => "Kelas 729", 'floor_number' => 7],
            ['name' => "Kelas 730", 'floor_number' => 7],

            // Lantai 8
            ['name' => "Kelas 801", 'floor_number' => 8],
            ['name' => "Kelas 802", 'floor_number' => 8],
            ['name' => "Kelas 803", 'floor_number' => 8],
            ['name' => "Kelas 804", 'floor_number' => 8],
            ['name' => "Kelas 805", 'floor_number' => 8],
            ['name' => "Kelas 806", 'floor_number' => 8],
            ['name' => "Kelas 807", 'floor_number' => 8],
            ['name' => "Kelas 808", 'floor_number' => 8],
            ['name' => "Kelas 809", 'floor_number' => 8],
            ['name' => "Kelas 810", 'floor_number' => 8],
            ['name' => "Kelas 821", 'floor_number' => 8],
            ['name' => "Kelas 822", 'floor_number' => 8],
            ['name' => "Kelas 823", 'floor_number' => 8],
            ['name' => "Kelas 824", 'floor_number' => 8],
            ['name' => "Kelas 825", 'floor_number' => 8],
            ['name' => "Kelas 826", 'floor_number' => 8],
            ['name' => "Kelas 827", 'floor_number' => 8],
            ['name' => "Kelas 828", 'floor_number' => 8],
        ];

        foreach($locations as $location) {
            Location::create($location);
        }
    }
}
