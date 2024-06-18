<?php include "../header/header.php"; ?>

<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<body>

<div class="container">
    <h2 style="margin-bottom: 30px;">Админ-панель</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Таблица "Столы"</h5>
                    <p class="card-text">Управление данными столов в ресторане.</p>
                    <a href="view_table.php" class="btn btn-primary">Просмотреть</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Таблица "Меню блюд"</h5>
                    <p class="card-text">Управление данными о блюдах в меню ресторана.</p>
                    <a href="view_menu.php" class="btn btn-primary">Просмотреть</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Таблица "Отзывы"</h5>
                    <p class="card-text">Управление данными о отзывах о ресторане.</p>
                    <a href="view_reviews.php" class="btn btn-primary">Просмотреть</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Добавление кухни</h5>
                    <p class="card-text">Добавление данных о кухне в ресторане.</p>
                    <a href="addcucking.php" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Добавление стола</h5>
                    <p class="card-text">Добавление данных о столе в ресторане.</p>
                    <a href="addtable.php" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
