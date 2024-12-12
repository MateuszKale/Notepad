<?php

//declare(strict_types=1);

namespace App;
//import debug function dump()
require_once("src/Utils/debug.php");


$action = $_GET['action'] ?? null;

// if (!empty($_GET['action'])){
//     $action = $_GET['action'];
// } else{
//     $action == null;
// }



?>

<html>


<head>
</head>
        
<body>
    <div class="header">
        <h1>Moje notatki</h1>
    </div>
        
    <div class="conainter">
        <div class="menu">
            <ul>
                <li>
                    <a href="/">Lista notatek</a>
                </li>
                <li>
                    <a href="/?action=create">Nowa notatka</a>
                </li>
            </ul>
        </div>

        <div>
            <?php if($action === 'create') : ?>
                <h3> nowa notatka </h3>
                <?php echo htmlentities($action) ?>
            <?php else : ?>
                <h4> lista notatek </h4>
                <?php echo htmlentities($action ?? '') ?>
            <?php endif ; ?>
        </div>
        
    </div>

    <div class="footer">

    </div>

</body>



</html>

