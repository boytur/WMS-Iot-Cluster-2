@extends('layouts.default')

@section('title', 'ส่งออกด้วยใบจำหน่าย')
@section('content')


<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="">สินค้า > ส่งสินค้าออก</a>
            </div>
        </div>
        <div class="w-full p-2">
            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">
                <div class="w-full p-5 bg-white rounded-md">
                    <div class=" w-full flex ">

                        {{-- search input --}}
                        <div class="w-3/4 flex gap-2 ">
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
                        {{-- add LotOut inbound --}}
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
                                <a class="btn-secondary px-4 flex items-center h-[3rem] gap-1"
                                    href="{{ url('product/outbounds/view-outbound-latest') }}">
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <i
                                                class="fa-solid fa-clock-rotate-left cursor-pointer text-[0.8rem] mt-[2px]"></i>
                                            <div>
                                                <p class=" md:text-sm lg:block hidden text-[0.5]">รายการล่าสุด</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-3 lg:pt-0">
                                <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                                    href="{{ url('product/outbounds/create-outbound-order') }}">
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                            <div>
                                                <p class="lg:text-sm lg:block hidden">สร้างรายการส่งออก</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-black/20 mt-2 rounded-md">
                    <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                        <b class="mx-2  mt-2 rounded-md text-black text-lg">
                            ตารางรายการสินค้าส่งออกรอจัดการ</b>
                    </div>
                    <div class="relative overflow-x-auto shadow-md ">
                        <table class="w-full text-sm text-left rtl:text-right bg-[#212529] ">
                            <thead class="text-xs text-white uppercase ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ลำดับ
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        หมายเลขรายการส่งออก
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        วันที่สร้าง
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ผู้ที่สร้าง
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
                                @foreach ($lotouts as $index => $LotOut)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $index+1 }}
                                    </th>

                                    <td class="px-6">
                                        {{ $LotOut->lot_out_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date('d/m/Y', strtotime($LotOut->created_at)) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $LotOut->users->fname.' '.$LotOut->users->lname }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($LotOut->lot_out_status === 'Initialized')
                                        <div>
                                            <p class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                {{ $LotOut->lot_out_status }}</p>
                                        </div>
                                        @else
                                        <div>
                                            <p class="border text-center bg-green-700 rounded-3xl py-1 text-white">
                                                {{ $LotOut }}</p>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex gap-3 text-gray-500">


                                        <i
                                            class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                        |

                                        <i
                                            class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center my-4">
                    {{ $lotouts->links('pagination::custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
