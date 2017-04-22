jQuery(document).ready(function ($) {

    var
        template = {},
        spinner = new Spinner(),
        api = new Api();

    template['unit'] = '<li class="team_unit"><input type="text" value="#nickname#" class="form-control input-sm team_unit__input w150"> <span class="team_unit__class">#name#</span> <button type="button" class="btn btn-danger btn-xs" js="remove-unit">X</button></li>';

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
        spinner.show();
        //prepare data
        //todo
        var params = {
            action:'create-room',
            afterCallback:spinner.hide
        };
        //send data
        api.send(params);
    });

});