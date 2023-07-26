<?php

namespace App\Services;
use Illuminate\Support\Arr;
use PHPCoord\CoordinateReferenceSystem\Geographic2D;
use PHPCoord\Point\GeographicPoint;
use PHPCoord\UnitOfMeasure\Angle\Degree;
use PHPCoord\UnitOfMeasure\Length\Kilometre;
use PHPCoord\UnitOfMeasure\Length\Length;

class GeolocationService
{
    private $geoSystem;
    private $originPoint;

    /**
     * @param $latitude
     * @param $longitude
     * @throws \PHPCoord\Exception\UnknownCoordinateReferenceSystemException
     */
    public function __construct($latitude,$longitude)
    {
        $this->geoSystem = Geographic2D::fromSRID(Geographic2D::EPSG_WGS_84);
        $this->originPoint = GeographicPoint::create(
            $this->geoSystem,
            new Degree($latitude),
            new Degree($longitude),
            null
        );
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return string
     */
    private function calculateDistance($latitude,$longitude) :string
    {
        $to = GeographicPoint::create(
            $this->geoSystem,
            new Degree($latitude),
            new Degree($longitude),
            null
        );

        $length =  $this->originPoint->calculateDistance($to);
        // convert into KM.
        return (string)$length->asMetres() / 1000;
    }


    public function filterAffiliatesByDistFile(string $path,int $distance)
    {
        $data = file_get_contents($path);
        $data = '['.str_replace(PHP_EOL,',', $data).']';
        $data = json_decode($data,true);

        $affiliates= [];

        foreach ($data as $affliate){
            $dist = $this->calculateDistance($affliate['latitude'],$affliate['longitude']);
            if((float)$dist <= (float)$distance)
            {
                $affliate['distance'] = $dist;
                $affiliates[] = $affliate;
            }
        }
        $affiliates = array_values(Arr::sort($affiliates, function (array $value) {
            return $value['distance'];
        }));

        return $affiliates;
    }


}
