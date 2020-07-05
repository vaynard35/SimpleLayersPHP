<?php require  "../SimpleLayersClass.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//simple usage


$layers=new SimpleLayers();

$layers->addLayer("coast-1564063_640.jpg","Coast");
$layers->addLayer("coast-1564063_640.jpg","Coast"); //giving same name many times will give new layers "Coast-2","Coast-3" so on


$layers->addLayer("circle.png","Circle",0,0,79,1); //we move image by [79,1]pixels from upper left corner


$layers->printLayers(); //method shows us layers we have

$layers->combineLayers();//creates Resource object in class that stores our combined image

$layers->saveAsImg("outputImages/output1.jpg");



//we can pass output from created layers (after combineLayers method) to new layers object

$layers2=new SimpleLayers($layers->getOutput());

$layers2->addLayer("rectangle.png","Rectangle",0,0,0,162);

$layers2->combineLayers();

$layers2->saveAsImg("outputImages/output2.jpg");



//we can also merge pngs to get png, we also scale our rectangle img to 200x100

$layers3=new SimpleLayers();
//$layers3->addLayer("coast-1564063_640.jpg","Coast");
$layers3->addLayer("circle.png","Circle");
$layers3->addLayer("rectangle.png","Rectangle",200,100,100,150);
$layers3->combineLayers();
$layers3->saveAsImg("outputImages/output3.png");




