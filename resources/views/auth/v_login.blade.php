<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WMS | Login</title>
    @vite('resources/css/app.css')
</head>
{{-- โอ้วเเม่เจ้า --}}
<body>
    <div class="flex justify-center w-full">
        <img class="w-full h-full absolute object-cover z-0" src="{{ URL::to('/assets/loginbg.png') }}">

        <div class="w-full h-full md:flex px-3 justify-center max-w-screen-xl z-50">
            {{-- Text --}}
            <div class="w-full flex text-center items-center flex-col justify-center">
                <p class="md:text-[2.7rem] text-[2rem] mt-6 md:mt-0 w-full text-white font-bold"> Warehouse Management +
                    Iot</p>
                <p class="text-[1rem] w-full text-white">by cluster 2</p>
            </div>

            {{-- Login box --}}
            <div class="w-full md:h-[84vh] my-12 flex items-center justify-center ">
                <div class="w-[27rem] h-[30rem] bg-white rounded-md flex justify-center flex-col shadow-xl">

                    <div>
                        <h1 class="text-[2.5rem] font-bold text-center">Login</h1>
                    </div>

                    {{-- username --}}
                    <div class=" text-black/70 md:mx-12 mx-3 mt-5">
                        <div>
                            <i class="fa-solid fa-user"></i>
                            <label for="">username</label>
                        </div>
                        <div>
                            <input class="input-primary mt-2 py-3" placeholder="username or email" type="text">
                        </div>
                    </div>

                    {{-- password --}}
                    <div class=" text-black/70 md:mx-12 mx-3 mt-3">
                        <div>
                            <i class="fa-solid fa-key"></i>
                            <label for="">password</label>
                        </div>
                        <div>
                            <input class="input-primary mt-2 py-3" placeholder="************" type="password">

                            <div class="mt-8">
                                <a href="/dashboard/analytic">
                                    <button class="btn-primary w-full h-[3.2rem]">Login</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
