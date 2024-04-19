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
