<script>
    //add active class to the active image 
    const thumbnails = document.querySelectorAll('.thumbnail-row');
    const carousel = document.querySelector('#productsCarousel');

    carousel.addEventListener('slide.bs.carousel', (e) => {
        thumbnails.forEach(el => el.classList.remove('active'));
        thumbnails[e.to].classList.add('active');
    });
    // add the active class to the chosen size
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
    // add the active class to the chosen color
    document.querySelectorAll('.color-option').forEach(opt => {
        opt.addEventListener('click', () => {
            document.querySelectorAll('.color-option').forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
        });
    });
    //add text warning to stars and get the rating
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-value');
                ratingInput.value = rating;

                stars.forEach((s, i) => {
                    s.classList.toggle('text-warning', i < rating);
                });
            });
        });
    });
</script>