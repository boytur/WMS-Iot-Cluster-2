{{-- v_outbound_latest_detail.blade.php
    Display outbound latest detail
    @author : Pichawat Suwan
    @Create date : 2024-04-05
--}}
@extends('layouts.default')
@section('title', 'รายละเอียดสินค้าส่งออกล่าสุด')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > ส่งออก ></a>
                    <a href="{{ url('/product/outbounds/view-outbound-latest') }}">&nbsp;รายการล่าสุด > </a>
                    <a href="">&nbsp;รายละเอียด</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">
                    <div class="w-full bg-white rounded-md">
                        <div class=" w-full">
                            <div class="py-1 w-full bg-[#D9D9D9] sm:rounded-t-lg">
                                <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_count">
                                    รายละเอียดรายการส่งออก</b>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="flex gap-2">
                                <b>สร้างโดย : </b>
                                <p>{{ $user }}</p>
                            </div>
                            <div class="flex gap-2">
                                <b>วันที่สร้าง : </b>
                                <p>{{ date('d/m/Y', strtotime($lot_out->created_at)) }}</p>
                            </div>
                            <div class="flex gap-2">
                                <b>หมายเลขล็อต : </b>
                                <p>{{ $lot_out->lot_out_number }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                            <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_count">
                                ตารางรายการสินค้า</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md bg-white">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            รูปภาพสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ชื่อสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            บาร์โค้ด
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            จำนวน
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ประเภท
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            แท็ก
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            คลังสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            พื้นที่
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="">
                                    @foreach ($outbound_orders as $index => $outbound_order)
                                        <tr
                                            class="bg-white border-b w-full hover:bg-blue-100 cursor-pointer content-center">
                                            <td class="px-6 text-center">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 flex justify-center text-center py-5">
                                                <div class=" w-[5rem] h-[3rem] border">
                                                    <img class="object-cover w-full h-full"
                                                        src={{ $outbound_order->master_products->mas_prod_image }}
                                                        alt="">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_order->master_products->mas_prod_name }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_order->master_products->mas_prod_barcode }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_order->outbound_amount }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_order->master_products->categories->cat_name }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @foreach ($products->where('mas_prod_id', $outbound_order->mas_prod_id) as $product)
                                                    @if ($product->tags == [])
                                                        @foreach ($product->tags as $tag)
                                                            {{ $tag['tag_name'] }}
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                WH
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                Space
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($lot_out->lot_out_status === 'Initialized')
                                                    <div>
                                                        <p
                                                            class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                            {{ $outbound_order->outbound_status }}</p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p
                                                            class="border text-center bg-green-700 rounded-3xl py-1 text-white">
                                                            {{ $outbound_order->outbound_status }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
