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

            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  bg-white overflow-y-scroll">

                <div class=" w-full border h-full rounded-md">
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
                                    <h1 class=" font-bold">หมายเลขสินค้า:</h1>
                                    <h1>{{ $product->mas_prod_no }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">ชื่อสินค้า:</h1>
                                    <h1>{{ $product->mas_prod_name }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">ประเภท:</h1>
                                    <h1>{{ $product->categories->cat_name }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">วันที่เพิ่ม:</h1>
                                    <h1>{{ $product->create_At }}</h1>
                                </div>
                                <div class="flex gap-1  ml-2 mt-2">
                                    <h1 class=" font-bold">แท็ก:</h1>
                                    @foreach ($product->tags as $tag)
                                    {{ $tag->tagname }}
                                    @endforeach
                                    @if($product->tags->count() === 0)
                                    <p>-</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    {{--  details  --}}
                    <div class="w-full h-[10rem] bg-black/30">

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
