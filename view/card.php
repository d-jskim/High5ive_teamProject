<div id="<?=$i?>" class="cards">
    <input type="button" class="delete" name="delete" id="delete" value="X" disabled="true" />
    <span><h1><?=$card["title"]?></h1></span>
    <img src="<?=$card["poster"]?>" />
    <br /><br />
    <div id="info<?=$i?>" class="children-container">
        <p> Director: <?=$card["director"]?> <br>
            Actors: <?=$card["actors"]?>
        </p>
        </div>
    <span class="hand-logo" id="handOpen"><i class="far fa-hand-paper"></i></span>
    <span class="hand-logo" id="handClosed"><i class="far fa-hand-rock"></i></span>
</div>