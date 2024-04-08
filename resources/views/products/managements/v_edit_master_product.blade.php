{{-- v_edit_master_product.blade.php
    Display from show detail prod & edit master prod
    @author : Supatsara Youraksa
    @Create Date : 2024-04-07
      --}}

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
                <h1 class="my-4 ">รายละเอียดสินค้า</h1>
                <h1 class="border-b my-5"></h1>


                <div class="w-full bg-white h-[37rem] mt-2 rounded-md flex sm:flex ">

                    {{-- detail prod --}}
                    <div class="w-full  rounded-md  ">
                        <div class=" bg-white mt-2 rounded-md border border-black-300">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right ">
                                    <thead class="text-xs text-white  bg-[#212529]">
                                        <tr>
                                            <th scope="col" class="px-3 py-3">
                                                แก้ไขสินค้า
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="flex">
                                <div class=" row mx-3 my-3 w-[40%] ">
                                    <tr>หมายเลขสินค้า</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%] ">
                                    <div class="flex items-center justify-between">
                                        <span class="mx-2">{{ $product->mas_prod_no }} </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>ชื่อสินค้า</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="mx-2">
                                        {{ $product->mas_prod_name }}
                                    </div>
                                    <div class="ml-auto"><i
                                            class="cursor-pointer fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"
                                            onclick="add_new_name_mas_prod()"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>ประเภท</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="flex items-center justify-between">
                                        <span class="mx-2">{{ $product->categories->cat_name }}</span>
                                    </div>

                                </div>
                            </div>

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>จำนวนที่สามารถวางได้เต็มช่อง(ชิ้น)</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="mx-2">{{ $product->mas_prod_size }}</div>
                                    <div class="ml-auto">
                                        <i class="cursor-pointer fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"
                                            onclick="add_new_size_mas_prod()"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>แท็ก</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="mx-2">
                                        @foreach ($product->tags as $tag)
                                            {{ $tag['tag_name'] }}
                                        @endforeach
                                        @if ($product->tags->isEmpty())
                                            <td>-</td>
                                        @endif

                                    </div>
                                    <div class="ml-auto">
                                        <i class="cursor-pointer fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"
                                            onclick="add_tags()"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>บาร์โคด</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="mx-2">
                                        {{ $product->mas_prod_barcode }}
                                    </div>
                                    <div class="ml-auto">
                                        <i class="cursor-pointer fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"
                                            onclick="add_new_barcode()"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ml-auto text-right pt-2">
                            <button class="bg-red-700 text-center px-5 py-2 text-white rounded-md">ลบสินค้า</button>
                        </div>

                    </div>






                    {{-- image --}}
                    <div class=" w-full mx-3">
                        <div class="flex items-center justify-center w-full mt-2 mx-1 ">
                            <img id="dropzone-image"
                                class=" h-[20.5rem]  w-[32rem] object-cover border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 16" src="{{ $product->mas_prod_image }}"
                                alt="Upload Image" />
                            <input id="dropzone-file" type="file" class="hidden" />
                        </div>
                    </div>



                </div>
            </div>



            <script>
                // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
                const add_new_name_mas_prod = () => {
                    Swal.fire({
                        title: "แก้ไขรายละเอียดสินค้า",
                        html: '<input id="swal-input1" class="swal2-input" placeholder="กรุณากรอกข้อมูล">',
                        showCancelButton: true,
                        confirmButtonColor: '#2f67ff',
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // นำค่าจาก input ไปใช้งานต่อได้ตามต้องการ
                            const inputValue = document.getElementById('swal-input1').value;
                            // ตรวจสอบว่าค่าที่ป้อนไม่ใช่ค่าว่างหรือไม่
                            if (!inputValue) {
                                Swal.showValidationMessage('กรุณากรอกข้อมูล');
                            }
                            return inputValue;
                        }
                    }).then((result) => {
                        // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                        if (result.isConfirmed) {
                            const editedValue = result.value;
                            // สามารถนำค่าที่แก้ไขได้แล้วไปใช้งานต่อได้ที่นี่
                            console.log('ค่าที่แก้ไข:', editedValue);
                        }
                    });
                }
            </script>

            <script>
                // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
                const add_new_size_mas_prod = () => {
                    Swal.fire({
                        title: "แก้ไขจำนวนที่สามารถวางได้เต็มช่อง(ชิ้น)",
                        html: '<input id="swal-input1" class="swal2-input" placeholder="กรุณากรอกข้อมูล">',
                        showCancelButton: true,
                        confirmButtonColor: '#2f67ff',
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // นำค่าจาก input ไปใช้งานต่อได้ตามต้องการ
                            const inputValue = document.getElementById('swal-input1').value;
                            // ตรวจสอบว่าค่าที่ป้อนไม่ใช่ค่าว่างหรือไม่
                            if (!inputValue) {
                                Swal.showValidationMessage('กรุณากรอกข้อมูล');
                            }
                            return inputValue;
                        }
                    }).then((result) => {
                        // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                        if (result.isConfirmed) {
                            const editedValue = result.value;
                            // สามารถนำค่าที่แก้ไขได้แล้วไปใช้งานต่อได้ที่นี่
                            console.log('ค่าที่แก้ไข:', editedValue);
                        }
                    });
                }
            </script>

            <script>
                // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
                const add_tags = () => {
                    Swal.fire({
                        title: "แก้ไขแท็ก",
                        html: '<input id="swal-input1" class="swal2-input" placeholder="กรุณากรอกข้อมูล">',
                        showCancelButton: true,
                        confirmButtonColor: '#2f67ff',
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // นำค่าจาก input ไปใช้งานต่อได้ตามต้องการ
                            const inputValue = document.getElementById('swal-input1').value;
                            // ตรวจสอบว่าค่าที่ป้อนไม่ใช่ค่าว่างหรือไม่
                            if (!inputValue) {
                                Swal.showValidationMessage('กรุณากรอกข้อมูล');
                            }
                            return inputValue;
                        }
                    }).then((result) => {
                        // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                        if (result.isConfirmed) {
                            const editedValue = result.value;
                            // สามารถนำค่าที่แก้ไขได้แล้วไปใช้งานต่อได้ที่นี่
                            console.log('ค่าที่แก้ไข:', editedValue);
                        }
                    });
                }
            </script>

            <script>
                // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
                const add_new_barcode = () => {
                    Swal.fire({
                        title: "แก้ไขบาร์โคด",
                        html: '<input id="swal-input1" class="swal2-input" placeholder="กรุณาใส่ข้อมูล">',
                        showCancelButton: true,
                        confirmButtonColor: '#2f67ff',
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // นำค่าจาก input ไปใช้งานต่อได้ตามต้องการ
                            const inputValue = document.getElementById('swal-input1').value;
                            // ตรวจสอบว่าค่าที่ป้อนไม่ใช่ค่าว่างหรือไม่
                            if (!inputValue) {
                                Swal.showValidationMessage('กรุณากรอกข้อมูล');
                            }
                            return inputValue;
                        }
                    }).then((result) => {
                        // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                        if (result.isConfirmed) {
                            const editedValue = result.value;
                            // สามารถนำค่าที่แก้ไขได้แล้วไปใช้งานต่อได้ที่นี่
                            console.log('ค่าที่แก้ไข:', editedValue);
                        }
                    });
                }
            </script>
        @endsection







        {{-- add image --}}
        {{-- <div class=" w-full">
                        <div class="flex items-center justify-center w-full mt-2 mx-4">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w- h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
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
                    </div> --}}


        {{-- edit mas prod --}}
        {{-- <div class="  w-full">
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
                    </div> --}}
