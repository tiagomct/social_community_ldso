<?php

namespace App;

use App\Exceptions\UserIdCardNotFound;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class VotingLocation extends Model
{

    protected $fillable = [
        'district',
        'county',
        'parish'
    ];

    public static function findFromLocationArray($location_array)
    {
        return (new static)
            ->where('district', $location_array[0])
            ->where('county', $location_array[1])
            ->where('parish', $location_array[2])
            ->first();
    }

    public static function createFromLocationArray($location_array)
    {
        return self::create([
            'district' => $location_array[0],
            'county'   => $location_array[1],
            'parish'   => $location_array[2]
        ]);
    }

    public static function fromUser($user)
    {
        $client = new Client();
        $response = $client->post('https://www.recenseamento.mai.gov.pt/consulta.ashx', [
            'form_params' => [
                'nic' => $user->id_card,
                'dn'  => $user->birth_date->format('Ymd')
            ]
        ]);

        $needle1 = 'Freguesia / Distrito Consular:';
        $needle2 = '<span class="resulttext">';
        $needle3 = '</span>';
        $contents = $response->getBody()->getContents();

        if (stripos($contents, $needle1) === false) {
            throw new UserIdCardNotFound;
        }

        $sub_content = substr($contents, stripos($contents, $needle1));
        $sub_content = substr($sub_content, stripos($sub_content, $needle2) + strlen($needle2));
        $location = substr($sub_content, 0, strpos($sub_content, $needle3));
        $location_array = array_map('trim', explode('>', $location));

        $votingLocation = VotingLocation::findFromLocationArray($location_array);
        if (!$votingLocation) {
            $votingLocation = VotingLocation::createFromLocationArray($location_array);
        }

        return $votingLocation;
    }
}
