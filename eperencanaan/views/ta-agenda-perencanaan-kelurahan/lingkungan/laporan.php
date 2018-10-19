<?php ?>

<html>
    <head>
        <style>
            body{
                background-image: url("img/background.jpg");
                background-image-resize: 6;
                font-family: Arial,sans-serif;
                font-size: 37pt;
                
            }
            br{
                line-height: 0px;
                font-size: 1pt;
            }
        </style>
    </head>
    <body >
        <br><br><br><br><br><br>
        <div style="font-size: 28pt;line-height: 140%";color: #010101;>&thinsp;&thinsp;<?php echo strtoupper($model->Nm_Lingkungan); ?></div>
        <div style="font-size: 28pt;line-height: 60%";color: #010101;>&thinsp;&thinsp;KELURAHAN <?php echo strtoupper($model->kelurahan->Nm_Kel); ?></div>
        <div style="font-size: 28pt;color: #010101;">&thinsp;&thinsp;KECAMATAN <?php echo strtoupper($model->kecamatan->Nm_Kec); ?></div>
        
    </body>
</html>