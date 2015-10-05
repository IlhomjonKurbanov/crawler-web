<html>
    <head>
        <meta charset="UTF-8">
        <title>Test crawler</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div id="container" style="max-width: 100%; margin: 0 auto">
            <div id="left" style="float: left">
                <img src="<?php echo $data['url'] ?>">
            </div>
            <div id="right" style="float: left">
                <table style="width:100%;" border = "1">
                    <tr>
                        <td>Instagram ID:</td>
                        <td><?php echo $data['id'] ?></td> 
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><?php echo $data['user:username'] ?></td> 
                    </tr>
                    <tr>
                        <td>Latitude:</td>
                        <td><?php echo $data['latitude'] ?></td> 
                    </tr>

                    <tr>
                        <td>Longitude: </td>
                        <td><?php echo $data['longitude'] ?></td> 
                    </tr>
                    <tr>
                        <td>Created Time:</td>
                        <td><?php echo $data['created_time'] ?></td> 
                    </tr>
                    <tr>
                        <td>S3 Directory:</td>
                        <td><?php echo $data['s3file'] ?></td> 
                    </tr>

                </table> 

            </div>
        </div>
    </body>
</html>