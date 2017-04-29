<?php
use yii\helpers\Url;

$this->title = 'Create room';

function generateRoomName()
{
    return 'Room ' . date('Y-m-d H:m:s');
}
?>
<form action="<?= Url::to(['tactics/saveroom']);?>" method="post">

<h2>Комната</h2>
<div><label>Название<br><input type="text" name="name" class="form-control" value="<?=generateRoomName()?>"></label></div>
<div>
    <label>Карта<br>
        <select class="form-control">
            <option value="custom">Своя</option>
            <option value="12312312312">Тест дом</option>
        </select>
    </label>
    <label>Своя<br><input type="text" name="map" class="form-control"></label>
</div>

<h2>Команда А</h2>
<div>
    <div>
        <label>
            Пароль<br>
            <input type="text" id="team_a_pass" name="team_a_pass" class="form-control team_unit__input">
        </label>
        <label>
            Цвет<br>
            <select class="form-control" name="team_a_color">
                <option value="red">Красный</option>
                <option value="red">Синий</option>
            </select>
        </label>
    </div>
    <?php
    foreach ($uTypes as $uType) {
        /* @var $uType tactics\UnitClass */
        ?>
        <button class="btn btn-success" js="add-unit" data-team="team-a" data-unit-class="<?=$uType->id?>" data-unit-name="<?=$uType->name?>"><?=$uType->name?> <strong>+</strong></button>
        <?php
    }
    ?>
    <ol js-target="team-a"></ol>
</div>

<h2>Команда Б</h2>
<div>
    <div>
        <label>
            Пароль<br>
            <input type="text" id="team_b_pass" name="team_b_pass" class="form-control team_unit__input">
        </label>
        <label>
            Цвет<br>
            <select class="form-control" name="team_b_color">
                <option value="red">Синий</option>
                <option value="red">Красный</option>
            </select>
        </label>
    </div>
    <?php
    foreach ($uTypes as $uType) {
        /* @var $uType tactics\UnitClass */
        ?>
        <button class="btn btn-success" js="add-unit" data-team="team-b" data-unit-class="<?=$uType->id?>" data-unit-name="<?=$uType->name?>"><?=$uType->name?> <strong>+</strong></button>
        <?php
    }
    ?>
    <ol js-target="team-b"></ol>
</div>

<br>

<div>
    <input type="hidden" js="units" name="units">
    <input type="submit" class="btn btn-primary" js="create-room" value="Создать">
</div>

</form>

