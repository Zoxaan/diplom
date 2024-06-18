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

    .table-img {
        max-width: 100px;
        height: auto;
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
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Изображение</th>
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

        // SQL запрос для удаления записи с указанным ID из таблицы menu_dishes
        $delete_sql = "DELETE FROM menu_dishes WHERE id = $delete_id";

        // Выполняем запрос
        if ($conn->query($delete_sql) === TRUE) {
            echo "<p>Запись успешно удалена.</p>";
        } else {
            echo "Ошибка при удалении записи: " . $conn->error;
        }
    }

    // SQL запрос для выбора всех данных из таблицы menu_dishes
    $sql = "SELECT id, name, description, price, img FROM menu_dishes";
    $result = $conn->query($sql);

    // Проверка наличия данных
    if ($result->num_rows > 0) {
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["name"]. "</td>";
            echo "<td>" . $row["description"]. "</td>";
            echo "<td>" . $row["price"]. "</td>";
            echo "<td><img src='../" . $row["img"]. "' alt='" . $row["name"]. "' class='table-img'></td>";
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
