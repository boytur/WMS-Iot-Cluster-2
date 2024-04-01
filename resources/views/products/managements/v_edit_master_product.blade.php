@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าหลัก')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/managements') }}">สินค้า > จัดการสินค้า > </a>
                    <a href="">&nbsp;แก้ไขสินค้า</a>
                </div>
            </div>
            <div class="w-full p-2 bg-white m-1 rounded-md">
                <h1>รายละเอียดสินค้า</h1>
                <br>
                <hr>
                <br>
                <div class="w-full bg-white h-[37rem] mt-2 rounded-md flex sm:flex sm:flex">

                    {{-- input data --}}
                    <div class="  w-full">
                        <div class="w-full bg-black/20 mt-2 rounded-md">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right ">
                                    <thead class="text-xs text-white uppercase bg-[#212529]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                แก้ไขสินค้า
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row mx-6">
                            <label for="num_product" class="col-sm-2 col-form-label ">หมายเลขสินค้า</label>
                            <input type="text" placeholder="กรอกรายละเอียดที่ต้องการ" class="input-primary h-[3rem] my-2"
                                name="" id="">
                        </div>
                        <div class="form-group row mx-6">
                            <label for="name_product" class="col-sm-2 col-form-label ">ชื่อสินค้า</label>
                            <input type="text" placeholder="กรอกรายละเอียดที่ต้องการ" class="input-primary h-[3rem] my-2"
                                name="" id="">
                        </div>
                        <div class="form-group row mx-6">
                            <label for="type_product" class="col-sm-2 col-form-label ">ประเภท</label>
                            <input type="text" placeholder="กรอกรายละเอียดที่ต้องการ" class="input-primary h-[3rem] my-2"
                                name="" id="">
                        </div>
                        <div class="form-group row mx-6">
                            <label for="sum_product"
                                class="col-sm-2 col-form-lable">จำนวนที่สามารถวางได้เต็มช่อง(ชิ้น)</label>
                            <input type="text" placeholder="กรอกรายละเอียด" class="input-primary h-[3rem] my-2"
                                name="" id="">
                        </div>
                        <div class="form-group row mx-6">
                            <label for="tag_product" class="col-sm-2 col-form-lable">แท็ก</label>
                            <input type="text" placeholder="กรอกรายละเอียด" class="input-primary h-[3rem] my-2"
                                name="" id="">
                        </div>
                        <div class="form-group row mx-6">
                            <label for="barcode" class="col-sm-2 col-form-lable">บาร์โค้ด</label>
                            <input type="" placeholder="กรอกรายละเอียด" class="input-primary h-[3rem] my-2 "
                                name="" id="">
                        </div>
                    </div>
                    {{-- image --}}
                    <div class=" w-full">
                        <div class="flex items-center justify-center w-full mt-2">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
