<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel='stylesheet' href="/ProjetWeb/css/style.css">
    <title>Agriculture</title>
</head>

<body>


    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetWeb/router/router.php");
    ?>






    <script src="/ProjetWeb/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".swiper", {
            // loop: true,
            // effect: 'coverflow',
            centeredSlides: true,
            slidesPerView: 'auto',
            speed: 500,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,

            },

            breakpoints: {
                768: {
                    centeredSlides: false,
                    coverflowEffect: {

                        depth: 0,

                        rotate: 0,

                        stretch: -10,



                    }
                }
            },
            autoplay: {
                delay: 3000,
            },
            coverflowEffect: {
                depth: 80,
                rotate: 50,
                stretch: 20,

            }
        })
    </script>
</body>

</html>