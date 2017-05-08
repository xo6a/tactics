<?php
$this->title = 'Room list';

/** @var $rooms \tactics\Room[]*/
if (count($rooms) == 0) {
    ?>
    <div>
        Комнат не создано.
    </div>
    <?php
}

foreach ($rooms as $room) {
    /* @var $room tactics\Room */
    ?>
    <div class="room_item">
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">id</div>
            <div class="room_item__infoblock__data"><?=$room->id?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">name</div>
            <div class="room_item__infoblock__data"><?=$room->name?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">turn</div>
            <div class="room_item__infoblock__data"><?=$room->turn?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">id</div>
            <div class="room_item__infoblock__data"><?=$room->id?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">state</div>
            <div class="room_item__infoblock__data"><?=$room->state?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary">last update</div>
            <div class="room_item__infoblock__data"><?=$room->last_update?></div>
        </div>
        <div class="room_item__infoblock">
            <div class="room_item__infoblock__label bg-primary"><button class="btn btn-xs btn-success">Войти</button></div>
            <div class="room_item__infoblock__data">&nbsp;</div>
        </div>
        <br>
        <br>
        <div>
            <div class="room_item__infoblock__label bg-primary">teams</div>
            <div class="room_item__infoblock__data">
                <?php
                foreach ($room->teams as $team){
                    ?>
                    <div class="team_row">

                        <div class="room_item__infoblock">
                            <div class="room_item__infoblock__label bg-primary">id</div>
                            <div class="room_item__infoblock__data"><?=$team->id?></div>
                        </div>
                        <div class="room_item__infoblock">
                            <div class="room_item__infoblock__label bg-primary">name</div>
                            <div class="room_item__infoblock__data"><?=$team->name?></div>
                        </div>
                        <div class="room_item__infoblock">
                            <div class="room_item__infoblock__label bg-primary">color</div>
                            <div class="room_item__infoblock__data"><?=$team->color?></div>
                        </div>
                        <div class="room_item__infoblock">
                            <form action="<?= yii\helpers\Url::to(['tactics/enterroom']);?>" method="post">
                                <div class="room_item__infoblock__label bg-primary"><input type="submit" class="btn btn-xs btn-success" value="Войти" data-js="enter-room" data-js-target='[data-label="team_<?=$team->id?>"]'></div>
                                <div class="room_item__infoblock__data"><input type="text" name="pass" class="form-control team_unit__input team_unit__input--small" placeholder="пароль" data-label="team_<?=$team->id?>"></div>
                                <input type="hidden" name="room" value="<?=$room->id?>">
                                <input type="hidden" name="team" value="<?=$team->id?>">
                            </form>
                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>

