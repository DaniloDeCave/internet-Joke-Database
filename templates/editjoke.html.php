<form action="" method="get">
    <input type="hidden" name="jokeid" value="<?=joke['id']?>">
    <label for="joketext">Type your Joke here :</label>
    <textarea name="joketext" id="joketext" cols="40" rows="3"><?=joke['joketext']?></textarea>
    <input type="submit" name="submit" value="Save">
</form>