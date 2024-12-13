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
            <?php
            //View logic
            require_once("templates/pages/$page.php");
            ?>
        </div>
        
    </div>

    <div class="footer">
        Stopka
    </div>

</body>



</html>