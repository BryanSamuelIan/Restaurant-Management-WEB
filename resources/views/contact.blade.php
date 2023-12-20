@extends('layouts.template')

@section('content')

    <div class="container mx-auto mt-8 mb-16 lg:px-40 lg:mt-12">
        <div class="mx-2 lg:mx-20 flex flex-col lg:flex-row lg:h-96 bg-white lg:h-auto border border-gray-300 shadow-lg rounded-lg overflow-hidden">
            <div class="w-full lg:w-1/2">
                <div class="h-full p-8">
                    <p class="mb-4 lg:mb-8 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Got a problem? Want to send feedback? Let us know.</p>
                    <form action="#" class="space-y-2">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
                        </div>
                        <div>
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                            <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                            <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
                        </div>
                        <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>

                    </form>
                </div>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10028.95889764036!2d112.57236926446836!3d-7.671341607710393!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7877bd527cd1b9%3A0x965cbf336a070cd0!2sOnoe&#39;iki!5e0!3m2!1sen!2sid!4v1702821337806!5m2!1sen!2sid"
                class="w-full lg:w-1/2"
                style="height: auto; border: 0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

@endsection
