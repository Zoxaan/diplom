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

    // Курс обмена доллара к рублю (предположим, что 1 доллар = 75 рублей)
    $dollar_to_ruble_rate = 75;

    // SQL запрос для выборки всех категорий меню
    $sql_categories = "SELECT * FROM menu_categories";
    $result_categories = $conn->query($sql_categories);
    ?>
    <style>
        /* Общие стили */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../uploads/1674905669_top-fon-com-p-skachat-temnii-fon-dlya-prezentatsii-179.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
        }



        h1, h2, h3, h4, h5, h6 {
            color: #ffffff;
            margin-top: 0;
        }

        /* Стили для карточек блюд */
        .menu-item {
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .menu-item img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .menu-item p {
            margin-bottom: 10px;
        }

        .menu-item p:last-child {
            margin-bottom: 0;
        }
    </style>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Меню ресторана</h1>
            </div>
        </div>
        <div class="row">
            <?php
            // Проверка наличия данных категорий меню
            if ($result_categories->num_rows > 0) {
                // Вывод каждой категории меню
                while($row_category = $result_categories->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <h2><?php echo $row_category["name"]; ?></h2>
                        <div class="menu-items">
                            <?php
                            // SQL запрос для выборки блюд данной категории
                            $category_id = $row_category["id"];
                            $sql_dishes = "SELECT * FROM menu_dishes WHERE category_id = $category_id";
                            $result_dishes = $conn->query($sql_dishes);

                            // Вывод блюд категории
                            if ($result_dishes->num_rows > 0) {
                                while($row_dish = $result_dishes->fetch_assoc()) {
                                    // Конвертация цены из долларов в рубли
                                    $price_ruble = $row_dish["price"] * $dollar_to_ruble_rate;
                                    ?>
                                    <div class="menu-item">
                                        <img src="../<?php echo $row_dish["img"]; ?>" alt="<?php echo $row_dish["name"]; ?>">
                                        <h4><?php echo $row_dish["name"]; ?></h4>
                                        <p><?php echo $row_dish["description"]; ?></p>
                                        <p>Цена: <?php echo $price_ruble; ?> руб.</p>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>Нет блюд в этой категории.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Нет категорий меню.</p>";
            }
            // Закрытие соединения с базой данных
            $conn->close();
            ?>
        </div>
    </div>
    <?php include "../footer/footer.php"; ?>
    </body>
