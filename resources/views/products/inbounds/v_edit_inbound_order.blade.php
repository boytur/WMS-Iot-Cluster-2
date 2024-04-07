{{-- v_edit_inbound_order.blade.php
    Display from inbound order when press edit
    @author : Thanawan Kongchok
    @Create 1.0.0 Date : 2024-04-02
      --}}

@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าเข้า')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า > </a>
                    <a href="">&nbsp;แก้ไขรายการสินค้าเข้า</a>
                </div>
            </div>
            <div class="flex justify-end">
                <div class=" lg:pt-0 mr-2 mt-2 mb-1">
                    <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                        href="{{ url('product/inbounds/create-inbound-order') }}">
                        <div>
                           <div class="flex items-center gap-1">
                                <i class="fa-solid fa-circle-plus text-[0.8rem] "></i>
                                <div>
                                    <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div style="height: calc(100vh - 7rem)" class="w-full flex flex-col h-full overflow-y-scroll mt-2 px-2">
                <div class="w-full bg-white">
                    <div class="w-full bg-black/20  rounded-t-lg">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-black uppercase bg-[#D9D9D9]">
                                    <tr>
                                        <b class="mx-5  mt-2 text-lg text-black uppercase ">
                                            รายละเอียด</b>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>วันที่เพิ่ม: </b>
                        {{ date('d/m/Y', strtotime($lot_in->creat_at)) }}
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>เพิ่มโดย:</b>
                        {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }}
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>หมายเลขล็อต: </b>
                        {{ $lot_in->lot_in_number }}
                    </div>
                </div>
                </style=>
                {{-- table product --}}
                <div class="w-full mt-2 rounded-t-md">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            ตารางรายการสินค้านำเข้ารอจัดการ</b>
                    </div>
                    <div class="relative overflow-x-auto shadow-md ">
                        <table class="w-full text-sm text-left rtl:text-right ">
                            <thead class="text-xs text-white uppercase bg-[#273B4A] ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ลำดับ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        รูปภาพ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ชื่อ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        บาร์โคด
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3 text-center">
                                        จำนวน
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ประเภท
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        วันหมดอายุ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        จำนวน
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        การกระทำ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lot_in_products as $index => $lot_in_product)
                                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="px-6 py-4 text-center w-20">
                                            <img src=" {{ $lot_in_product->master_products->mas_prod_image }} " alt="" >

                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->mas_prod_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->mas_prod_barcode }}
                                        </td>

                                        {{-- <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->inbound_amount }}
                                        </td> --}}


                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->categories->cat_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->inbound_exp }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->inbound_amount }}
                                        </td>


                                        <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                            <a href="{{ url('/product/inbounds/edit-inbound-order' . '/' . $lot_in_product->lot_in_id) }}"
                                                class="">
                                                <i
                                                    class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                            |
                                            {{-- <a href="{{ url('/product/managements/detail/' . $lot_in->lot_in_id) }}">
                                        --}}
                                            <i
                                                class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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
@endsection
