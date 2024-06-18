<?php
include "../header/header.php";

// Функция для проверки наличия запрещенных слов в тексте
function check_forbidden_words($text, $forbidden_words) {
    $text_lower = mb_strtolower($text, 'UTF-8');
    foreach ($forbidden_words as $word) {
        $word_lower = mb_strtolower($word, 'UTF-8');
        if (mb_strpos($text_lower, $word_lower, 0, 'UTF-8') !== false) {
            return true;
        }
    }
    return false;
}

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

// Обработка отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $message = htmlspecialchars($_POST['message']);

    // Массив запрещенных слов
    $forbidden_words = array(
        "беспиздая","пидор","сука","хуесос","пидарас","пидарасина","шлюха","шалава","алкаш", "хуисос", "выблядок", "дрочизавр", "шваль", "уебище", "быдло",
        "ислам", "харам", "халяль", "проститутка", "гей", "геи",
        "бля", "блядва", "блядиада", "блядина", "блядистость", "блядки", "блядовать",
        "блядогон", "блядословник", "блядский", "блядство", "блядун", "блядь", "бляхомудия", "взбляд",
        "взъебнуть", "взъёбка", "взъёбывать", "взъебщик", "впиздить", "впиздиться", "впиздохать",
        "впиздохивать", "впиздохиваться", "впиздронивать", "впиздрониваться", "впиздюлить", "впиздячил",
        "впиздячить", "впизживать", "впизживаться", "вхуинуть", "вхуякаться", "вхуяриться", "вхуячиться",
        "вхуяшить", "выблядовал", "выблядок", "выебать", "выебок", "выебон", "выёбывается", "выпиздеться",
        "выпиздить", "выхуяривание", "выхуярить", "въебать", "въёбывать", "глупизди", "говноёб", "голоёбица",
        "греблядь", "дерьмохеропиздократ", "дерьмохеропиздократия", "доебался", "доебаться", "доёбывать",
        "долбоёб", "допиздеться", "дохуйнуть", "дохуякать", "дохуякивать", "дохуяривать", "дуровёб", "дядеёб",
        "ебалка", "ебло", "еблово", "ебальник", "ебанатик", "ебандей", "ебанёшься", "ебанул", "ебанулся",
        "ебануть", "ебануться", "ебанутый", "ебанько", "ебаришка", "ебаторий", "ебаться", "ебашит", "ебеня",
        "ебёт", "ебистика", "еблан", "ебланить", "ебливая", "ебля", "ебукентий", "ёбака", "ёбаный", "ёбарь",
        "ёбкость", "ёбля", "ёбнул", "ёбнуться", "ёбнутый", "ёбс", "жидоёб", "жидоёбка", "жидоёбский",
        "заебал", "заебать", "заебись", "заебцовый", "заебенить", "заёб", "заёбанный", "заёбываться",
        "запизденевать", "запиздеть", "запиздить", "запиздживаться", "захуяривать", "захуярить", "злоебучая",
        "злоебучий", "изъебнулся", "испизделся", "испиздить", "исхуячить", "козлоёб", "козлоёбина",
        "козлоёбиться", "конолёбиться", "косолёбиться", "многопиздная", "мозгоёб", "мудоёб", "наблядовал",
        "наебалово", "наебать", "наебаться", "наебашиться", "наебенить", "наебнулся", "наебнуть", "наёбка",
        "нахуевертеть", "нахуяривать", "нахуяриться", "напиздеть", "напиздить", "настоебать", "невъебенный",
        "нехуёвый", "нехуй", "оберблядь", "объебал", "объебалово", "объебательство", "объебать", "объебаться",
        "объебос", "один хуй", "однохуйственно", "опизденевать", "опиздихуительный", "опиздоумел", "оскотоёбиться",
        "остоебал", "остопиздело", "остопиздеть", "остохуеть", "отпиздеть", "отхуяривать", "отъебаться",
        "отъёбка", "отъёбки", "отъёбывать", "переебать", "перехуяривать", "перехуярить", "пёзды", "пизда",
        "пиздабол", "пиздаёб", "пиздакрыл", "пиздануть", "пиздануться", "пиздатый", "пиздеться", "пиздибанк",
        "пиздилов", "пиздить", "пиздобол", "пиздоблошка", "пиздобрат", "пиздовать", "пиздовладелец",
        "пиздодушие", "пиздожитие", "пиздозаеб", "пиздой", "пиздойками", "пиздолиз", "пиздомания",
        "пиздопляска", "пиздорванец", "пиздорванка", "пиздострадалец", "пиздострадания", "пиздохуй",
        "пиздёж", "пиздёныш", "пиздивать", "пиздилингус", "пиздить", "пиздрёт", "пизду", "пиздуй",
        "пиздун", "пиздыка", "пиздылы", "пиздюк", "пиздюлинка", "пиздюля", "пиздюрить", "пиздюхать",
        "пиздюшник", "подзаебать", "подзаебенивать", "поднаебнуть", "поднаебнуться", "поднаёбивать",
        "подпёздывать", "подпиздивать", "подъёбнуть", "подъёбка", "подъёбки", "подъёбывать", "поебать",
        "поебень", "попиздеть", "попиздили", "похуи", "похуярить", "приебаться", "припиздеть", "припиздить",
        "прихуяривать", "прихуярить", "проблядь", "проебать", "проебаться", "проёб", "пропиздить", "разъебай",
        "разъебаться", "разъёбанный", "распиздон", "распиздошить", "распиздяй", "распиздяйство", "расхуяжить",
        "расхуяривать", "скотоёб", "скотоёбина", "сосихуйский", "спиздил", "страхоёбище", "сухопиздая",
        "схуярить", "съебаться", "трепездон", "трепездонит", "туебень", "тупиздень", "уебался", "уебать",
        "уёбище", "уёбищенский", "уёбок", "уёбывать", "упиздить", "хитровыебанный", "хуев", "хуеватенький",
        "хуевато", "худоёбина", "хуебратия", "хуеглот", "хуегрыз", "хуедин", "хуелес", "хуеман", "хуемырло",
        "хуеплёт", "хуепутало", "хуесос", "хуета", "хуетень", "хуёвина", "хуёвничать", "хуёво", "хуёвый",
        "хуила", "хуило", "хуйло", "хуйнуть", " хуйня", "хуйрич", "хуйчить", "хуйцития", "хули", "хуя", "хуяк",
        "хуячить", "шароёбиться", "широкопиздая"
);
    // Проверка наличия запрещенных слов в отзыве
    if (check_forbidden_words($message, $forbidden_words)) {
        echo "<div class='alert alert-danger' role='alert'>Отзыв содержит запрещенные слова или выражения.</div>";
    } elseif (mb_strlen($message, 'UTF-8') < 3 || mb_strlen($message, 'UTF-8') > 300) {
        echo "<div class='alert alert-danger' role='alert'>Отзыв должен быть не менее 3 и не более 300 символов.</div>";
    } else {
        // SQL запрос для вставки отзыва в базу данных
        $sql = "INSERT INTO reviews (name, rating, message) VALUES ('$name', '$rating', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Отзыв успешно отправлен.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Ошибка: " . $conn->error . "</div>";
        }
    }
}

// SQL запрос для выборки некоторых отзывов из базы данных
$sql_select_reviews = "SELECT * FROM reviews ORDER BY id DESC LIMIT 3";
$result_select_reviews = $conn->query($sql_select_reviews);

// Закрытие соединения с базой данных
$conn->close();
?>

<style>
    body {
        background-image: url('../uploads/shema-zala-restorana.png'); /* URL изображения */
        background-size: cover;
        background-color: #ffffff;
        background-position: center;
        background-repeat: no-repeat;
        color: #000000; /* Изменили цвет текста на черный */
    }

    /* Стили для формы отзыва */
    .review-form {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .review-form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .review-form input[type="text"],
    .review-form textarea,
    .review-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .review-form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .review-form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Стили для сообщений об успехе и ошибке */
    .alert {
        margin-top: 20px;
    }

    /* Стили для отзывов */
    .review {
        background-color: #fefefe;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Дополнительные стили для формы отзыва */
    .review-form {
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .review-form:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .review-form label {
        font-size: 1.1em;
    }

    .review-form input[type="text"],
    .review-form textarea,
    .review-form select {
        border-color: #ddd;
    }

    .review-form input[type="text"]:focus,
    .review-form textarea:focus,
    .review-form select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .review-form input[type="submit"] {
        font-size: 1.1em;
    }
</style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">Оставить отзыв</h1>
    <div class="review-form-container">
        <form class="review-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Ваше имя:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="rating">Оценка:</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Ваш отзыв:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить отзыв</button>
        </form>
    </div>

    <!-- Показываем некоторые из уже существующих отзывов -->
    <div class="reviews-section">
        <h2 class="text-center mb-4">Отзывы клиентов</h2>
        <?php
        if ($result_select_reviews->num_rows > 0) {
            while ($row = $result_select_reviews->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p><strong>Оценка:</strong> " . $row['rating'] . "</p>";
                echo "<p><strong>Отзыв:</strong> " . htmlspecialchars($row['message']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>Пока нет отзывов.</p>";
        }
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.review-form');
        form.addEventListener('submit', function (e) {
            const message = document.getElementById('message').value;
            if (message.length < 3 || message.length > 300) {
                e.preventDefault();
                alert('Отзыв должен быть не менее 3 и не более 300 символов.');
            }
        });
    });
</script>
</body>
