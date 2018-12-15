<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\Event;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$coord = new LatLng(['lat' => 3.465055, 'lng' => 98.672582]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
]);


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
    'draggable'=>true,
]);

// Provide a shared InfoWindow to the marker
/*$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content</p>'
    ])
);*/

// Add marker to the map
$map->addOverlay($marker);

$event = new Event([
	'trigger'=>'click',
	'js'=>"
    lt=event.latLng.lat().toFixed(6);
    ln=event.latLng.lng().toFixed(6);
    ltln=lt+','+ln;
    console.log(ltln);
",

]);
$m=$event->getEventJs('gmarker2');
$j="$(document).ajaxStop(function () {
".$m."
});
";
//print_r($m);
$map->appendScript($m);
//$this->registerJs($j, 4, 'my');

// Now lets write a polygon
$coords = [
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
    new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
    new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
];

$polygon = new Polygon([
    'paths' => $coords
]);

// Add a shared info window
$polygon->attachInfoWindow(new InfoWindow([
        'content' => '<p>This is my super cool Polygon</p>'
    ]));

// Add it now to the map
$map->addOverlay($polygon);


// Lets show the BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($bikeLayer->getJs());

// Display the map -finally :)
echo $map->display();

			