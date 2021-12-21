
<form action="" method="post">
    <input type="hidden" name="jokeid" value="<?=$joke['id'] ?? '' ?>"> <!--nullcoalescing operator-->  
    <label for="joketext">Type your Joke here :</label>
    <textarea name="joketext" id="joketext" cols="40" rows="3"><?=$joke['joketext'] ?? '' ?></textarea>
    <input type="submit" name="submit" value="Save">
</form>