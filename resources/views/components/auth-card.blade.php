<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="bg-gray-200 lg:container mx-auto">
        <div class="flex flex-col md:flex-row h-screen items-center">
            {{ $slot }}
        </div>
    </div>
</div>
