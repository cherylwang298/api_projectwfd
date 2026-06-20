<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Airline;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [
            // Indonesia
            ['name' => 'Garuda Indonesia', 'code' => 'GA'],
            ['name' => 'Citilink', 'code' => 'QG'],
            ['name' => 'Lion Air', 'code' => 'JT'],
            ['name' => 'Batik Air', 'code' => 'ID'],
            ['name' => 'Wings Air', 'code' => 'IW'],
            ['name' => 'Super Air Jet', 'code' => 'IU'],
            ['name' => 'Indonesia AirAsia', 'code' => 'QZ'],
            ['name' => 'Pelita Air', 'code' => 'IP'],
            ['name' => 'Sriwijaya Air', 'code' => 'SJ'],
            ['name' => 'NAM Air', 'code' => 'IN'],
            ['name' => 'TransNusa', 'code' => '8B'],
            ['name' => 'Susi Air', 'code' => 'SI'],
            ['name' => 'Trigana Air', 'code' => 'IL'],
            ['name' => 'Aviastar', 'code' => 'MV'],

            // Singapore
            ['name' => 'Singapore Airlines', 'code' => 'SQ'],
            ['name' => 'Scoot', 'code' => 'TR'],
            ['name' => 'Jetstar Asia', 'code' => '3K'],

            // Malaysia
            ['name' => 'Malaysia Airlines', 'code' => 'MH'],
            ['name' => 'AirAsia', 'code' => 'AK'],
            ['name' => 'Firefly', 'code' => 'FY'],
            ['name' => 'Batik Air Malaysia', 'code' => 'OD'],

            // Thailand
            ['name' => 'Thai Airways', 'code' => 'TG'],
            ['name' => 'Thai AirAsia', 'code' => 'FD'],
            ['name' => 'Bangkok Airways', 'code' => 'PG'],
            ['name' => 'Thai Lion Air', 'code' => 'SL'],

            // Vietnam
            ['name' => 'Vietnam Airlines', 'code' => 'VN'],
            ['name' => 'VietJet Air', 'code' => 'VJ'],
            ['name' => 'Bamboo Airways', 'code' => 'QH'],

            // Philippines
            ['name' => 'Philippine Airlines', 'code' => 'PR'],
            ['name' => 'Cebu Pacific', 'code' => '5J'],
            ['name' => 'AirAsia Philippines', 'code' => 'Z2'],

            // Japan
            ['name' => 'Japan Airlines', 'code' => 'JL'],
            ['name' => 'All Nippon Airways', 'code' => 'NH'],
            ['name' => 'Peach Aviation', 'code' => 'MM'],
            ['name' => 'Jetstar Japan', 'code' => 'GK'],

            // South Korea
            ['name' => 'Korean Air', 'code' => 'KE'],
            ['name' => 'Asiana Airlines', 'code' => 'OZ'],
            ['name' => 'Jeju Air', 'code' => '7C'],
            ['name' => 'Jin Air', 'code' => 'LJ'],
            ['name' => 'Tway Air', 'code' => 'TW'],

            // China
            ['name' => 'Air China', 'code' => 'CA'],
            ['name' => 'China Eastern Airlines', 'code' => 'MU'],
            ['name' => 'China Southern Airlines', 'code' => 'CZ'],
            ['name' => 'Hainan Airlines', 'code' => 'HU'],
            ['name' => 'XiamenAir', 'code' => 'MF'],

            // Taiwan
            ['name' => 'EVA Air', 'code' => 'BR'],
            ['name' => 'China Airlines', 'code' => 'CI'],
            ['name' => 'Starlux Airlines', 'code' => 'JX'],

            // Middle East
            ['name' => 'Emirates', 'code' => 'EK'],
            ['name' => 'Qatar Airways', 'code' => 'QR'],
            ['name' => 'Etihad Airways', 'code' => 'EY'],
            ['name' => 'Flydubai', 'code' => 'FZ'],
            ['name' => 'Saudia', 'code' => 'SV'],
            ['name' => 'Oman Air', 'code' => 'WY'],
            ['name' => 'Gulf Air', 'code' => 'GF'],
            ['name' => 'Kuwait Airways', 'code' => 'KU'],

            // Europe
            ['name' => 'Lufthansa', 'code' => 'LH'],
            ['name' => 'Swiss International Air Lines', 'code' => 'LX'],
            ['name' => 'Austrian Airlines', 'code' => 'OS'],
            ['name' => 'KLM', 'code' => 'KL'],
            ['name' => 'Air France', 'code' => 'AF'],
            ['name' => 'British Airways', 'code' => 'BA'],
            ['name' => 'Virgin Atlantic', 'code' => 'VS'],
            ['name' => 'Turkish Airlines', 'code' => 'TK'],
            ['name' => 'Finnair', 'code' => 'AY'],
            ['name' => 'Iberia', 'code' => 'IB'],
            ['name' => 'SAS', 'code' => 'SK'],
            ['name' => 'LOT Polish Airlines', 'code' => 'LO'],
            ['name' => 'TAP Air Portugal', 'code' => 'TP'],
            ['name' => 'Ryanair', 'code' => 'FR'],
            ['name' => 'easyJet', 'code' => 'U2'],
            ['name' => 'Wizz Air', 'code' => 'W6'],

            // North America
            ['name' => 'American Airlines', 'code' => 'AA'],
            ['name' => 'Delta Air Lines', 'code' => 'DL'],
            ['name' => 'United Airlines', 'code' => 'UA'],
            ['name' => 'Southwest Airlines', 'code' => 'WN'],
            ['name' => 'Alaska Airlines', 'code' => 'AS'],
            ['name' => 'JetBlue Airways', 'code' => 'B6'],
            ['name' => 'Air Canada', 'code' => 'AC'],
            ['name' => 'WestJet', 'code' => 'WS'],

            // Oceania
            ['name' => 'Qantas', 'code' => 'QF'],
            ['name' => 'Virgin Australia', 'code' => 'VA'],
            ['name' => 'Jetstar Airways', 'code' => 'JQ'],
            ['name' => 'Air New Zealand', 'code' => 'NZ'],

            // India
            ['name' => 'Air India', 'code' => 'AI'],
            ['name' => 'IndiGo', 'code' => '6E'],
            ['name' => 'Akasa Air', 'code' => 'QP'],
            ['name' => 'SpiceJet', 'code' => 'SG'],
        ];
        foreach($data as $d){
            Airline::create($d);
        }
    }
}
