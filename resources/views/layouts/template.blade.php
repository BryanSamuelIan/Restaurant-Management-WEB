<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Onoe'Iki Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</head>

<body class="bg-stone-200">
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <header>
                <div class="bg-gray-800 text-white text-center y-4 banner" onclick="window.location.href='/'">
                    <img src="\images\LogoWhite.png" alt="Banner Image" class="max-h-full mx-auto">
                </div>

                <nav class="bg-amber-300 dark:bg-teal-300 shadow-lg p-1">
                    <div class="container mx-auto py-4 ">
                        <!-- Wrap ul and form in the same div with flex property -->
                        <div class="flex flex-col items-center justify-center sm:flex-row sm:items-start sm:w-full">

                            <!-- List -->
                            <ul class="flex items-center">
                                <li class="{{ request()->is('/') ? 'text-black-500' : '' }} px-2 lg:px-8">
                                    <a href="/" class="text-stone-800 text-extrabold hover:text-white">Home</a>
                                </li>
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('menu.index') }}" class="text-stone-800 text-extrabold hover:text-white">Menu</a>
                                </li>
                                <li class="px-2 lg:px-8">
                                    <a href="{{ route('about') }}"
                                        class="text-stone-800 text-extrabold hover:text-stone-white">About Us</a>
                                </li>
                                <li class="px-2 lg:px-8">
                                    <a href="{{ route('contact') }}"
                                        class="text-stone-800 text-extrabold hover:text-stone-white">Contact Us</a>
                                </li>

                                {{-- Employee --}}
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('transactionIN') }}" class="text-stone-800 text-extrabold hover:text-white">Order In</a>
                                </li>

                                {{-- admin --}}
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('transactionOUT') }}" class="text-stone-800 text-extrabold hover:text-white">Transaction Out</a>{{-- purchase and expense --}}
                                </li>

                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('menuEdit') }}" class="text-stone-800 text-extrabold hover:text-white">Edit Menu</a>
                                </li>
                                {{-- basicly menu yang isa diedit, blm ambil index --}}
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('event') }}" class="text-stone-800 text-extrabold hover:text-white">Event</a>{{-- edit Event --}}
                                </li>
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('supplier.index') }}" class="text-stone-800 text-extrabold hover:text-white">Supplier</a>
                                </li>

                                {{-- owner --}}

                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('employeesUser') }}" class="text-stone-800 text-extrabold hover:text-white">Employees</a>{{-- and user --}}
                                </li>
                                <li class="group relative px-2 lg:px-8 z-50 text-stone-800">
                                    <a href="{{ route('analitics') }}" class="text-stone-800 text-extrabold hover:text-white">Analitics</a>
                                </li>


                                {{-- <li class="px-4 lg:px-12">
                                    <a href="{{ route('store', 1) }}"
                                        class="text-teal-800 text-extrabold hover:text-white">STORES</a>
                                </li> --}}
                                {{-- <li class="px-4 lg:px-12 ml-auto">
                                    <form class="flex items-center" action="{{ route('filter') }}" method="GET">
                                        <label for="default-search"
                                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                        <input type="search" id="default-search" name="search"
                                            class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-teal-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-white dark:border-teal-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search Tanjung..." required>
                                        <button type="submit"
                                            class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ml-2 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Search</button>
                                    </form>
                                </li> --}}

                            </ul>
                        </div>
                    </div>
                </nav>







            </header>

            <main>
                <h1 class="text-4xl text-green-tosca font-bold mb-12 text-center pt-8">{{$pagetitle }}</h1>

                @yield('content')
            </main>

            <footer class="bg-stone-600 dark:bg-gray-900 mt-16 ">
                <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                    <div class="md:flex md:justify-between">
                        <div class="mb-6 md:mb-0">
                            <a href="/" class="flex items-center">
                                <img src="\images\LogoWhite.png" alt="Company Logo" class="w-24 h-24 rounded-full">
                                <h2 class="ml-4 font-bold text-xl dark:text-white"
                                    style="font-family: 'Poppins', sans-serif;">Onoe'Iki</h2>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                            <div class="mr-6">
                                <h2 class="mb-6 text-sm font-semibold text-black uppercase dark:text-white">About
                                </h2>
                                <ul class="text-black dark:text-black font-medium">
                                    <li class="mb-4">
                                        <a href="{{ route('about') }}#history" class="hover:underline">History</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="{{ route('about') }}#vision" class="hover:underline">Vision</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="{{ route('about') }}#vision" class="hover:underline">Mission</a>
                                    </li>
                                    {{-- <li class="mb-4">
                                        <a href="{{ route('about') }}#founder" class="hover:underline">Founder</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="mr-6">
                                <h2 class="mb-6 text-sm font-semibold text-black uppercase dark:text-white">Contact
                                </h2>
                                <ul class="text-black dark:text-gray-400 font-medium">
                                    <li class="mb-4">
                                        <a href="mailto:onoeikipacet@gmail.com" target="_blank"class="hover:underline ">Email</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="tel:+621238263969"target="_blank" class="hover:underline">Phone</a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="https://www.tiktok.com/@onoeiki.pacet" target="_blank"class="hover:underline">TikTok</a>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="mr-6">
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Stores
                                </h2>
                                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                    @foreach (\App\Models\Store::all() as $store)
                                        <li class="mb-4">
                                            <a href="{{ route('store', ['id' => $store->id]) }}"
                                                class="hover:underline">{{ $store->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <span class="text-sm text-black sm:text-center dark:text-gray-400">© 2023 <a href=""
                                class="hover:underline">Onoe'Iki</a>. All Rights Reserved.
                        </span>
                        <div class="flex mt-4 space-x-5 sm:justify-center sm:mt-0">
                            <a href="https://www.facebook.com/onoeiki_pacet"target="_blank"
                                class="text-black hover:text-gray-800 dark:hover:text-white">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 8 19">
                                    <path fill-rule="evenodd"
                                        d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Facebook page</span>
                            </a>
                            <a href="https://www.instagram.com/onoeiki.pacet" target="_blank"
                                class="text-black hover:text-gray-800 dark:hover:text-white">
                                <svg class="w-4 h-4" aria-hidden="true" <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 22">
                                    <path fill-rule="evenodd"
                                        d="M 8 3 C 5.243 3 3 5.243 3 8 L 3 16 C 3 18.757 5.243 21 8 21 L 16 21 C 18.757 21 21 18.757 21 16 L 21 8 C 21 5.243 18.757 3 16 3 L 8 3 z M 8 5 L 16 5 C 17.654 5 19 6.346 19 8 L 19 16 C 19 17.654 17.654 19 16 19 L 8 19 C 6.346 19 5 17.654 5 16 L 5 8 C 5 6.346 6.346 5 8 5 z M 17 6 A 1 1 0 0 0 16 7 A 1 1 0 0 0 17 8 A 1 1 0 0 0 18 7 A 1 1 0 0 0 17 6 z M 12 7 C 9.243 7 7 9.243 7 12 C 7 14.757 9.243 17 12 17 C 14.757 17 17 14.757 17 12 C 17 9.243 14.757 7 12 7 z M 12 9 C 13.654 9 15 10.346 15 12 C 15 13.654 13.654 15 12 15 C 10.346 15 9 13.654 9 12 C 9 10.346 10.346 9 12 9 z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Instagram page</span>
                            </a>
                            <a href="https://www.tiktok.com/@onoeiki.pacet" target="_blank" class="text-black hover:text-gray-800 dark:hover:text-white">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 50 50">
                                    <path fill-rule="evenodd"
                                    d=" M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z
                                        M37.006,22.323
                                        c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527
                                        s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053
                                        c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016
                                        c0.378,3.591,3.277,6.425,6.901,6.685V22.323z clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">TikTok page</span>
                            </a>


                        </div>
                    </div>
                </div>
            </footer>


        </div>

    </div>
</body>
</html>
