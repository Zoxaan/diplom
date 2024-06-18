<?php include "../header/header.php"; ?>

<style>
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

<body>

<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Рейтинг</th>
        <th>Сообщение</th>
        <th>Дата создания</th>
        <th>Управление</th>
    </tr>

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

    // Проверяем, был ли отправлен запрос на удаление
    if(isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];

        // SQL запрос для удаления записи с указанным ID из таблицы reviews
        $delete_sql = "DELETE FROM reviews WHERE id = $delete_id";

        // Выполняем запрос
        if ($conn->query($delete_sql) === TRUE) {
            echo "<p>Отзыв успешно удален.</p>";
        } else {
            echo "Ошибка при удалении отзыва: " . $conn->error;
        }
    }

    // SQL запрос для выбора всех данных из таблицы reviews
    $sql = "SELECT id, name, rating, message, created_at FROM reviews";
    $result = $conn->query($sql);

    // Проверка наличия данных
    if ($result->num_rows > 0) {
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["name"]. "</td>";
            echo "<td>" . $row["rating"]. "</td>";
            echo "<td>" . $row["message"]. "</td>";
            echo "<td>" . $row["created_at"]. "</td>";
            // Добавляем кнопку удаления с формой для отправки ID записи
            echo "<td><form method='post'><input type='hidden' name='delete_id' value='" . $row["id"] . "'><button type='submit' class='btn-delete'>Удалить</button></form></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>
</table>

</body>

