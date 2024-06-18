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

// Проверка, была ли отправлена форма добавления блюда
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];

    // Обработка загружаемого файла
    $target_dir = "uploads/"; // Директория, куда будут загружаться файлы
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Проверка, является ли файл изображением
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }
    // Проверка существования файла
    if (file_exists($target_file)) {
        echo "Извините, файл уже существует.";
        $uploadOk = 0;
    }
    // Проверка размера файла
    if ($_FILES["img"]["size"] > 500000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
    }
    // Разрешенные форматы файлов
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Извините, разрешены только JPG, JPEG, PNG & GIF файлы.";
        $uploadOk = 0;
    }
    // Проверка на наличие ошибок при загрузке файла
    if ($uploadOk == 0) {
        echo "Ваш файл не был загружен.";
        // Если все в порядке, пытаемся загрузить файл
    }

    // SQL запрос для вставки данных в таблицу блюд
    $img = $target_file;
    $sql = "INSERT INTO menu_dishes (name, description, price, category_id, img) VALUES ('$name', '$description', '$price', '$category_id', '$img')";

    if ($conn->query($sql) === TRUE) {
        echo "Блюдо успешно добавлено";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

// SQL запрос для выборки всех категорий меню
$sql_categories = "SELECT * FROM menu_categories";
$result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление блюда</title>
    <!-- Подключение стилей Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение шрифта Montserrat из Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Основные стили */
        body {
            font-family: 'Montserrat', sans-serif; /* Применяем шрифт Montserrat ко всему тексту */
            background-color: #f8f9fa; /* Цвет фона страницы */
            padding-top: 50px; /* Отступ сверху */
        }

        /* Стили для формы */
        form {
            background-color: #fff; /* Цвет фона формы */
            padding: 20px; /* Внутренние отступы формы */
            border-radius: 8px; /* Скругление углов формы */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Тень формы */
        }

        /* Стили для кнопки */
        .btn-primary {
            background-color: #007bff; /* Цвет фона кнопки */
            border-color: #007bff; /* Цвет границы кнопки */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Цвет фона кнопки при наведении */
            border-color: #0056b3; /* Цвет границы кнопки при наведении */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Добавление блюда</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Название блюда:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Описание блюда:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="category_id">Категория блюда:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <?php
                        // Вывод всех категорий меню в виде опций для выбора
                        if ($result_categories->num_rows > 0) {
                            while($row_category = $result_categories->fetch_assoc()) {
                                echo "<option value='" . $row_category["id"] . "'>" . $row_category["name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">Изображение блюда (файл):</label>
                    <input type="file" class="form-control" id="img" name="img">
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Добавить блюдо</button>
            </form>
        </div>
    </div>
</div>

<!-- Подключение скриптов Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

