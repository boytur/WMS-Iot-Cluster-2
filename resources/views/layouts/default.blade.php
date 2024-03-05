{{--
* default.blade.php
* Display sidebar menu
* @author Piyawat Wongyat 65160340
* @create date : 2024-02-27
--}}
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>WMS | @yield('title',"WMS + Iot")</title>
</head>

<body>

    {{-- Mobile --}}
    <nav class="w-full md:hidden border absolute bg-white">
        <div class="flex gap-3 p-3 items-center">
            <div onclick="toggle_sidebar()">
                <i class="fa-solid fa-bars text-xl hover:scale-105 pt-2"></i>
            </div>
            <div class="text-[1.6rem]">
                <h1>LOGO</h1>
            </div>
            <div class="w-full flex justify-end ">
                <img class="w-[2.5rem] rounded-full border border-[#5d87ff]"
                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                    alt="">
            </div>
        </div>
    </nav>

    {{-- Desktop --}}
    <nav id="nav-bar"
        class="w-[15rem] h-full flex flex-col gap-3 p-3 items-center bg-white absolute md:left-0 left-[-100%] transition-all">
        <div class="h-[4rem] text-[2rem] hidden md:block">
            <h1>LOGO</h1>
        </div>

        <div class="flex items-center justify-start mt-1 gap-5 w-full pl-2 md:hidden">
            <div onclick="toggle_sidebar()">
                <i class="fa-solid fa-x text-xl hover:scale-105 pt-2"></i>
            </div>
            <div class="text-[1.6rem] mt-1">
                <h1>LOGO</h1>
            </div>
        </div>

        <div>
            <ul class="flex justify-center flex-col gap-4">

                {{-- แดชบอร์ด --}}
                <li>
                    <div class="flex flex-col gap-5">
                        <div class="text-[1.2rem] flex items-center gap-2">
                            <i class="fa-solid fa-square-poll-vertical"></i>
                            <p>แดชบอร์ด</p>
                        </div>
                        <div class="flex">
                            <div class="bg-black/20 w-[1.5px] ml-2 mb-[1rem]"></div>
                            <div class="flex flex-col gap-2 pl-7 w-full">

                                {{-- ภาพรวมทั้งหมด --}}
                                @if(request()->is('dashboard/view-all'))
                                <a href={{ url('dashboard/view-all') }}
                                    class="px-8 py-2 rounded-md bg-blue-700 text-white">
                                    <div>ภาพรวมทั้งหมด</div>
                                </a>
                                @else
                                <a href={{ url('dashboard/view-all') }}>
                                    <div class="px-8 py-2 rounded-md hover:bg-[#5d87ff] hover:text-white">
                                        ภาพรวมทั้งหมด
                                    </div>
                                </a>
                                @endif

                                {{-- ดูคลังสินค้าอื่น --}}
                                @if(request()->is('dashboard/view-another'))
                                <a href={{ url("/dashboard/view-another") }}>
                                    <div class="px-8 py-2 rounded-md bg-blue-700 text-white">
                                        ดูคลังสินค้าอื่น
                                    </div>
                                </a>
                                @else
                                <a href={{ url('/dashboard/view-another') }}
                                    class="px-8 py-2 rounded-md hover:bg-[#5d87ff] hover:text-white">
                                    <div>
                                        ดูคลังสินค้าอื่น
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>

                {{-- สินค้า --}}
                <li>
                    <div class="flex flex-col gap-5">
                        <div class="text-[1.2rem] flex items-center gap-2">
                            <i class="fa-solid fa-box"></i>
                            <p>สินค้า</p>
                        </div>
                        <div class="flex w-full">
                            <div class="bg-black/20 w-[1.5px] ml-2 mb-[1rem]"></div>
                            <div class="flex flex-col gap-2 pl-7 w-full">

                                {{-- รับสินค้าเข้า --}}
                                @if(request()->is('product/inbounds'))
                                <a href="{{ url('/product/inbounds') }}"
                                    class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">
                                    <div>รับสินค้าเข้า</div>
                                </a>
                                @else
                                <a href="{{ url('/product/inbounds') }}"
                                    class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                    <div>รับสินค้าเข้า</div>
                                </a>
                                @endif

                                {{-- ส่งสินค้าออก --}}
                                @if(request()->is('product/outbounds'))
                                <a href="{{ url('/product/outbounds') }}"
                                    class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">
                                    <div>ส่งสินค้าออก</div>
                                </a>
                                @else
                                <a href="{{ url('/product/outbounds') }}"
                                    class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                    <div>ส่งสินค้าออก</div>
                                </a>
                                @endif

                                {{-- จัดการสินค้า --}}
                                @if(request()->is('product/managements'))
                                <a href="{{ url('/product/managements') }}"
                                    class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">
                                    <div>จัดการสินค้า</div>
                                </a>
                                @else
                                <a href="{{ url('/product/managements') }}">
                                    <div class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                        จัดการสินค้า</div>
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </li>
                {{-- คลังสินค้า --}}
                <li>
                    <div class="flex flex-col gap-5">
                        <div class="text-[1.2rem] flex items-center gap-2">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <p>คลังสินค้า</p>
                        </div>
                        <div class="flex">
                            <div class="bg-black/20 w-[1.5px] ml-2 mb-[1rem]"></div>
                            <div class="flex flex-col gap-2 pl-7">

                                {{-- เพิ่มพื้นที่จัดเก็บ --}}
                                @if(request()->is('warehouse/add-space'))
                                <a href="{{ url('/warehouse/add-space') }}"
                                    class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">
                                    <div>เพิ่มพื้นที่จัดเก็บ</div>
                                </a>
                                @else

                                <a href="{{ url('/warehouse/add-space') }}"
                                    class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                    <div>เพิ่มพื้นที่จัดเก็บ</div>
                                </a>
                                @endif

                                {{-- เพิ่มพื้นที่จัดเก็บ --}}
                                @if(request()->is('warehouse/add-wh'))
                                <a href="{{ url('/warehouse/add-wh') }}">
                                    <div class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">
                                        เพิ่มคลังสินค้า
                                    </div>
                                </a>
                                @else
                                <a href="{{ url('/warehouse/add-wh') }}">
                                    <div class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                        เพิ่มคลังสินค้า
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                {{-- ผู้ใช้งาน --}}
                <li>
                    <div class="flex flex-col gap-5">
                        <div class="text-[1.2rem] flex items-center gap-2">
                            <i class="fa-solid fa-users"></i>
                            <p>ผู้ใช้งาน</p>
                        </div>
                        <div class="flex">
                            <div class="bg-black/20 w-[1.5px] ml-2 mb-[1rem]"></div>
                            <div class="flex flex-col gap-2 pl-7">

                                {{-- จัดการผู้ใช้งาน --}}
                                <a href="{{ url('/management') }}">
                                    <div @if(request()->is('management'))
                                        class="px-8 py-2 rounded-md bg-blue-700 text-white w-full">จัดการผู้ใช้งาน
                                    </div>
                                </a>
                                @else
                                <a href="{{ url('/management') }}">
                                    <div class="px-8 py-2 rounded-md w-full hover:bg-[#5d87ff] hover:text-white">
                                        จัดการผู้ใช้งาน
                                    </div>
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    {{-- profile desktop --}}
    <div class="relative hidden md:flex justify-end text-[#2a3547]">
        {{-- profile box --}}
        <div id="profile-desktop"
            class="w-[15rem] h-[10rem] hidden  absolute mt-16 mr-12 rounded-md bg-white shadow-lg border">
            <div class="flex gap-2 items-center justify-start pl-10 mt-6 text-[1.2rem]">
                <i class="fa-solid fa-user"></i>
                <p>พิชณวัฒน์ สุวรรณ</p>
            </div>
            <div class="flex gap-2 items-center justify-start pl-10 mt-3 text-[1.2rem]">
                <i class="fa-solid fa-house-user"></i>
                <p>WH-1</p>
            </div>
            <div class="px-2">
                <div class="btn-secondary-2 flex gap-2 items-center justify-center mt-3 text-[1.2rem] py-3 rounded-md">
                    <p>ออกจากระบบ</p>
                </div>
            </div>
        </div>
        <div class="w-full justify-end hidden md:flex px-5 py-2">
            <img onclick="toggle_profile_desktop()" class="w-[2.5rem] rounded-full hover:scale-105 cursor-pointer"
                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="">
        </div>
    </div>

    {{-- contents --}}
    <div class="md:ml-[15rem]">
        @yield('content')
    </div>

</body>

<script>

    /*
        * toggle_sidebar()
        * @author: Piyawat Wongyat 65160340
        * @create date: 2024-02-27
    */

    const toggle_sidebar = ()=> {
        const sidebar = document.querySelector('#nav-bar');
        sidebar.classList.toggle('left-[-100%]');
    }

    /*  * toggle_profile_desktop()
        * @author: Piyawat Wongyat 65160340
        * @create date: 2024-02-27
    */

    const toggle_profile_desktop = () => {
        const profile_desktop = document.querySelector('#profile-desktop');
        profile_desktop.classList.toggle('md:block');
    }

</script>

</html>
