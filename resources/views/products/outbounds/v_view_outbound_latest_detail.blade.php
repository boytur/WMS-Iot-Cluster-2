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
            <h1>รายละเอียดสินค้าเข้า</h1>
            <p>{{ $lot_out->lot_out_number }}</p>
            </p>
        </div>
    </div>
</div>

@endsection
