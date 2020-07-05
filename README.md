# SimpleLayersPHP
Simple Class for that takes images (jpgs or pngs) and allows us to combine them just as layers in photoshop.

You add new image as layer (you can move that image and scale it)

    
    $layers=new SimpleLayers();

    $layers->addLayer("coast-1564063_640.jpg","Coast");
    
    
    
Now you can add layer with more options

    $layers->addLayer($filename,$layerName,$width,$height,dX,dY);
    
    
You can print layers that you actually have
        
        $layers->printLayers(); 
        
Outputs for example

```php
        Array
        (
        [Coast] => Array
            (
                [path] => coast-1564063_640.jpg
                [layerName] => Coast
                [width] => 0
                [height] => 0
                [deltaX] => 0
                [deltaY] => 0
            )

        [Circle] => Array
            (
                [path] => circle.png
                [layerName] => Circle
                [width] => 0
                [height] => 0
                [deltaX] => 79
                [deltaY] => 1
            )

        )
```

When we added all layers (images) we can combine them

        $layers->combineLayers();

This creates Resource within object that we can use later.

Now we can output image that we want
        
        $layers->saveAsImg("outputImages/output1.jpg");



Also we can pass output from created layers (after combineLayers method) to new layers object

```php
$layers2=new SimpleLayers($layers->getOutput());

$layers2->addLayer("rectangle.png","Rectangle",0,0,0,162);

$layers2->combineLayers();

$layers2->saveAsImg("outputImages/output2.jpg");
```


    


    
    
    
