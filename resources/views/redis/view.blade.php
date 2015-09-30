<html>
    <head>
        <meta charset="UTF-8">
        <title>Test crawler</title>
    </head>
    <body>
        <img src="<?php echo $data['url'] ?>">
        <ul>
            <li>Instagram ID: <?php echo $data['id'] ?></li>
            <li>Latitude: <?php echo $data['latitude'] ?></li>
            <li>Longitude: <?php echo $data['longitude'] ?></li>
            <li>Created Time: <?php echo $data['created_time'] ?></li>
            <li>S3 Directory: <?php echo $data['s3file'] ?></li>
        </ul>
    </body>
</html>