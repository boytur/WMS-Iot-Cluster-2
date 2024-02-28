@extends('layouts.default')
@section('title', 'ดูภาพรวมทั้งหมด')

@section('content')
    <div style="height: calc(100vh - 4rem) "  class=" bg-img border w-full flex flex-col overflow-y-scroll">

        <div class="mt-[5rem] flex justify-center md:mt-0">
            <div class=" backdrop-blur-sm shadow-xl w-[17rem] h-[20rem] rounded-sm bg-sky-100 ">
                <div class="flex justify-center ">
                    <h1 class=" text-[1.5rem] mt-3">Login</h1>
                </div>
                <div class=" px-5 text-[0.8rem] mt-5">
                    <div>
                        <i class="fa - solid fa-user text-[0.8rem]"></i>
                        <label for="">Username</label>

                    </div>
                    <div>
                        <input type="text" class="input-primary h-[2rem] mt-1" placeholder="กรุณากรอกชื่อ">
                    </div>
                    <div>
                        <i class="fa - solid fa-key text-[0.8rem] mt-2"></i>
                        <label for="">Password</label>

                    </div>
                    <div>
                        <input type="text" class="input-primary h-[2rem] mt-1 " placeholder="***********">
                    </div>
                </div>
                <div class="flex justify-center mt-5">
                    <button class="btn-primary px-24 py-2 "> Login</button>
                </div>

            </div>



        </div>
    </div>
@endsection
