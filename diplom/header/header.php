
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование столов в ресторане</title>
    <!-- Подключение стилей Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение шрифта Montserrat из Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Основные стили оставляем без изменений */
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Ваш логотип -->
        <a class="navbar-brand" href="../public/index.php"><img src="<?php echo "../uploads/BeLHotel@2x.png"?> " alt="Рестик" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href=" /diplom/public/Onas.php">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/diplom/public/reviews.php">Отзывы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/diplom/public/menu.php">Меню</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/diplom/public/contacts.php">Контакты</a>
                </li>
            </ul>
            <button class="btn btn-dark" onclick="goBack()">Вернуться на предыдущую страницу</button>
        </div>
    </div>
</nav>

<!-- Подключение скриптов Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript для перехода на предыдущую страницу -->
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
