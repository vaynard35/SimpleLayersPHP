<?php 

class SimpleLayers {


private $layers=array();

private $output; //output resource, it can be helpfull to init class with it to quicken computations


function __construct($output=0){


$this->output=$output;

}


public function addLayer($path,$layerName,$width=0,$height=0,$deltaX=0,$deltaY=0){

    //check if layer name existst. If so , add counter to distinguish layers

    $sufix="";

    $l=2;
    while(isset($this->layers[$layerName.$sufix])) {$sufix="-".$l;$l++;}

    $newLayerName=$layerName.$sufix;

	$this->layers[$newLayerName]=array(
	"path"=>$path,
	"layerName"=>$newLayerName,
	"width"=>$width,
	"height"=>$height,
	"deltaX"=>$deltaX,
	"deltaY"=>$deltaY
	);




}


public function removeLayer($layerName){

	unset ($this->layers[$layerName]);

}


public function printLayers(){


 print("<pre>".print_r($this->layers,true)."</pre>");


}



public function combineLayers(){


  




$layers=$this->layers;

$output=$this->output;

$i=0;


foreach ($layers as $name=>$layer):

	

    $url=$layer["path"];
   


    $type=$this->getFileExtension($url);



    


    if($type=='jpg') $layerImg=imagecreatefromjpeg($url); 
    if($type=='png') {$layerImg=imagecreatefrompng($url);imagealphablending($layerImg, true); imagesavealpha($layerImg, true); }

    $width=imagesx($layerImg);
    $height=imagesy($layerImg);


    if($width!=$layer['width'] && $layer['width']!=0 && isset($layer['width']) ) 
    {
        $width=$layer['width'];
        $height=$layer['height'];

        $layerImg=imagescale($layerImg,$width);


    }


    if(isset($layer['deltaX'])) $deltaX=$layer['deltaX']; else $deltaX=0;
    if(isset($layer['deltaY'])) $deltaY=$layer['deltaY']; else $deltaY=0;


    if($i==0 && !$output) 

    	{  
    		 $output=$layerImg; 

             

             
    	} 
    else 
    	{
        
 

        
        imagecopy($output, $layerImg, $deltaX, $deltaY, 0, 0, $width, $height);


        
    	}








    
$i++;

endforeach;


$this->output=$output;




}



public function setOutput($output){

	$this->output=$output;
}


public function getOutput(){


	return $this->output;

}




public function saveAsImg($destinationFile){

    


    $ext=$this->getFileExtension($destinationFile);

    if($ext=='png') $saveFunction="imagepng"; else $saveFunction="imagejpeg";


	if($this->output){$saveFunction($this->output, $destinationFile); return true;} else return false;


}





function getFileExtension($filename){

    $pathParts=pathinfo($filename);


    $ext=strtolower($pathParts["extension"]);

    if($ext=='png') return 'png'; else return 'jpg';


}




}



