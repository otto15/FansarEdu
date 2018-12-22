var i = 1;
var j = 1
$(".btn-to-add-more-terms").click(function () {
    i++;
    var term_form = '<div class="row single-term">\n' +
        '                    <div class="col-3">\n' +
        '                        <label for="term">Термин №' + i + '</label>\n' +
        '                        <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                    <div class="col-9">\n' +
        '                        <label for="definition">Определение</label>\n' +
        '                        <textarea id="definition" class="form-control" placeholder="Определение"></textarea>\n' +
        '                    </div>\n' +
        '                </div>';
    $(".terms").append(term_form);
    $(".single-term").css('margin-top', '40px');
});

$(".btn-to-add-more-quest").click(function () {
    j++;
    var quest_form = '<div class="quest  single-quest">' +
        '                  <div class="form-group">\n' +
        '                    <label for="add_question">Добавить задание №' + j + ' и варианты ответа</label>\n' +
        '                    <input type="text" id="add_question" class="form-control" placeholder="1 + 1 = ?">\n' +
        '                </div>\n' +
        '                <div class="row">\n' +
        '                    <div class="col">\n' +
        '                        <label for="term">Вариант №1</label>\n' +
        '                        <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                    <div class="col">\n' +
        '                        <label for="term">Вариант №2</label>\n' +
        '                        <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                    <div class="col">\n' +
        '                        <label for="term">Вариант №3</label>\n' +
        '                        <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                    <div class="col">\n' +
        '                        <label for="term">Вариант №4</label>\n' +
        '                        <input type="text" id="term" class="form-control" placeholder="Термин">\n' +
        '                    </div>\n' +
        '                </div>' +
        '              </div>';
    $(".quest-list").append(quest_form);
    $(".single-quest").css('margin-top', '40px');
});

$(".btn-submit").click(function () {
    $(".first-term").addClass("single-term");
    $(".first-quest").addClass("single-quest");
});
