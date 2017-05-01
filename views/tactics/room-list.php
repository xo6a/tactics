<?php
$this->title = 'Room list';

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
        <br>
        <br>
        <div>
            <div class="room_item__infoblock__label bg-primary">teams</div>
            <div class="room_item__infoblock__data">
                <?php
                foreach ($room->teams as $team){
                    ?>
                    <div class="team_row"><span>id <?=$team->id?></span><span>name <?=$team->name?></span><span>color <?=$team->color?></span> <button class="btn btn-xs btn-success">Войти</button></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
