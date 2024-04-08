@extends('layouts.default')
@section('title', 'รายละเอียดสินค้า')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="{{ url('/product/managements') }}">สินค้า > จัดการสินค้า > </a>
                <a href="">&nbsp;รายละเอียดสินค้า</a>
            </div>
        </div>
        <div class="w-full p-2">

            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                <div class=" w-full border h-auto rounded-md">
                    {{-- card product --}}
                    <div class=" w-full h-[11rem] bg-white rounded-md">

                        <div class="w-full h-full flex">
                            @if($product !== null)
                            <div class="flex h-full items-center p-2">
                                <img class="w-[13rem] h-[10rem] object-cover rounded-md" src={{
                                    $product->mas_prod_image }} alt="">
                            </div>
                            <div class="w-full h-full">
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">หมายเลขสินค้า : </h1>
                                    <h1>{{ $product->mas_prod_no }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">ชื่อสินค้า : </h1>
                                    <h1>{{ $product->mas_prod_name }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">ประเภท : </h1>
                                    <h1>{{ $product->categories->cat_name }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">วันที่เพิ่ม : </h1>
                                    <h1>{{ date('d/m/Y', strtotime($product->created_at)) }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">แท็ก : </h1>
                                    @foreach ($product->tags as $tag)
                                    {{ $tag->tag_name }}
                                    @endforeach
                                    @if($product->tags->count() === 0)
                                    <p>-</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- table --}}
                <div class="w-full rounded-t-md mt-2">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            พื้นที่จัดเก็บ</b>
                    </div>
                    <div class="relative overflow-x-auto shadow-md">
                        <table class="w-full text-sm text-left rtl:text-right ">
                            <thead class="text-xs text-white uppercase bg-[#212529]">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ลำดับ
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        หมายเลขล็อต
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        วันที่สร้าง
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        ผู้สร้าง
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        หมายเลขสินค้า
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        คลังสินค้า
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        พื้นที่จัดเก็บ
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        สถานะ
                                    </th>
                                </tr>
                            </thead>
                            
                           
                            <tbody>
                                {{-- @foreach($product as $index) --}}
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                      1{{-- {{ $index + 1 }} --}}
                                </th>
                                <td class="px-6 py-4 text-center">
                                    {{ $product->mas_prod_name }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ date('d/m/Y', strtotime($product->created_at)) }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $product->mas_prod_no . ' ' . $product->mas_prod_no }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $product->mas_prod_no }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $product->mas_prod_no }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $product->mas_prod_no }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($product->mas_prod_no === 'Initialized')
                                    <div>
                                        <p class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                            ยังไม่ได้จัดเก็บ
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
                                {{-- @endforeach --}} 
                                </tr>
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection