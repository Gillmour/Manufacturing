<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="My ERP">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="Gillmour Inc." content="The conscience">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/test.css">


    <title>My ERP</title>
</head>
<body>
    <div id="header">
        <?php
        include './include/top_header.php';
        ?>
    </div>
    <div calss="wrapper">
        <div id="navigation">
            <?php
            include './include/listOrders.php';
            ?>

        </div>

        <div id="content">	        
            <?php
            include 'body.php';
            ?>	        
        </div>

    </div>
    <div id="footer">
        <?php
        include './include/footer.php';
        ?> 
    </div>
