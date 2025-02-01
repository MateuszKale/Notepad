<div class="show">
    <?php dump($params); ?>
    <ul>
        <li>Tytuł: <?php echo htmlentities($params['title']) ?></li>
        <li>Opis: <?php echo htmlentities($params['description']) ?></li>
    </ul>
</div>