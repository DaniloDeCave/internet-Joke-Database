<div class=" container-fluid bg-dark text-light sticky-top shadow">
    
    <h3 class="fw-bold text-uppercase">Benvenuto Utente</h3>
    <p>Barzellette nel database : <?=$totalJokes?> </p>

</div>

<div class="container-fluid container-jokes">
<?php foreach($jokes as $joke):?>
    <blockquote class="text-start">
        <p>
            <?php echo htmlspecialchars($joke['joketext'],ENT_QUOTES,'UTF-8')?>
            (by 
            <a 
                href="mailto:<?php echo htmlspecialchars($joke['email'],ENT_QUOTES,'UTF-8')?>
            ">
                <?php echo htmlspecialchars($joke['name'],ENT_QUOTES,'UTF-8')?>
            </a> on <?php 
            $date = new DateTime($joke['jokedate']);
            echo $date->format('d-m-Y');
            ?>  )


            <form action="index.php?action=delete" method ="post">
                <input type="hidden" name="id" value="<?=$joke['id']?>">
                <a class="btn btn-sm btn-outline-primary me-2" href="index.php?action=edit&id=<?=$joke['id']?>">Edit</a>
                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
            </form>
        </p>
    </blockquote>
<?php endforeach;?>
</div>
