<div
    class="min-h-screen flex  sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-[#f2fcfe] to-[#1c92d2]">

    <div class="flex space-x-20 items-center ">
        <div>
            {{ $logo }}
        </div>

        <div class="w-full h-full sm:max-w-md mt-6 px-6 py-4 bg-white  overflow-hidden sm:rounded-2xl shadow-2xl">
            {{ $slot }}
        </div>
    </div>
</div>
