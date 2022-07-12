<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body{
            
            padding:0px;
            margin: 0px;
            overflow: hidden;
        }
        .viewerr{
            background-color: unset;
            width: 100vw;
            height: 100vh;  
            
        }
        .nav-container{
            position: absolute;

        }
        .nav-container{
            padding: 2%;
        }
    </style>
</head>
<body>
    <!-- <div class="nav-container">
        <nav class="navigation">
        <img class="logo" src="luminar-logo.png" width="100px" height="auto">

        </nav>
    </div> -->
    <script type="module" src="model-viewer.js"></script>
    <model-viewer class="viewerr" alt="TESTE" src="model.gltf" ar ar-modes="webxr scene-viewer quick-look" environment-image="sky.hdr"  shadow-intensity="1" camera-controls enable-pan></model-viewer>
    



</body>
</html>