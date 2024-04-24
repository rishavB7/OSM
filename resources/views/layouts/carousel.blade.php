<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://sarkariyojana.com/wp-content/uploads/2024/02/assam-punya-tirtha-yojana.webp"
                class="d-block h-[46rem] w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                {{-- <h5>First slide label</h5> --}}
                {{-- <p>Some representative placeholder content for the first slide.</p> --}}
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://cm.assam.gov.in/documents/34104/315413/Swanirbhar+Naari.png/acd173e3-9c9f-c070-2c7b-b573f55d618b?t=1675066561837"
                class="d-block h-[46rem] w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                {{-- <h5>Third slide label</h5> --}}
                {{-- <p>Some representative placeholder content for the third slide.</p> --}}
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://cm.assam.gov.in/documents/34104/156540/Assam-Arogya-Nidhhi.jpg/15448858-fc6f-6c2c-dc88-639866284232?t=1641113393707"
                class="d-block h-[46rem] w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                {{-- <h5>Third slide label</h5> --}}
                {{-- <p>Some representative placeholder content for the third slide.</p> --}}
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span aria-hidden="true"><svg class="w-[48px] h-[48px]  dark:text-black" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m15 19-7-7 7-7" />
            </svg>
        </span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span aria-hidden="true"><svg class="w-[48px] h-[48px]  dark:text-black" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
        </span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<script>
    // Initialize the carousel
    var myCarousel = document.querySelector('#carouselExampleCaptions')
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000 // Change slide every 5 seconds (5000 milliseconds)
    });
</script>
