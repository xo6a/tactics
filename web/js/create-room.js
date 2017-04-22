jQuery(document).ready(function ($) {

    var
        template = {};

    template['unit'] = '<li class="team_unit"><input type="text" value="#nickname#" class="form-control input-sm team_unit__input"> (#name#) <button type="button" class="btn btn-danger btn-xs" js="remove-unit">X</button></li>';

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

    $('[js="add-unit"]').click(function () {
        var
            id = $(this).data('unit-class'),
            name = $(this).data('unit-name'),
            unit = template['unit'],
            team = $(this).data('team'),
            nickname = generateNickname();

        unit = unit.replace('#class#', id);
        unit = unit.replace('#name#', name);
        unit = unit.replace('#nickname#', nickname);

        $('[js-target="' + team + '"]').append(unit);
    });

    $(document).on('click', '[js="remove-unit"]', function () {
        $(this).closest('li').remove();
    });

    $('[js="create-room"]').click(function () {
        console.log('create-room');
    });

});