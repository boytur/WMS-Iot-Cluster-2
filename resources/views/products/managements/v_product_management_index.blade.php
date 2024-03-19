@extends('layouts.default')

@section('title', 'จัดการสินค้า')
@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="">สินค้า > จัดการสินค้า</a>
            </div>
        </div>
        <div class="w-full p-2">
            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm overflow-y-scroll">

                <div class="w-full p-5 bg-white rounded-md pb-8">
                    {{-- box-1 --}}
                    <div class="w-full flex">

                        {{-- search input --}}
                        <div class="w-3/4 flex gap-2 h-full">
                            <div class="w-full">
                                <div>
                                    <p class="text-black/70 text-sm">ค้นหาสินค้า</p>
                                    <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                        class="input-primary h-[3rem]" name="" id="">
                                </div>
                            </div>
                            <div class="md:w-[15rem]">
                                <div>
                                    <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                    <select name="" id="" class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                        <option value="">บาร์โค้ด</option>
                                        <option value="">หมายเลขสินค้า</option>
                                        <option value="">ชื่อสินค้า</option>
                                    </select>
                                </div>
                            </div>
                            <div class="md:w-[10rem] h-full mt-5">
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
                        <div class="w-full flex justify-end gap-3 mt-2">
                            <div class="mt-3 lg:pt-0">
                                <button class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                                    <a href="{{ url('/product/managements/add-new-product') }}">
                                        <div class="flex items-center gap-1">
                                            <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                            <div>
                                                <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                            </div>
                                        </div>

                                    </a>

                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- end box-1 --}}
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
                                        รูปภาพสินค้า
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ชื่อสินค้า
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ประเภทสินค้า
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        แท็ก
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        วันที่เพิ่ม
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        การกระทำ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                                    onclick="onclick_product_details('/product/managements/detail/{{ $product->mas_prod_id }}')">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $index+1 }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $product->mas_prod_no }}
                                    </td>
                                    <td class="px-6">
                                        <div class=" w-[3rem] h-[2rem] border">
                                            <img class="object-cover w-full h-full" src={{ $product->mas_prod_image }}
                                            alt="">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $product->mas_prod_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $product->categories->cat_name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @foreach ($product->tags as $tag)
                                        {{ $tag->tagname }}
                                        @endforeach
                                        @if($product->tags->count() === 0)
                                        <p>-</p>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ date('d/m/Y', strtotime($product->created_at)) }}
                                    </td>

                                    <td class="px-6 py-4 flex gap-3 text-gray-500">
                                        <a href="{{ url('/product/managements/edit/' . $product->mas_prod_id) }}"
                                            class="">
                                            <i
                                                class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                        |
                                        <a href="{{ url('/product/managements/detail/' . $product->mas_prod_id) }}">
                                            <i
                                                class="fa-solid fa-circle-info text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center my-4">
                    {{ $products->links('pagination::custom-pagination') }}
                </div>

            </div>
        </div>
    </div>
    @endsection
