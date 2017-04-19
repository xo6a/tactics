<?php
$this->title = 'Create room';
?>
<div><label>Название<br><input type="text" name="name" class="form-control"></label></div>
<div>
    <label>Карта<br>
        <select class="form-control">
            <option value="custom">Своя</option>
            <option value="12312312312">Тест дом</option>
        </select>
    </label>
    <label>Своя<br><input type="text" name="map" class="form-control"></label></div>
<div>
    <h2>Команда А</h2>
    <?php
    foreach ($uTypes as $uType) {
        /* @var $uType tactics\UnitClass */
        ?>
        <button class="btn btn-success" js="add-unit" data-unit-class="<?=$uType->id?>" data-unit-name="<?=$uType->name?>"><?=$uType->name?> <strong>+</strong></button>
        <?php
    }
    ?>
    <ol js-target="team-a"></ol>
</div>
