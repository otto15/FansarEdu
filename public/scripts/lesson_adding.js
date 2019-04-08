var i = 1, j = 1, d = 2;
$(".btn-to-add-more-terms").click(function () {
    i++;
    var term_form = '<div class="row single-term">\n' +
        '                    <div class="col-3">\n' +
        '                        <label for="term">Термин №' + i + '</label>\n' +
        '                        <input type="text" id="term" name="term[]" value="" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                    <div class="col-9">\n' +
        '                        <label for="definition">Определение</label>\n' +
        '                        <textarea id="definition" name="def[]" value="" class="form-control" placeholder="Определение"></textarea>\n' +
        '                    </div>\n' +
        '                </div>';
    $(".terms").append(term_form);
    $(".single-term").css('margin-top', '40px');
});

$(".btn-to-add-more-quest").click(function () {
    j++;
    var quest_form = '<div class="quest single-quest">\n' +
        '                    <div class="form-group">\n' +
        '                        <label for="add_question">Добавить задание №' + j +  ' и варианты ответа</label>\n' +
        '                        <input type="text" id="add_question" name="quest[]" class="form-control" placeholder="1 + 1 = ?">\n' +
        '                    </div>\n' +
        '                    <div class="row answer-list">\n' +
        '                        <div class="col">\n' +
        '                            <label for="term">Вариант ответа №1</label>\n' +
        '                            <input type="text" name="answers' + (j -1) + '[]" class="form-control" placeholder="2">\n' +
        '                            <input type="radio" value="0" name="isCorrect' + (j -1) + '">\n' +
        '                        </div>\n' +
        '                        <div class="col">\n' +
        '                            <label for="term">Вариант ответа №2</label>\n' +
        '                            <input type="text" name="answers' + (j -1) + '[]" class="form-control" placeholder="3">\n' +
        '                            <input type="radio" value="1" name="isCorrect' + (j -1) + '">\n' +
        '                        </div>\n' +
        '                        <!--<div class="col btn-to-add-more-choice row justify-content-end align-items-end">\n' +
        '                            <button type="button" class="btn btn-success">Добавить ещё варианты</button>\n' +
        '                        </div>-->\n' +
        '                        <div class="col">\n' +
        '                            <label for="term">Вариант ответа №3</label>\n' +
        '                            <input type="text" name="answers' + (j -1) + '[]" class="form-control" placeholder="4">\n' +
        '                            <input type="radio" value="2" name="isCorrect' + (j -1) + '">\n' +
        '                        </div>\n' +
        '                        <div class="col">\n' +
        '                            <label for="term">Вариант ответа №4</label>\n' +
        '                            <input type="text" name="answers' + (j -1) + '[]" class="form-control" placeholder="5">\n' +
        '                            <input type="radio" value="3" name="isCorrect' + (j -1) + '">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>';
    $(".quest-list").append(quest_form);
    $(".single-quest").css('margin-top', '40px');
});

$(".btn-submit").click(function () {
    $(".first-term").addClass("single-term");
    $(".first-quest").addClass("single-quest");
});

$('.btn-to-add-more-choice').click(function () {
    var choice_form = '<div class="col">\n' +
        '                            <label for="term">Неправильный вариант №' + d + '</label>\n' +
        '                            <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                        </div>';
    if (d < 4){
        /*$('.answer-list').append(choice_form);*/
        $('.btn-to-add-more-choice').before(choice_form);
        d++;
        if (d == 4){
            $('.btn-to-add-more-choice').css('visibility', 'hidden');
            $('.btn-to-add-more-choice').css('position', 'absolute');
            $('.btn-to-add-more-choice').css('width', '0');
        }
    }
});
