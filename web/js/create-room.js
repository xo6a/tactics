jQuery(document).ready(function ($) {

    var
        template = {};

    template['unit'] = '<li class="team-unit">#nickname# (#name#) <button type="button" class="btn btn-danger btn-xs" js="remove-unit">X</button></li>';

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
            nickname = generateNickname();

        unit = unit.replace('#class#', id);
        unit = unit.replace('#name#', name);
        unit = unit.replace('#nickname#', nickname);

        $('[js-target="team-a"]').append(unit);
    });

    $(document).on('click', '[js="remove-unit"]', function () {
        $(this).closest('li').remove();
        console.log('remove');
    });

});