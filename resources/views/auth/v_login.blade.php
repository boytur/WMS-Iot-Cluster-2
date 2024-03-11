<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WMS | Login</title>
    @vite('resources/css/app.css')
</head>

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

                    {{-- Login form --}}
                    <form action="{{ route('login') }}" method="POST" class="md:mx-12 mx-3 mt-5">
                        @csrf
                        {{-- username --}}
                        <div class="text-black/70">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                <label for="email">Email</label>
                            </div>
                            <input id="email" name="email" class="input-primary mt-2 py-3"
                                placeholder="Enter your email" type="text" value="{{ old('user_email') }}">
                        </div>

                        {{-- password --}}
                        <div class="text-black/70 mt-3">
                            <div class="flex items-center">
                                <i class="fas fa-key mr-2"></i>
                                <label for="password">Password</label>
                            </div>
                            <div class="relative flex justify-end items-center">
                                <i onclick="toggle_show_password()" id="eye" class="fa-solid fa-eye absolute mt-3 mr-4"></i>
                                <input id="password" name="password" class="input-primary mt-2 py-3"
                                    placeholder="Enter your password" type="password">
                            </div>
                        </div>
                        <div class="flex justify-start">
                            @error('login')
                            <span class="text-red-500 mt-4 text-[0.8rem]">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="btn-primary w-full h-[3.2rem]">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>

    /*  * toggle_show_password()
        * @author: Piyawat Wongyat 65160340
        * @create date: 2024-03-11
    */

    const toggle_show_password = () => {

        const eye_element = document.getElementById('eye');
        const password = document.getElementById('password');

        if (eye_element.classList.contains('fa-eye')) {
            eye_element.classList.remove('fa-eye');
            eye_element.classList.add('fa-eye-slash');
            password.type="text";
        } else {
            eye_element.classList.remove('fa-eye-slash');
            eye_element.classList.add('fa-eye');
            password.type="password";
        }
    }

</script>

</html>
