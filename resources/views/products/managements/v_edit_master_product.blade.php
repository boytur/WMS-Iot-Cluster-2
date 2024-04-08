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

                            {{-- <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>แท็ก</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%] ">
                                    <div class="">
                                        <label for="name" class="block mb-1 text-left text-sm font-medium">
                                    </div>
                                    </label>
                                    <select name="positon" id="position" class="w-full mx-2"
                                        class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full">
                                        <option>
                                            @foreach ($product->tags as $tag)
                                                {{ $tag['tag_name'] }}
                                            @endforeach
                                            @if (count($product->tags) < 0)
                                                <td>-</td>
                                            @endif
                                        </option>

                                    </select>

                                </div>
                            </div> --}}

                            <div class="flex">
                                <div class="row mx-3 my-3 w-[40%]">
                                    <tr>แท็ก</tr>
                                </div>
                                <div class="flex my-2 border border-black-500 rounded-md mx-3 w-[51%]">
                                    <div class="mx-2">
                                        @foreach ($product->tags as $tag)
                                            {{ $tag['tag_name'] }}
                                        @endforeach
                                        @if (count($product->tags) < 0)
                                            <td>-</td>
                                        @endif
                                    </div>
                                    <div class="ml-auto" onclick="add_tags('{{ json_encode($product->tags) }}')">
                                        <i
                                            class="cursor-pointer fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
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
                            <button class="bg-red-700 text-center px-5 py-2 text-white rounded-md"
                                onclick="confirm_delete()">ลบสินค้า</button>
                        </div>

                    </div>






                    {{-- image --}}
                    {{-- <div class=" w-full mx-3">
                        <div class="flex items-center justify-center w-full mt-2 mx-1 ">
                            <img id="dropzone-image"
                                class=" h-[20.5rem]  w-[32rem] object-cover border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 16" src="{{ $product->mas_prod_image }}"
                                alt="Upload Image" />
                            <input id="dropzone-file" type="file" class="hidden" />
                        </div>
                    </div> --}}

                    {{-- image --}}
                    <div class="w-full mx-3 ">
                        <div class="flex items-center justify-center w-full mt-2 mx-1 ">
                            <label for="dropzone-file" class="relative cursor-pointer">
                                <img id="dropzone-image"
                                    class="h-[20.5rem] w-[32rem] object-cover border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 dark:hover:bg-bray-800"
                                    src="{{ $product->mas_prod_image }}" alt="Upload Image" />
                                <input id="dropzone-file" type="file"
                                    class="absolute inset-0 opacity-0 cursor-pointer" />
                            </label>
                        </div>
                    </div>



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
                confirmButtonText: "ตกลง",
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
                confirmButtonText: "ตกลง",
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

    {{-- <script>
        // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
        const add_tags = (tags) => {
            Swal.fire({
                title: "แก้ไขแท็ก",
                html: `
                <select class="input-primary">
                @if (count($product->tags) < 1)
                    <option>-</option>
                @else
                    @foreach ($product->tags as $tag)
                        <option>{{ $tag['tag_name'] }}</option>
                    @endforeach
                    <option >เพิ่มแท็ก</option>
                @endif
            </select>
`,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
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
    </script> --}}

    <script>
        // ฟังก์ชันสำหรับแสดง SweetAlert พร้อม input
        const add_tags = (tags) => {
            Swal.fire({
                title: "แก้ไขแท็ก",
                html: `
                <div class="flex items-center">
                    <select class="input-primary">
                        @if (count($product->tags) < 1)
                            <option>-</option>
                        @else
                            @foreach ($product->tags as $tag)
                                <option>{{ $tag['tag_name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="mx-3">
                    <button onclick="add_tag_more()" class="ml-2  px-1" style="font-size: 0.9rem; background-color: #4CAF50; color: white; border-radius: 50%;">
                    <i class="fas fa-plus"></i>
                    </button>
                    </div>

                </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
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
        const add_tag_more = () => {
            Swal.fire({
                title: "เพิ่มแท็ก",
                html: `
                <input id="swal-input1" class="swal2-input" placeholder="กรุณากรอกชื่อแท็ก">
            `,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
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
                confirmButtonText: "ตกลง",
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
        const confirm_delete = async (lot_out_id) => {
            const cluster = '{{ env('CLUSTER') }}'
            Swal.fire({
                title: "คุณต้องการลบใช่หรือไม่?",
                text: "คุณจะไม่สามารถเรียกข้อมูลได้อีก!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน"
            }).then(async (result) => {
                if (result.isConfirmed) {

                    const response = await fetch(
                        `${cluster}/product/outbounds/delete-outbound-product/${lot_out_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        });
                    if (response.status === 200) {
                        Swal.fire({
                            title: "ลบข้อมูลสำเร็จ!",
                            text: "ข้อมูลของคุณถูกลบแล้ว.",
                            icon: "success"
                        });
                        window.location.reload();
                    }
                }
            })
        };
    </script>

@endsection
