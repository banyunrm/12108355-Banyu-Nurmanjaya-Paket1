<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/star.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/star.js')}}">
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.fa-star');

        stars.forEach(function(star) {
            star.addEventListener('click', function() {
                const ratingValue = this.dataset.rating;
                document.getElementById('rating').value = ratingValue;

                stars.forEach(function(innerStar) {
                    if (innerStar.dataset.rating <= ratingValue) {
                        innerStar.classList.add('checked');
                    } else {
                        innerStar.classList.remove('checked');
                    }
                });
            });
        });
    });
</script>

</script>
    <title>Library</title>
</head>

<body>
    @yield('content')
</body>

</html>
