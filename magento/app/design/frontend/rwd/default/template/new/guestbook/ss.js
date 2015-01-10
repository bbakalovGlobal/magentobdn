var ques = prompt('Кто пришел?', '');

if (ques == "Админ") {

    var pass = prompt('Пароль?', '');

    if (pass == 'Чёрный Властелин') {
        alert('Добро пожаловать');
    } else if (pass == null) {
        alert('Неверный пароль');
    } else {
        alert('Вход отменён');
    }
} else if (ques == null) {
    alert('Вход отменён');
} else {
    alert('Я вас не знаю');
}

var userName = prompt('Кто пришёл?', '');

if (userName == 'Админ') {

    var pass = prompt('Пароль?', '');

    if (pass == 'Чёрный Властелин') {
        alert('Добро пожаловать!');
    } else if (pass == null) {
        alert('Вход отменён');
    } else {
        alert('Пароль неверен');
    }

} else if (userName == null) {
    // Обратите внимание: пустая строка не равна null,
    // т.е. проверка value == null обрабатывает именно нажатие "Отмена"
    alert('Вход отменён');

} else {

    alert('Я вас не знаю');

}