<?php include "../header/header.php"; ?>
<style>
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        background-color: #ffffff;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 10px;
    }

    th {
        background-color: #f2f2f2;
    }

    .table-img {
        max-width: 100px;
        height: auto;
        transition: transform 0.3s ease-in-out; /* Добавляем анимацию для изображений */
    }

    .table-img:hover {
        transform: scale(1.1); /* Увеличиваем изображение при наведении */
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2; /* Цвет фона для четных строк */
    }

    table tr:hover {
        background-color: #f8f8f8; /* Цвет фона при наведении на строку */
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-right: 5px;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #c82333; /* Изменяем цвет при наведении */
    }

    .btn-add {
        background-color: #28a745;
    }

    .btn-add:hover {
        background-color: #218838; /* Изменяем цвет при наведении */
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>

<body>

<table>
    <tr>
        <th>ID</th>
        <th>Название стола</th>
        <th>Количество мест</th>
        <th>Статус</th>
        <th>Изображение</th>
        <th>Описание</th>
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

    // Удаление записи, если передан параметр delete_id через GET запрос
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql_delete = "DELETE FROM tables WHERE id = $delete_id";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // SQL запрос для выбора всех данных из таблицы
    $sql = "SELECT id, name_table, quantity, status, img, description FROM tables";
    $result = $conn->query($sql);

    // Проверка наличия данных
    if ($result->num_rows > 0) {
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["name_table"]. "</td>";
            echo "<td>" . $row["quantity"]. "</td>";
            echo "<td>" . $row["status"]. "</td>";
            echo "<td><img src='../" . $row["img"]. "' alt='" . $row["name_table"]. "' class='table-img'></td>";
            echo "<td>" . $row["description"]. "</td>";
            echo "<td><a href='?delete_id=" . $row["id"] . "' class='btn btn-delete'>Удалить</a> </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>0 results</td></tr>";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>
</table>

</body>
