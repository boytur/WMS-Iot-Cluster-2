@extends('layouts.default')
@section('title', 'รายละเอียดสินค้าเข้า')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า > </a>
                <a href="">&nbsp;รายละเอียด</a>
            </div>
        </div>
        <div class="w-full p-2">

            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                <div class="w-full bg-black/20 mt-2 rounded-md">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            รายละเอียด</b> {{-- title --}}
                    </div>

                    <div class="bg-white" id="lot_in_detail">
                        <div class=" px-5 py-3">
                            <b>วันที่เพิ่ม : </b> {{date('d/m/Y', strtotime($lot_in->created_at))}} <br>
                            <b>เพิ่มโดย : </b> {{$lot_in->users->fname . ' ' . $lot_in->users->lname}} <br>
                            <b>หมายเลขล็อต : </b> {{ $lot_in->lot_in_number }} <br>
                        </div>
                    </div>
                </div>

                {{--table--}}
                <div class="w-full bg-black/20 mt-2 rounded-md">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            ตารางรายการสินค้า </b> {{-- title --}}
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                        บาร์โค้ด
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        จำนวน
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        ประเภท
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        วันหมดอายุ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        สถานะ
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="lot_in_detail">
                                @foreach ($inbound_products as $index => $inbound_product)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ (int)$index + 1 }}
                                    </th>

                                    <td class="px-6 py-4 flex justify-center">
                                        <div class=" w-[3rem] h-[2rem] border">
                                            <img class="object-cover w-full h-full" src="{{ $inbound_product->master_products->mas_prod_image}}" alt="">
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 text-center">
                                        {{ $inbound_product->mas_prod_id }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $inbound_product->master_products->mas_prod_barcode}}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $inbound_product->lot_in_id }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $inbound_product->master_products->categories->cat_name }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ date('d/m/Y', strtotime($inbound_product->inbound_exp)) }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if ($inbound_product->inbound_status === 'Initialized')
                                        <div>
                                            <p class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                นำเข้าระบบ
                                            </p>
                                        </div>
                                        @else
                                        <div>
                                            <p class="border text-center bg-green-700 rounded-3xl py-1 text-white ">
                                                จัดเก็บ
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

                {{-- เลือกแสดงตาราง --}}
                <div class="flex justify-center my-4">
                    {{ $inbound_products->links('pagination::custom-pagination') }}

                </div>
                {{--ปุ่มค้นหา--}}
                <div class="mt-3 flex items-end justify-end pb-3">
                    <button onclick="" id="search_wh" class="w-[10rem] h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                        <div>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div type="submit">
                            <p>หาพื้นที่จัดเก็บ</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const onclick_inbound_lastest_deatil = (lot_in_id) => {
        const cluster = '{{ env('CLUSTER') }}'
        window.location.href = `${cluster}/product/inbounds/inbound-detail/${lot_in_id}`;
    }
</script>
@endsection
