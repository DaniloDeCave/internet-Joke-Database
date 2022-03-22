<div class="container-fluid container-jokes">
<<<<<<< HEAD
<?php $route?>
=======
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
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


<<<<<<< HEAD
            <form action="index.php?route=joke/delete" method ="post">
                <input type="hidden" name="id" value="<?=$joke['id']?>">
                <a class="btn btn-sm btn-outline-primary me-2" href="index.php?route=joke/edit&id=<?=$joke['id']?>">Edit</a>
=======
            <form action="/joke/delete" method ="post">
                <input type="hidden" name="id" value="<?=$joke['id']?>">
                <a class="btn btn-sm btn-outline-primary me-2" href="/joke/edit?id=<?=$joke['id']?>">Edit</a>
>>>>>>> d114055bd114124502be3663ea0fbbbff02cda87
                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
            </form>
        </p>
    </blockquote>
<?php endforeach;?>
</div>



