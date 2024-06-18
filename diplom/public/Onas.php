<?php include "../header/header.php"; ?>

<style>
    /* Стили для страницы "О нас" */
    body {

        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #bfbfbf;
        color: #333;
    }

    header {
        background-color: #dc3545;
        padding: 20px;
        text-align: center;
        color: white;
    }


    h1 {
        font-size: 36px;
        margin-bottom: 20px;
        color: #ffffff;
    }



    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .gallery-item {
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        width: 350px; /* Установка ширины для всех элементов галереи */
    }

    .gallery-item img {
        width: 100%; /* Масштабирование изображения для заполнения родительского контейнера */
        height: auto;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }
</style>
<body>
<header>
    <h1>О нас - Ресторан "BelHotel"</h1>
    <p>Мы предлагаем вам уникальные кулинарные впечатления!</p>
</header>

<div class="container">
    <h2>Наша история</h2>
    <p>Ресторан "Вкусные удовольствия" открылся в 2010 году и с тех пор радует своих гостей великолепными блюдами и уютной атмосферой. Наша команда профессиональных поваров и официантов работает каждый день, чтобы сделать ваше посещение незабываемым.</p>

    <h2>Наши блюда</h2>
    <p>Мы специализируемся на блюдах европейской и национальной кухни. В меню вы найдете разнообразные закуски, супы, основные блюда из мяса, рыбы и овощей, а также десерты, которые не оставят вас равнодушными.</p>

    <h2>Фотогалерея</h2>
    <div class="gallery">
        <div class="gallery-item">
            <img src="https://podacha-blud.com/uploads/posts/2022-10/1666421539_58-podacha-blud-com-p-luchshie-salati-v-moskve-v-restoranakh-i-k-65.jpg" alt="Фото 1">
        </div>
        <div class="gallery-item">
            <img src="https://mykaleidoscope.ru/x/uploads/posts/2022-09/1663800627_51-mykaleidoscope-ru-p-krasivie-restorannie-blyuda-yeda-vkontakte-56.jpg" alt="Фото 2">
        </div>
        <div class="gallery-item">
            <img src="http://beliy-juravl.ru/wp-content/uploads/2020/02/Y9A9164_byYOKOFOTO.jpg" alt="Фото 3">
        </div>
        <div class="gallery-item">
            <img src="https://get.pxhere.com/photo/restaurant-dish-meal-food-produce-gourmet-meat-cuisine-steak-library-dinner-western-scotland-edinburgh-wobble-french-cuisine-exquisite-deer-meat-1362270.jpg" alt="Фото 4">
        </div>
        <div class="gallery-item">
            <img src="https://www.nestleprofessional.com/sites/default/files/2023-04/AdobeStock_165294213.jpeg" alt="Фото 5">
        </div>
        <div class="gallery-item">
            <img src="https://get.pxhere.com/photo/dish-cuisine-food-ingredient-meat-fried-food-produce-mixed-grill-steak-la-carte-food-meat-chop-recipe-comfort-food-pork-steak-side-dish-meal-teriyaki-rib-eye-steak-Steak-au-poivre-grilling-garnish-roasting-grillades-pork-chop-mediterranean-food-1615745.jpg" alt="Фото 6">
        </div>
    </div>
</div>

<script>
    // JavaScript для анимации галереи
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'scale(1.05)';
        });
        item.addEventListener('mouseleave', () => {
            item.style.transform = 'scale(1)';
        });
    });
</script>
<?php include "../footer/footer.php"; ?>
</body>

