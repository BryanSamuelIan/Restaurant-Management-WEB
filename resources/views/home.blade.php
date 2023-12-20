@extends('layouts.template')

@section('content')
<div id="default-carousel" class="relative w-full pt-4 lg:px-40" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item  -->
        @foreach ($events as $event)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>

                    <img src="{{ asset('storage/' . $event->banner) }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">

            </div>
        @endforeach

    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        @foreach ($events as $index => $event)
            <button type="button"
                class="w-3 h-3 rounded-full @if ($index === 0) bg-white @else bg-gray-800 @endif"
                aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index }}"
                data-carousel-slide-to="{{ $index }}"></button>
        @endforeach
    </div>

    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="container pt-20 flex flex-col items-center justify-center ">
<a href="{{ route('ordermenu') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 my-5 lg:w-full lg:mx-20">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/images/LogoYellow.jpeg" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mangan</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Kami menyediakan hidangan berat maupun ringan yang lezat dan berenergi!</p>
    </div>
</a>
<a href="{{ route('ordermenu') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 my-5">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ngombe</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Minuman segar dan klasik untuk menemani harimu!</p>
    </div>
    <img class="object-cover w-full rounded-b-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-r-lg" src="/images/LogoWhite.jpeg" alt="">
</a>
<a href="{{ route('contact') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 my-5">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/images/LogoGreen.jpeg" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Dolan</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Tempat nongkrong asik diiringi pemandangan alam, free WI-FI dan musik!</p>
    </div>
</a>
</div>



@endsection
