<?php include "../header/header.php"; ?>

<?php
// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "restoris";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка времени бронирования и обновление статуса столов при загрузке страницы
$sql_update_status = "UPDATE tables SET status = 'свободный', end_time = NULL WHERE status = 'забронированный' AND end_time < NOW()";
$conn->query($sql_update_status);

// Запрос на выборку данных о столах
$sql = "SELECT * FROM tables";
$result = $conn->query($sql);

// SQL запрос для выборки всех отзывов
$sql_reviews = "SELECT * FROM reviews";
$result_reviews = $conn->query($sql_reviews);

// SQL запрос для вычисления средней оценки ресторана
$sql_average_rating = "SELECT AVG(rating) AS avg_rating FROM reviews";
$result_average_rating = $conn->query($sql_average_rating);
$average_rating = 0;
if ($result_average_rating->num_rows > 0) {
    $row = $result_average_rating->fetch_assoc();
    $average_rating = $row["avg_rating"];
}
?>
<style>
    /* Стили для контейнера карточек ресторанов и отзывов */
    .restaurant-container {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .reviews-container {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        max-height: 400px; /* Максимальная высота контейнера для отзывов */
        overflow-y: auto; /* Включение вертикальной прокрутки, если контент превышает максимальную высоту */
    }

    /* Стили для карточек ресторанов */
    .restaurant-card {
        background-color: #d9d9d9;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .restaurant-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .restaurant-card img {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ddd;
    }

    .restaurant-card-body {
        padding: 20px;
    }

    h5 {
        color: black;
    }

    .restaurant-card-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .restaurant-card-description {
        text-color: black;
        font-size: 16px;
        color: #000000; /* Изменили цвет текста на черный */
    }

    body {
        background-image: url('../uploads/shema-zala-restorana.png'); /* URL изображения */
        background-size: cover;
        background-color: #ffffff;
        background-position: center;
        background-repeat: no-repeat;
        color: #000000; /* Изменили цвет текста на черный */
    }
    /* Стили для кнопок */
    .btn-primary {
        background-color: #000000;
        border-color: #000000;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #595959;
        border-color: #ffffff;
    }

    .welcome-banner {
        background-color: rgba(248, 249, 250, 0.7); /* Прозрачный цвет фона */
        padding: 20px 0; /* Внутренние отступы */
        text-align: center; /* Выравнивание текста по центру */
    }

    .welcome-text {
        color: #000; /* Цвет текста */
        font-size: 24px; /* Размер текста */
    }
    .overall-rating {
        margin-top: 20px;
        text-align: center;
    }

    .overall-rating span {
        font-size: 24px;
        color: #ffc107; /* Цвет звездочек */
    }
    /* Стили для модального окна */
    .modal {
        display: block; /* Показываем модальное окно */
        position: fixed; /* Фиксированное положение */
        z-index: 1000; /* Поверх всего контента */
        top: 50%; /* По вертикали по центру */
        transform: translateY(-50%); /* Выравниваем по вертикали по центру */
        right: 0; /* Выравниваем по правому краю */
        width: 300px; /* Ширина модального окна */
        border-radius: 8px;
        animation: slideInRight 0.5s ease forwards; /* Анимация появления */
    }

    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Анимация для появления справа */
    @keyframes slideInRight {
        from {
            right: -100%; /* Начальное положение за пределами экрана справа */
        }
        to {
            right: 0; /* Конечное положение, выравнивание справа */
        }
    }
    .booking-info {
        font-size: 18px;
        color: #000000; /* Изменили цвет текста на черный */
        text-align: center; /* Выравнивание текста по центру */
    }
    .booking-link {
        color: #007BFF; /* Цвет ссылки */
        text-decoration: none; /* Убираем подчеркивание */
    }

    .booking-link:hover {
        color: #0056b3; /* Цвет при наведении */
        text-decoration: underline; /* Добавляем подчеркивание при наведении */
    }
</style>
<body>
<div class="welcome-banner">
    <h2 class="welcome-text">Добро пожаловать в наш ресторан</h2>
    <p class="booking-info">Если вы хотите забронировать весь ресторан, <a href="contacts.php" class="booking-link">звоните здесь</a></p>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="restaurant-container">
                <h3>Столы в ресторане</h3>
                <div class="row">
                    <?php
                    // Проверка наличия данных
                    if ($result->num_rows > 0) {
                        // Вывод данных каждого стола в карточку
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-md-4">
                                <div class="restaurant-card">
                                    <!-- Загрузка изображения из базы данных -->
                                    <img src="../<?php echo $row["img"]; ?>" alt="<?php echo $row["name_table"]; ?>">
                                    <div class="restaurant-card-body">
                                        <!-- Вывод названия стола -->
                                        <h5 class="restaurant-card-title"><?php echo $row["name_table"]; ?></h5>
                                        <!-- Вывод описания стола -->
                                        <p class="restaurant-card-description"><?php echo $row["quantity"]; ?> мест. <?php echo $row["status"]; ?></p>
                                        <!-- Добавление кнопки для подробной информации -->
                                        <a href="table_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "0 результатов";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="reviews-container">
                <h3>Отзывы и оценки</h3>
                <?php
                // Проверка наличия данных
                if ($result_reviews->num_rows > 0) {
                    // Вывод данных каждого отзыва и оценки
                    while ($row = $result_reviews->fetch_assoc()) {
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                                <p class="card-text">Оценка: <?php echo $row["rating"]; ?>/5</p>
                                <p class="card-text"><?php echo $row["message"]; ?></p>
                            </div>
                        </div>
                        <br>
                        <?php
                    }
                } else {
                    echo "Пока нет отзывов.";
                }
                ?>
                <!-- Кнопка "Оставить отзыв" -->
                <a href="reviews.php" class="btn btn-primary">Оставить отзыв</a>
            </div>
        </div>
    </div>
</div>
<div class="overall-rating">
    <h3>Общая оценка ресторана:</h3>
    <?php
    // Округляем среднюю оценку ресторана до ближайшего целого числа
    $rounded_average_rating = round($average_rating);
    // Выводим звездочки в зависимости от округленной средней оценки
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rounded_average_rating) {
            echo "<span>&#9733;</span>"; // Звезда
        } else {
            echo "<span>&#9734;</span>"; // Пустая звезда
        }
    }
    ?>
</div>

<!-- Всплывающее окно -->
<div id="contactModal" class="modal right-slide">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Хотите связаться с нами? Перейдите по <a href="contacts.php">ссылке</a> здесь.</p>
    </div>
</div>

<script>
    // Получаем модальное окно
    var modal = document.getElementById("contactModal");

    // Получаем элемент для закрытия модального окна
    var closeButton = modal.querySelector(".close");

    // Закрываем модальное окно при клике на кнопку "Закрыть"
    closeButton.onclick = function() {
        modal.style.animation = "slideOutRight 0.5s ease forwards"; // Анимация закрытия
        setTimeout(function() {
            modal.style.display = "none"; // Скрываем окно после завершения анимации
        }, 500); // Задержка в миллисекундах, соответствующая длительности анимации
    };

    // Автоматически закрываем модальное окно через 10 секунд
    setTimeout(function() {
        modal.style.animation = "slideOutRight 0.5s ease forwards"; // Анимация закрытия
        setTimeout(function() {
            modal.style.display = "none"; // Скрываем окно после завершения анимации
        }, 500); // Задержка в миллисекундах, соответствующая длительности анимации
    }, 10000); // 10000 миллисекунд = 10 секунд

    // Закрываем модальное окно при клике вне его области
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.animation = "slideOutRight 0.5s ease forwards"; // Анимация закрытия
            setTimeout(function() {
                modal.style.display = "none"; // Скрываем окно после завершения анимации
            }, 500); // Задержка в миллисекундах, соответствующая длительности анимации
        }
    };

</script>
<?php include "../footer/footer.php"; ?>
</body>
