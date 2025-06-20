@extends('layouts.template')

@section('content')
<div  class="container  lg:px-40">

    <div id="history" class="container mx-auto py-8 ">

        <div
            class="relative bg-amber-300 bg-opacity-10 pb-8 rounded-md p-0 sm:p-0 md:p-8 lg:p-16 w-11/12 mx-auto flex flex-col lg:flex-row">

            <div
                class="absolute top-[-8%] left-5 text-7xl md:text-8xl font-semibold text-amber-500 text-opacity-20 p-2 rounded-tl-md rounded-br-md title-animation">
                About
            </div>

            <div
                class="lg:w-1/3 md:pl-0 flex-shrink-0 flex flex-col pt-5 md:pt-0 md:mx-auto sm:text-center lg:text-left sm:mx-auto">
                <h2 class="text-lg md:text-3xl text-amber-500 font-bold mb-4">Tentang Kami</h2>
                <img src="\images\LogoGreen.jpeg" alt="Onoe iki Logo"
                    class="mb-4 w-full h-auto md:w-48 sm:w-36 rounded-lg shadow-md sm:mx-auto lg:mx-0 hidden sm:block">
            </div>


            <div class="px-10 lg:w-2/3 md:pl-8">
                <p class="text-sm text-gray-600 text-justify md:text-lg">
                    Cafe "Onoe'Iki" adalah sebuah destinasi unik yang terletak di kawasan pegunungan yang memikat hati di
                    Pacet, Jawa Timur. Nama kami mencerminkan esensi keberadaan tempat ini, mempersembahkan pengalaman
                    menyatu dengan alam. Dengan pemandangan bukit, hutan pinus dan sawah yang mempesona, kami mengundang
                    para pengunjung untuk menikmati momen istimewa sambil menikmati makanan lezat dan minuman yang
                    menyegarkan. Mangan Ngombe Dolan.
                </p>
            </div>
        </div>
    </div>

    <div id="vision" class="container mx-auto  py-12">
        <div
            class="relative bg-amber-300 bg-opacity-10 rounded-md p-0 pb-8 sm:p-0 md:p-24 w-11/12 mx-auto flex flex-col md:flex-row">
            <div
                class="absolute top-[-4%] left-5 text-7xl md:text-8xl font-semibold text-amber-500 text-opacity-20 p-2 rounded-tl-md rounded-br-md title-animation">
                Vision
            </div>
            <div class="px-10 lg:w-full md:pl-8">
                <h3 class="text-3xl md:text-4xl font-bold mb-4 text-amber-500">Visi kami</h3>
                <ul class="list-disc text-gray-600 text-sm text-justify md:text-lg pl-6">
                    <li class="mb-2">Menjadi tujuan pilihan untuk bersantai, menghilangkan stres, dan menikmati
                        momen-momen istimewa di tengah lingkungan yang menenangkan.</li>
                    <li class="mb-2">Menjadi tempat yang memungkinkan para pengunjung untuk menikmati keindahan alam
                        pegunungan Pacet sambil menikmati hidangan dan minuman berkualitas.</li>
                    <li>Menawarkan tempat tongkrongan berkualitas yang aman dan menyenangkan.</li>
                </ul>
            </div>
        </div>
    </div>


    <div id="mision" class="container mx-auto py-12">
        <div
            class="relative bg-amber-300 bg-opacity-10 rounded-md p-0 pb-8 sm:p-0 md:p-24 w-11/12 mx-auto flex flex-col md:flex-row">
            <div
                class="absolute top-[-4%] left-5 text-7xl md:text-8xl font-semibold text-amber-500 text-opacity-20 p-2 rounded-tl-md rounded-br-md title-animation">
                Mission
            </div>
            <div class="px-10 lg:w-full md:pl-8">
                <h3 class="text-3xl md:text-4xl font-bold mb-4 text-amber-500">Misi kami</h3>
                <ul class="list-disc text-gray-600 text-sm text-justify md:text-lg pl-6">
                    <li class="mb-2">Menghadirkan Hidangan Autentik: Menyajikan hidangan lalapan, ricebox, dan snack yang
                        autentik, menggugah selera, dan menghadirkan cita rasa khas Indonesia</li>
                    <li class="mb-2">Ragam Minuman Berkualitas: Menyediakan berbagai jenis minuman mulai dari kopi yang
                        harum, teh dan mojito yang menyejukkan, hingga minuman khas wedang, dan lainnya untuk memenuhi
                        selera para pengunjung.</li>
                    <li class="mb-2">Memberikan Pengalaman Berbeda: Menjadi tempat yang tidak hanya menyajikan makanan dan
                        minuman, tetapi juga memberikan pengalaman yang tak terlupakan melalui suasana hangat, keramahan,
                        dan keakraban.</li>
                    {{-- <li class="mb-2">Menjaga Lingkungan: Berkomitmen untuk menjaga kelestarian lingkungan sekitar dengan
                        praktik bisnis yang bertanggung jawab, seperti pengelolaan sampah yang baik dan penekanan pada
                        penggunaan bahan ramah lingkungan.</li>
                    <li>Membangun Komunitas: Menciptakan ruang yang memungkinkan pertemuan, percakapan, dan konektivitas di
                        antara pengunjung, membangun komunitas yang menghargai keindahan alam dan warisan budaya.</li> --}}
            </div>
        </div>
    </div>
</div>
@endsection
