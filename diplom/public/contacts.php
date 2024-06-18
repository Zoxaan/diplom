<?php include "../header/header.php"; ?>
<style>

    body {
        background-image: url('../uploads/shema-zala-restorana.png'); /* URL изображения */
        background-color: #bfbfbf;
    }
    /* Стили для карты */
    #map {
        height: 400px;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    /* Стили для контактной информации */
    .contact-info {
        background-color: #ffd000; /* Цвет фона */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .contact-info h2 {
        color: #000; /* Цвет заголовка */
        font-size: 28px; /* Размер шрифта заголовка */
        margin-bottom: 20px;
    }
    .contact-info p {
        color: #000; /* Цвет текста */
        font-size: 18px; /* Размер шрифта текста */
        margin-bottom: 10px;
    }
    /* Стили для футера */
    footer {
        bottom: 0px;
        position: absolute;
        width: 100%; /* Ширина 100% */
        background-color: #f8f9fa; /* Цвет фона */
        padding: 5px 0; /* Уменьшенные внутренние отступы */
        text-align: center; /* Выравнивание текста по центру */
        opacity: 0.7; /* Прозрачность */
        font-size: 12px; /* Уменьшенный размер шрифта */
    }
    /* Стили для текста внутри футера */
    footer p, footer h5 {
        color: rgba(0, 0, 0, 0.7); /* Цвет текста с полупрозрачностью */
    }
</style>
</head>
<body>

<!-- Контент страницы -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Контактная информация -->
            <div class="contact-info">
                <h2>Контактная информация</h2>
                <p><strong>номер ресепшена:</strong> +7 (967) 663-30-96</p>
                <p><strong>Email:</strong> voladosas.05@mail.ru</p>
                <p><strong>Адрес:</strong> ул. Карла Либкнехта, 99/1</p>
            </div>
            <!-- Форма для отправки сообщения -->
            <form method="post" action="send_message.php">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Сообщение:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
        <div class="col-md-6">
            <!-- Карта -->
            <div id="map">
                <a href="https://yandex.ru/maps/10988/belorechensk/?utm_medium=mapframe&utm_source=maps" class="map-link">Белореченск</a>
                <a href="https://yandex.ru/maps/10988/belorechensk/?ll=39.874894%2C44.776822&mode=poi&poi%5Bpoint%5D=39.868796%2C44.775259&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1020746981&utm_medium=mapframe&utm_source=maps&z=17" class="map-link">ул. Карла Либкнехта, 99/1, Белореченск</a>
                <iframe src="https://yandex.ru/map-widget/v1/?ll=39.874894%2C44.776822&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgoyMTYwMDYzNzIwEm3QoNC-0YHRgdC40Y8sINCa0YDQsNGB0L3QvtC00LDRgNGB0LrQuNC5INC60YDQsNC5LCDQkdC10LvQvtGA0LXRh9C10L3RgdC6LCDQm9C-0LzQsNC90YvQuSDQv9C10YDQtdGD0LvQvtC6LCA5IgoNEX4fQhVsGzNC&z=17.12" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>
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
</body>
