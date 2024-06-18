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

// Добавление столбца id, если его еще нет
$sql_add_id_column = "ALTER TABLE tables ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST";
$conn->query($sql_add_id_column);

// Проверка, была ли отправлена форма добавления стола
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_table = $_POST["name_table"];
    $quantity = $_POST["quantity"];
    $status = $_POST["status"];
    $description = $_POST["description"];

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

    // SQL запрос для вставки данных в таблицу столов
    $img = $target_file;
    $sql = "INSERT INTO tables (name_table, quantity, status, description, img) VALUES ('$name_table', '$quantity', '$status', '$description', '$img')";

    if ($conn->query($sql) === TRUE) {
        echo "Стол успешно добавлен";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

// SQL запрос для выборки всех столов
$sql = "SELECT * FROM tables";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление стола</title>
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
    <h1 class="text-center">Добавление стола</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name_table">Название стола:</label>
                    <input type="text" class="form-control" id="name_table" name="name_table">
                </div>
                <div class="form-group">
                    <label for="quantity">Количество мест:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity">
                </div>
                <div class="form-group">
                    <label for="status">Статус:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Свободен">Свободен</option>
                        <option value="Забронированный">Занят</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание стола:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="img">Изображение стола (файл):</label>
                    <input type="file" class="form-control" id="img" name="img">
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Добавить стол</button>
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

