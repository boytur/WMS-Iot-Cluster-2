@extends('layouts.default')
@section('title', 'เพิ่มสินค้าเข้าคลัง')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="{{ url('/product/outbounds') }}">สินค้า > รับเข้า > </a>
                <a href="">&nbsp;เพิ่มสินค้าเข้าคลัง</a>
            </div>
        </div>
        <div class="w-full p-2">
            <h1>Add In bound order product</h1>
        </div>
    </div>
</div>

@endsection
