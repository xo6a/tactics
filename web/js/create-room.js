jQuery(document).ready(function ($) {

    var
        template = {},
        spinner = new Spinner();

    template['unit'] = '<li class="team_unit" data-json=\'#json#\'><input type="text" value="#nickname#" class="form-control input-sm team_unit__input w150"> <span class="team_unit__class">#type#</span> <button type="button" class="btn btn-danger btn-xs" js="remove-unit">X</button></li>';

    function generateNickname() {
        var names = [
            'Петя',
            'Вася',
            'Федя',
            'Гена',
            'Ваня',
            'Валя',
        ];

        return names[Math.floor(Math.random()*names.length)];
    }

    $('[js="add-unit"]').click(function (e) {
        var
            class_id = $(this).data('unit-class'),
            type = $(this).data('unit-name'),
            unit = template['unit'],
            team = $(this).data('team'),
            nickname = generateNickname(),
            json = '{class:"'+class_id+'",nickname:"'+nickname+'",team:"'+team+'"}';

        e.preventDefault();

        unit = unit.replace('#class_id#', class_id);
        unit = unit.replace('#type#', type);
        unit = unit.replace('#nickname#', nickname);
        unit = unit.replace('#team#', team);
        unit = unit.replace('#json#', json);

        $('[js-target="' + team + '"]').append(unit);
    });

    $(document).on('click', '[js="remove-unit"]', function () {
        $(this).closest('li').remove();
    });

    function parseUnits(){
        var units = [];

        $('.team_unit').each(function (){
            units.push($(this).data('json'));
        });

        $('[js="units"]').val(units);
    }

    $('[js="create-room"]').click(function () {
        parseUnits();
    });

});