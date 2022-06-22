<?php
if(!empty($errors)):?>
<div class="bg-danger text-light">
    <p>Il tuo account non può esser creato:</p>
    <p>risolvi i seguenti errori:</p>
    <ul class="errorList">
        <?php 
            foreach($errors as $error):?>
            <li><?=$error?></li>
            <?php endforeach; ?>
    </ul>
</div>
<?php endif;?>

<div class="container ">
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome :</label>
            <input type="text" class="form-control" name="author[name]" id="nome" aria-describedby="nome" value='<?=$author['name']??''?>'>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" name="author[email]" id="email" aria-describedby="email" value='<?=$author['email']??''?>'>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="author[password]" id="password" value='<?=$author['password']??''?>'>
        </div>
        <button type="submit" class="btn btn-primary">Registrati</button>
    </form>
</div>

