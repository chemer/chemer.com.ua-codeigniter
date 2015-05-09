<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Upload Success</title>
    </head>
    <body>
        <h3 style="color: green">Upload Success</h3>
        <ul style="list-style-type:none; padding: 0;">
            <?php
                foreach ($upload_data as $key => $value) {
                    printf('<li>%s => %s</li>', $key, $value);
                }
            ?>
        </ul>
        <a href="<?php echo $sender;?>" style="text-decoration: none;"><b>COME BACK</b></a>
    </body>
</html>
