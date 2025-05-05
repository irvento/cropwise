<div class="min-h-screen flex flex-row  items-center pt-6  bg-gray-100 dark:bg-gray-900">

    
    <div class="h-full w-1/2  justify-center sm:flex ">
        <div class="w-full  mt-6 px-6 py-4">
            <div class="h-70 w-auto mb-4 justify-center flex p-4">
                {{ $logo }}
            </div>
            <div class="mb-4 justify-center flex text-xl font-bold text-gray-900 dark:text-white">
                <p>CropWise</p>
            </div>
        </div>
    </div>


    <div class="h-full w-1/2 items-center justify-center sm:flex">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 
                bg-white/80 border border-black rounded-lg shadow-md 
                dark:bg-gray-800/80 dark:border-white overflow-hidden">
            <div class="mt-4 mb-4 justify-center flex">
                <h1>LOGIN</h1>
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>

</div>
