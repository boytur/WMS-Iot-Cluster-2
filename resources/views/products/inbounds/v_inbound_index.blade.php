@extends('layouts.default')

@section('title', 'นำเข้าด้วยหมายดเลขล็อต')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > รับสินค้าเข้า</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  bg-white overflow-y-scroll">

                    <div class="w-full p-5">
                        <div class=" w-full flex">

                            {{-- search input --}}
                            <div class="w-3/4 flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหา</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="" id="">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">สถานะ</p>
                                        <select name="" id="" class="w-full h-[3rem] input-primary px-2">
                                            <option value="">รอดำเนินการ</option>
                                            <option value="">ปิดล็อต</option>
                                            <option value="">ทั้งหมด</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full  mt-5">
                                    <div class="w-full">
                                        <button class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                                            <div>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div>
                                                <p>ค้นหา</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- add product inbound --}}
                            <div class="w-full flex justify-end gap-3 mt-3">
                                <div class=" items-center flex h-full">
                                    <i class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4" ></i>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <button class="btn-secondary px-4 py-1">
                                        <div class="h-full w-full mr-3">
                                            <i class="fa-solid fa-clock-rotate-left cursor-pointer"></i>
                                        </div>
                                        <div>
                                            <p class=" md:text-sm lg:block hidden">รายการล่าสุด</p>
                                        </div>
                                    </button>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <button class="btn-primary px-4 py-1">
                                        <div>
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </div>
                                        <div>
                                            <p class="lg:text-sm lg:block hidden">เพิ่มสินค้าเข้าคลัง</p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
