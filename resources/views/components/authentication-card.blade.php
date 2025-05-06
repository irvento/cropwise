<div class="h-screen overflow-hidden flex flex-row sm:flex-row items-center bg-gray-100 dark:bg-gray-900">

    {{-- Left Panel (Logo + Title) --}}
    <div class="w-full sm:w-1/2 flex items-center justify-center h-full" 
         style="background-image: linear-gradient(white, rgb(222, 159, 0));">
        <div class="w-full max-w-md px-6 py-14 text-center">
            <div class="mb-4 flex justify-center">
                <div class="h-70 w-auto p-4">
                    {{ $logo }}
                </div>
            </div>
            <div>
                <p style="font-family:Arial Black, Gadget, sans-serif; font-size: 50px; text-shadow: -6px 4px 2px #0000008f; letter-spacing: 2px; word-spacing: 2px; color: #e3ff66; font-weight: 700; text-decoration: none solid rgb(68, 68, 68); font-style: normal; font-variant: normal; text-transform: uppercase;">CropWise</p>
            </div>
        </div>
    </div>

    {{-- Right Panel (Login Form) --}}
    <div class="w-full sm:w-1/2 h-full flex items-center justify-center" 
         style="background-image: url(https://images.pexels.com/photos/259280/pexels-photo-259280.jpeg?cs=srgb&dl=pexels-pixabay-259280.jpg&fm=jpg); background-size: cover; background-position: center;">
    
        <div class="w-full max-w-md px-6 py-6 
                    bg-white/80 border border-black rounded-lg shadow-lg
                    dark:bg-gray-800/80 dark:border-white overflow-hidden">
        

            <div>
                {{ $slot }}
            </div>

        </div>
    </div>

</div>
