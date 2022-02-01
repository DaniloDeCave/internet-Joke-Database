
<div class="container d-flex justify-content-center align-items-center form-container">
    <form action="" method="post">
        <div>
            <input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? '' ?>"> <!--nullcoalescing operator-->  
            <label for="joketext">Scrivi qui la tua barzelletta:</label>
        </div>
        <textarea name="joke[joketext]" id="joketext" cols="40" rows="3" required><?=$joke['joketext'] ?? '' ?></textarea>
        <br>
        <input type="submit" name="submit" value="Salva" class="btn btn-outline-success px-4 fw-bold">
    </form>
</div>
