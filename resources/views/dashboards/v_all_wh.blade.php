@extends('layouts.default')
@section('title', 'ดูภาพรวมทั้งหมด')

@section('content')
    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col overflow-y-scroll">
        <div class="mt-[5rem] md:mt-0  mx-3">
            <p class="font-bold text-sm mt-3 ">แดชบอร์ด/ภาพรวมทั้งหมด</p>
            <div class="flex justify-center  ">

                <div class=" w-64 h-32 rounded-md shadow-2xl bg-white  mx-7 mt-4 text-center justify-center items-center">
                    <div class=" flex text-center justify-center mt-7">
                        <div class=" flex items-center gap-3 mt-4">
                            <p>icon</p>
                            <p class="mx-2 font-bold text-2xl">20,000</p>

                        </div>
                    </div>
                    <div class=" mt-7 text-xs font-bold">ยอดสิค้ารับเข้าวันนี้</div>
                </div>
                <div class=" w-64 h-32 rounded-md shadow-2xl bg-white mx-7 mt-4 text-center justify-center items-center">
                    <div class=" flex text-center justify-center mt-7">
                        <div class=" flex items-center gap-3 mt-4">
                            <p>icon</p>
                            <p class="mx-2 font-bold text-2xl">12,467</p>

                        </div>
                    </div>
                    <div class=" mt-7 text-xs font-bold">ยอดสินค้าส่งออกวันนี้</div>
                </div>
                <div class=" w-64 h-32 rounded-md shadow-2xl bg-white mx-7 mt-4 text-center justify-center items-center">
                    <div class=" flex text-center justify-center mt-7">
                        <div class=" flex items-center gap-3 mt-4">
                            <p>icon</p>
                            <p class="mx-2 font-bold text-2xl">10,300</p>

                        </div>
                    </div>
                    <div class=" mt-7 text-xs font-bold">สินค้าทั้งหมด</div>
                </div>
                <div class=" w-64 h-32 rounded-md  shadow-2xl bg-white mx-7 mt-4 text-center justify-center items-center">
                    <div class=" flex text-center justify-center mt-7">
                        <div class=" flex items-center gap-3 mt-4">
                            <p>icon</p>
                            <p class="mx-2 font-bold text-2xl">5</p>

                        </div>
                    </div>
                    <div class=" mt-7 text-xs font-bold">คลังสินค้าทั้งหมด</div>
                </div>



            </div>
            <div>
                <p class="font-bold text-sm mt-4 ">รายการสินค้าเข้า-ออก</p>
                <div class="flex justify-center mt-4 ">
                    <div class=" w-[75rem] h-[25rem] shadow-2xl bg-white rounded-xl ">

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
