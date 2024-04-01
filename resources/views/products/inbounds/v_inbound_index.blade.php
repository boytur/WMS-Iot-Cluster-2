@extends('layouts.default')

@section('title', 'นำเข้าด้วยหมายเลขล็อต')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > รับสินค้าเข้า</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                    <div class="w-full p-5 bg-white rounded-md">
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
                                        <button
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
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
                                <div class=" items-center flex h-full relative">
                                    <i class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4"></i>
                                    <div class="absolute flex top-4 left-[-8px]">
                                        <p
                                            class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                            1</p>
                                    </div>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <button class="btn-secondary px-4 flex items-center h-[3rem] gap-1">
                                        <a href="{{ url('/product/inbounds/view-inbound-latest') }}">
                                            <div class="flex items-center gap-1">
                                                <i
                                                    class="fa-solid fa-clock-rotate-left cursor-pointer text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class=" md:text-sm lg:block hidden text-[0.5]">รายการล่าสุด</p>
                                                </div>
                                            </div>
                                        </a>

                                    </button>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <button class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                                        <a href="{{ url('product/inbounds/create-inbound-order') }}">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">เพิ่มสินค้าเข้าคลัง</p>
                                                </div>
                                            </div>

                                        </a>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- table product --}}
                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            หมายเลขสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            วันที่สร้าง
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            ผู้สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            สถานะ
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            การกระทำ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lot_in_products as $index => $lot_in)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $lot_in->lot_in_number }}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ date('d/m/Y', strtotime($lot_in->created_at)) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($lot_in->lot_in_status === 'Initialized')
                                                    <div>
                                                        <p
                                                            class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                            {{ $lot_in->lot_in_status }}</p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p
                                                            class="border text-center bg-green-700 rounded-3xl py-1 text-white">
                                                            {{ $lot_in->lot_in_status }}</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex gap-3 text-gray-500">
                                                {{--  <a href="{{ url($lot_in->lot_in_id) }}" class="">  --}}
                                                <i
                                                    class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                                |
                                                {{--  <a href="{{ url('/product/managements/detail/' . $lot_in->lot_in_id) }}">  --}}
                                                <i
                                                    class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                            </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center my-4">
                        {{ $lot_in_products->links('pagination::custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
