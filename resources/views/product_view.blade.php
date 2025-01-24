<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ArtemVita_2\favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>ArtemVita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('header')

{{-- 1st Half --}}
<div class="flex flex-col gap-5">
    <div class="w-full">
        <img src="{{ asset('images/pexels-suzyhazelwood-1762973.jpg') }}" alt="jus an img ig" class="w-full">
    </div>

    <div class="font-semibold text-3xl mx-3 mt-3">
        <p>Dark Side Of The Blue Ocean</p>
    </div>

    <div class="mx-3 font-thin">
        <p>21 x 21 x 2 1/2 in | 53 x 53 x 6 cm</p>
    </div>
    <div class="font-light italic text-xl mx-3 my-3">
        <p>By Eddard Stark</p>
    </div>
    <div class="font-bold text-2xl mx-3">
        <p>LKR 450,000</p>
    </div>

    <div class="border-t border-black my-5 mx-4"></div>


{{-- 2nd Half --}}
<div class="mx-3 mt-10"> <!-- Add margin-top to separate carousel from the text above -->
    <!-- Carousel Section -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Block 1 -->
            <div class="swiper-slide">
                <div class="bg-gray-200 p-5 rounded-lg shadow-md flex flex-col items-center justify-center h-full">
                    <h2 class="font-bold text-xl text-center">Visa</h2>
                    <p class="text-sm text-center">Installments</p>
                </div>
            </div>
            <!-- Block 2 -->
            <div class="swiper-slide">
                <div class="bg-gray-200 p-5 rounded-lg shadow-md flex flex-col items-center justify-center h-full">
                    <h2 class="font-bold text-xl text-center">MasterCard</h2>
                    <p class="text-sm text-center">Installments</p>
                </div>
            </div>
            <!-- Block 3 -->
            <div class="swiper-slide">
                <div class="bg-gray-200 p-5 rounded-lg shadow-md flex flex-col items-center justify-center h-full">
                    <h2 class="font-bold text-xl text-center">KoKo</h2>
                    <p class="text-sm text-center">Installments</p>
                </div>
            </div>
            
        </div>

        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

@include('nav')

</body>
</html>
