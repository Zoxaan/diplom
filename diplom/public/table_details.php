<?php include "../header/header.php"; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('../uploads/shema-zala-restorana.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-color: rgba(255, 255, 255, 0.9);
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    .table-info {
        margin-top: 2%;
        border-radius: 10px;
        background-color: rgba(215, 215, 215, 0.8);
        float: right;
        width: calc(50% - 10px);
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table-img {
        margin-top: 2%;
        max-width: 50%;
        height: auto;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    p {
        color: black;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .table-info p {
        margin: 5px 0;
    }

    .table-info p strong {
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-book {
        background-color: #505050;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .btn-book:hover {
        background-color: #555;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: auto;
        max-width: 30%;
        height: auto;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 10px;
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

    #bookingForm {
        margin-top: 20px;
    }

    #bookingForm label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    #bookingForm input[type="text"],
    #bookingForm input[type="date"],
    #bookingForm input[type="time"] {
        width: calc(100% - 20px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #bookingForm button[type="submit"] {
        background-color: #1e1e1e;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    #bookingForm button[type="submit"]:hover {
        background-color: #555;
    }

    .menu-section {
        margin-top: 50px;
    }

    .menu-section h2 {
        font-size: 30px;
        margin-bottom: 20px;
    }

    .menu-section ul {
        list-style: none;
        padding: 0;
    }

    .menu-section ul li {
        margin-bottom: 10px;
    }

    .menu-section ul li a {
        font-size: 20px;
        color: #000000;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .menu-section ul li a:hover {
        color: #555;
    }

    footer {
        margin: inherit;
        border-radius: 8px;
        position: relative;
        bottom: 0;
        width: 100%;
        background-color: #9e9e9e;
        padding: 5px 0;
        text-align: center;
        opacity: 0.7;
        font-size: 12px;
    }

    .card-title {
        color: #000000;
    }


</style>
<div class="container">
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

    // Обработка отправки формы бронирования
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST['fullName'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $table_id = $_GET['id'];

        // Получаем время начала бронирования
        $bookingTime = date('Y-m-d H:i:s');

        // Соединяем дату и время бронирования
        $bookingDateTime = $date . ' ' . $time;

        // Получаем время окончания бронирования (выбранное время + 2 часа)
        $endTime = date('Y-m-d H:i:s', strtotime($bookingDateTime . '+2 hours'));

        // Обновление статуса стола на "забронированный" и сохранение времени начала и окончания бронирования
        $updateSql = "UPDATE tables SET status='забронированный', booking_time='$bookingTime', end_time='$endTime' WHERE id=$table_id";
        if ($conn->query($updateSql) === TRUE) {
            // Успешно обновлено
        } else {
            echo "Ошибка при обновлении статуса стола: " . $conn->error;
        }
    }

    // Получаем id стола из URL
    if (isset($_GET['id'])) {
        $table_id = $_GET['id'];

        // SQL запрос для выбора информации о столе по его id
        $sql = "SELECT *, TIME_FORMAT(end_time, '%H:%i') AS end_time FROM tables WHERE id=$table_id";
        $result = $conn->query($sql);
// SQL запрос для выборки всех отзывов
        $sql_reviews = "SELECT * FROM reviews";
        $result_reviews = $conn->query($sql_reviews);
        if ($result->num_rows > 0) {
            // Получаем данные о столе
            $row = $result->fetch_assoc();
            $name_table = $row["name_table"];
            $quantity = $row["quantity"];
            $status = $row["status"];
            $img = $row["img"];
            $description = $row["description"];
            $end_time = $row["end_time"]; // Время окончания бронирования

            // Выводим информацию о столе
            echo "<img class='table-img' src='../$img' alt='$name_table'>";
            echo "<div class='table-info'>";
            echo "<h1>$name_table</h1>";
            echo "<p><strong>Количество мест:</strong> $quantity</p>";
            echo "<p><strong>Статус:</strong> $status</p>";
            echo "<p><strong>Описание:</strong> $description</p>";

            // Выводим время окончания бронирования, если оно есть
            if (!empty($end_time)) {
                echo "<p><strong>Время окончания бронирования:</strong> $end_time</p>";
            }

            // Добавляем кнопку бронирования
            if ($status !== "забронированный") {
                echo "<button class='btn-book' onclick='openModal()'>Забронировать</button>";
            } else {
                echo "<p>Этот стол уже забронирован.</p>";
            }

            echo "<div id='successMessage' style='display: none;'>";
            echo "<p>Стол успешно забронирован!</p>";
            echo "<p>Ожидайте звонка от нас.</p>";
            echo "</div>";


        } else {
            echo "Стол с указанным ID не найден.";
        }
    } else {
        echo "ID стола не указан.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>
    <!-- Раздел с меню -->
    <div class="menu-section">
        <h2>Меню</h2>
        <ul>
            <li><a href="../public/menu.php">Желаете посмотреть меню</a></li>
        </ul>
    </div>
    <div class="reviews-container" style="max-height: 300px; overflow-y: auto;">
        <h3>Отзывы и оценки</h3>
        <?php
        if ($result_reviews->num_rows > 0) {
            while ($row = $result_reviews->fetch_assoc()) {
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                        <p class="card-text-p">Оценка: <?php echo $row["rating"]; ?>/5</p>
                        <p class="card-text-p"><?php echo $row["message"]; ?></p>
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
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Контактная информация</h5>
                    <p>Телефон: +7 (967) 663-30-96</p>
                    <p>Email: voladosas.05mail.ru</p>
                    <p>ул. Карла Либкнехта, 99/1</p>
                </div>
                <div class="col-md-6">
                    <h5>Режим работы</h5>
                    <p>Всегда: 10:00 - 22:00</p>
                </div>
            </div>
        </div>
    </footer>




    <!-- Модальное окно -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Бронирование столика</h2>
            <form id="bookingForm" method="post" action="" onsubmit="submitForm(event)">
                <label for="fullName">ФИО:</label>
                <input type="text" id="fullName" name="fullName" placeholder="Введите ваше ФИО" required>
                <label for="phone">Телефон:</label>
                <!-- Поле ввода номера телефона -->
                <input type="text" id="phone_number" name="phone" placeholder="Введите ваш номер телефона" maxlength="17" title="Пожалуйста, введите только цифры">
                <label for="date">Дата:</label>
                <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
                <label for="time">Время:</label>
                <input type="time" id="time" name="time" min="10:00" max="22:00" required>
                <button type="submit" class="btn-book">Забронировать</button>
            </form>
            <div id="successMessage" style="display: none;">
                <p>Стол успешно забронирован!</p>
                <p>Ожидайте звонка от нас.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script>
        function submitForm(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение формы

            // Получаем данные формы
            var formData = new FormData(document.getElementById("bookingForm"));

            // Отправляем данные на сервер через AJAX запрос
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // Пустая строка вместо URL, чтобы отправить на текущую страницу
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Обработка успешного ответа
                    document.getElementById("successMessage").style.display = "block";
                    closeModal(); // Закрываем модальное окно
                }
            };
            xhr.send(formData); // Отправляем данные формы
        }

        // Функция открытия модального окна
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.body.classList.add("blur"); // Добавляем класс blur к body
        }
        
            // Функция закрытия модального окна
            function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            document.body.classList.remove("blur"); // Удаляем класс blur из body
        }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var phoneInput = document.getElementById('phone_number');

            // Функция для форматирования и фильтрации номера телефона
            function formatAndFilterPhoneNumber(phoneNumber) {
                // Оставляем только цифры
                var cleaned = phoneNumber.replace(/\D/g, '');

                // Применяем нужный формат: (XXX) XXX-XX-XX
                var match = cleaned.match(/^(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})$/);
                var formatted = '';
                if (match[1]) {
                    formatted += match[1];
                }
                if (match[2]) {
                    formatted += ' (' + match[2];
                }
                if (match[3]) {
                    formatted += ') ' + match[3];
                }
                if (match[4]) {
                    formatted += ' ' + match[4];
                }
                if (match[5]) {
                    formatted += '-' + match[5];
                }
                return formatted;
            }

            // Обработчик события изменения введенного номера
            phoneInput.addEventListener('input', function() {
                var formatted = formatAndFilterPhoneNumber(this.value);
                this.value = formatted;
            });
        });

    </script>
