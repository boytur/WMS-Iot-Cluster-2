@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าออก')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem]">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออก > </a>
                    <a href="">&nbsp;รายละเอียดรายการสินค้าส่งออก</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="bg-[#F6F9FC] flex flex-col overflow-y-scroll">
                    <div class="w-full-1 bg-black/20 mt-2 mx-2 rounded-md ">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-lg ">
                            <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_detail">
                                รายละเอียดรายการส่งออก</b>
                        </div>
                        <div class="w-full">
                            <div class="w-full  bg-white">
                                <div class="w-full flex">
                                    <div class="gap-2 py-3 px-6 ">
                                        <div>
                                            <p><b>ผู้ที่สร้าง :&nbsp;</b>{{ $user }}</p>
                                        </div>
                                        <div>
                                            <p><b>วันที่สร้าง
                                                    :&nbsp;</b>{{ date('d/m/Y', strtotime($lot_out->created_at)) }}
                                            </p>
                                        </div>
                                        <div>
                                            <p><b>หมายเลขใบสั่งซื้อ :&nbsp;</b>{{ $lot_out->lot_out_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- แสดงตาราง --}}
                    <div class="w-full-1  mt-2 mx-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-lg">
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
                                            รูปภาพ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ชื่อ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            บาร์โคด
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            จำนวน
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ประเภท
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            คลัง
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
                                    @foreach ($outbound_details as $index => $outbound_detail)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>

                                            <td class="px-6 py-4 flex justify-center">
                                                <div class=" w-[3rem] h-[2rem] border">
                                                    <img class="object-cover w-full h-full"
                                                        src="{{ $outbound_detail->master_products->mas_prod_image }}"
                                                        alt="">
                                                </div>
                                            </td>


                                            <td class="px-6 py-4 text-center">
                                                น้ำตาลถุง
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                123456789
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                5
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_detail->master_products->categories->cat_name }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                A{{ $index }}-1
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                wh-1
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                <div>
                                                    <p class="border text-center bg-[#AB7408] rounded-3xl py-1 text-white">
                                                        กำลังขนส่ง
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-center my-4">
                            {{ $outbound_details->links('pagination::custom-pagination') }}
                        </div>
                        <div class="card-footer pr-11">
                            <button class="btn btn-primary float-right h-[3rem] w-[10rem] justify-bottom">ยืนยันการส่งออก</button>
                            <a href=""><button
                                    class="btn btn-secondary float-right mr-2 h-[3rem] w-[10rem] justify-bottom">พิมพ์ใบส่งสินค้า</button></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
