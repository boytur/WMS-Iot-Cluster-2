{{-- v_another_wh.blade.php
Displayfrom user_edit_detail
@author : Tanapat Supapon
@Create Date : 2024-04-07
@version 1.0.1 --}}
@extends('layouts.default')
@section('title', 'โปรไฟล์')

@section('content')

    <div style="height: calc(100vh - 5rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div style="height: calc(100vh - 5rem)" class="md:mt-0 h-full">
            <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
                <div class="mt-[5rem] md:mt-0">
                    <div class=" w-full h-[3rem] ">
                        <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                            <a href="">ผู้ใช้งาน > รายละเอียด</a>
                        </div>
                    </div>
                    <div class="w-full p-2 rounded-md h-full">
                        <div class=" h-full  w-full rounded-sm  bg-white overflow-y-scroll">

                            <div class="  mx-6 mt-3 text-[1.1rem]">
                                <b>รายละเอียดพนักงาน</b>
                                <hr class="mt-2">
                            </div>
                            <div class="flex mx-6">
                                <div class="w-[20rem] h-[19rem]">
                                    <div class="w-full">
                                        <img class="mt-5 rounded-full w-[19rem] h-[19rem] object-cover"
                                            src="{{ $user->image }}" alt="">
                                    </div>
                                </div>
                                <div class=" w-3/4 mx-10 mt-3 ">
                                    <div>
                                        <b class="text-[1.1rem]">ข้อมูลส่วนตัว</b>

                                        <hr class="mt-2">
                                    </div>
                                    <div>
                                        <div class=" text-[0.7rem] mt-2 text-gray-500 ">
                                            <b>รหัสพนักงาน</b>
                                        </div>

                                        <div>
                                            <p class="text-[1.1rem] text-black">{{ $user->number }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex gap-16 text-[0.7rem] mt-2 text-gray-500">
                                            <div>
                                                <b>ชื่อ</b>
                                                <p class=" text-[1.1rem] text-black">{{ $user->fname }}</p>
                                            </div>
                                            <div>
                                                <b>นามสกุล</b>
                                                <p class=" text-[1.1rem] text-black">{{ $user->lname }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class=" text-[0.7rem] mt-2 text-gray-500 ">
                                            <b>ตำแหน่ง</b>
                                        </div>
                                        <div>
                                            @if ($user->role == 'warehouse_manager')
                                                <p class="text-[1.1rem] text-black">ผู้จัดการ</p>
                                            @else
                                                <p class="text-[1.1rem] text-black">พนักงานทั่วไป</p>
                                            @endif

                                        </div>
                                    </div>
                                    <div>
                                        <div class=" text-[0.7rem] mt-2 text-gray-500 ">
                                            <b>คลังสินค้าที่ประจำการ</b>
                                        </div>
                                        <div>
                                            @if ($user->role === 'warehouse_manager')
                                                <p class="text-[1.1rem] text-black">ทุกคลังสินค้า</p>
                                            @else
                                                @if ($user->warehouses->isNotEmpty())
                                                    <p>{{ $user->warehouses[0]->wh_name }}</p>
                                                @else
                                                    <p>ไม่มีคลังสินค้า</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <b class="text-[1.1rem] ">ข้อมูลการติดต่อ</b>
                                        <hr class="mt-2">
                                    </div>
                                    <div>
                                        <div class=" text-[0.7rem] mt-2 text-gray-500 ">
                                            <b>อีเมล</b>
                                        </div>
                                        <div>
                                            <p class="text-[1.1rem] text-black">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class=" text-[0.7rem] mt-2 text-gray-500 ">
                                            <b>เบอร์โทรศัพท์</b>
                                        </div>
                                        <div>

                                            {{--  <a class="text-[1.5rem] text-black" href="tel:123-456-7890">{{ $user->phone }}</a>  --}}
                                            <p class="text-[1.1rem] text-black">
                                                {{ substr($user->phone, 0, 3) . '-' . substr($user->phone, 3, 3) . '-' . substr($user->phone, 6, 4) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <b class="text-[1.1rem]">เพิ่มเติม</b>
                                        <hr class="">
                                    </div>
                                    <div class="">
                                        <button onclick="onclick_delete_confirm({{ $user->id }})"
                                            class=" btn-danger w-40 h-[3rem] gap-2 mt-4">
                                            <i class="fa-solid fa-trash-can text-[1.5rem]"></i>
                                            ลบพนักงาน
                                        </button>
                                        <button onclick="onclick_edit_pass()" class=" btn-white w-40 h-[3rem] gap-2 mt-4">
                                            <i class="fa-regular fa-pen-to-square text-[1.5rem]"></i>
                                            แก้ไข
                                        </button>

                                        <script>
                                            const onclick_wh_details = (wh_id) => {
                                                const cluster = '{{ env('CLUSTER') }}'
                                                window.location.href = `${cluster}/dashboard/view-another/detail/${wh_id}`;
                                            }

                                            function toggleWarehouseSection() {
                                                var role = document.getElementById("role");
                                                var warehouseDiv = document.getElementById("wh");

                                                if (role.value === "warehouse_manager") {
                                                    warehouseDiv.style.display = "none";

                                                } else {
                                                    warehouseDiv.style.display = "block";
                                                }
                                            }

                                            //Function - Onclick_edit_password
                                            const onclick_edit_pass = async () => {

                                                Swal.fire({
                                                    title: "แก้ไขข้อมูล",
                                                    customClass: 'swal-wide',
                                                    html: `

                                                    <hr class="mb-3">
                                                    <div class="flex justify-between w-full space-x-4">
                                                    {{-- insert image --}}
                                                            <div class="w-1/3">
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
                                                                            class="font-semibold">คลิกเพื่ออัปโหลด</span></p>
                                                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG หรือ GIF (MAX.
                                                                            800x400px)</p>
                                                                    </div>
                                                                        <input id="dropzone-file" type="file" class="hidden" />
                                                                        </label>
                                                                </div>
                                                            </div>


                                                        {{-- ช่องกรอกข้อมูล --}}
                                                            <div class="w-2/3 border rounded-lg p-3 ">
                                                                {{-- ข้อมูลส่วนตัว --}}
                                                                <div class="text-left mb-3">
                                                                    <b>ข้อมูลส่วนตัว</b>
                                                                </div>

                                                                <hr class="mb-3">
                                                                {{-- ชื่อ --}}
                                                                <div class="mb-4 px-1 w-full">
                                                                    <label for="name" class="block mb-1 text-left text-sm font-medium">กรุณากรอกชื่อ<span class="text-sm text-red-500"> * </span></label>
                                                                    <input type="text" id="fname" name="name" value={{ $user->fname }} class=" input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                </div>
                                                                <div class="mb-4 px-1 w-full">
                                                                    <label for="name" class="block mb-1 text-left text-sm font-medium">กรุณากรอกนามสกุล<span class="text-sm text-red-500"> * </span></label>
                                                                    <input type="text" id="lname" name="name" value={{ $user->lname }} class=" input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                </div>

                                                                {{-- ว/ด/ป
                                                                <div class="mb-4 px-1 w-full">
                                                                    <label for="name" class="block mb-1 text-left text-sm font-medium">วัน/เดือน/ปี เกิด<span class="text-sm text-red-500"> * </span></label>
                                                                    <input type="date" id="date" placeholder="17/03/2547" class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                </div> --}}
                                                                {{-- ตำแหน่ง --}}
                                                                <div class="mb-4 px-1 w-full">
                                                                <label for="name" class="block mb-1 text-left text-sm font-medium">ตำแหน่ง<span class="text-sm text-red-500"> * </span></label>
                                                                <select name="positon" id="role" onchange="toggleWarehouseSection()" class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                    <option disabled selected>
                                                                        @if ($user->role === 'normal_employee')
                                                                        พนักงานคลังสินค้า
                                                                        @else
                                                                        ผู้จัดการคลังสินค้า
                                                                        @endif
                                                                    </option>
                                                                        @if ($user->role !== 'warehouse_manager')
                                                                        <option value="normal_employee">พนักงานคลังสินค้า</option>
                                                                        <option value="warehouse_manager">ผู้จัดการคลังสินค้า</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                {{-- warehouse --}}
                                                                <div id="wh" class="mb-4 px-1 w-full">
                                                                <label for="name" class="block mb-1 text-left text-sm font-medium">คลังสินค้าที่ประจำการ<span class="text-sm text-red-500"> * </span></label>
                                                                @if ($user->role !== 'warehouse_manager')
                                                                <select name="wh_management" id="wh_management" class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required">
                                                                    <option disabled selected>{{ $user->warehouses->isNotEmpty() ? $user->warehouses[0]['wh_name'] : 'ไม่มีคลังสินค้า' }}</option>
                                                                    @foreach ($whs as $wh)
                                                                        <option id="wh_input" value="{{ $wh->wh_id }}"{{ $wh->wh_id }} >{{ $wh->wh_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @else
                                                                  <p class="text-left text-[1.5rem]">ทุกคลังสินค้า</p>
                                                                @endif
                                                                </div>

                                                                {{-- ข้อมูลการติดต่อ --}}
                                                                <div  class="mb-3 px-1 w-full text-left">
                                                                    <b>ข้อมูลการติดต่อ</b>
                                                                </div>
                                                                {{-- อีเมล --}}
                                                                <hr class="mb-3">
                                                                <div class="mb-4 px-1 w-full">
                                                                    <label for="name" class="block mb-1 text-left text-sm font-medium">อีเมล<span class="text-sm text-red-500"> * </span></label>
                                                                    <input type="email" id="email" name="name" value={{ $user->email }} class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                </div>
                                                                {{-- เบอร์ --}}
                                                                <div class="mb-4 px-1 w-full">
                                                                    <label for="name" class="block mb-1 text-left text-sm font-medium">เบอร์โทรศัพท์<span class="text-sm text-red-500"> * </span></label>
                                                                    <input type="tel" id="phone" name="name" value= {{ substr($user->phone, 0, 3) . '-' . substr($user->phone, 3, 3) . '-' . substr($user->phone, 6, 4) }} class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                                </div>
                                                            </div>

                                                    </>`,


                                                    showCancelButton: true,
                                                    confirmButtonColor: '#2f67ff',
                                                    cancelButtonText: "ยกเลิก",
                                                    confirmButtonText: "ยืนยัน",
                                                    showLoaderOnConfirm: true,
                                                    reverseButtons: true,

                                                    preConfirm: () => { // เพิ่มส่วนนี้เพื่อเรียกใช้ onclick_edit_confirm เมื่อกดปุ่ม "ยืนยัน"
                                                        onclick_edit_confirm({{ $user->id }});
                                                    }

                                                })
                                            }
                                            const onclick_edit_confirm = async (id) => {
                                                const fname = document.getElementById('fname').value;
                                                const lname = document.getElementById('lname').value;
                                                const email = document.getElementById('email').value;
                                                const phone = document.getElementById('phone').value;
                                                const wh_id = document.getElementById('wh_management')?.value;
                                                const role = document.getElementById('role')?.value;
                                                const cluster = '{{ env('CLUSTER') }}';

                                                try {
                                                    const response = await fetch(`${cluster}/user-management/edit-user-info/${id}`, {
                                                        method: 'PUT',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({
                                                            fname,
                                                            lname,
                                                            email,
                                                            phone,
                                                            wh_id,
                                                            role
                                                        })
                                                    });
                                                    const responseData = await response.json();
                                                    if (response.status === 200) {
                                                        await Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: responseData.data,
                                                        });
                                                        window.location.reload();
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: responseData.data,
                                                        });
                                                    }
                                                } catch (error) {
                                                    console.error('Error:', error);
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'An error occurred while processing your request. Please try again later.'
                                                    });
                                                }
                                            };

                                            const onclick_delete_confirm = async (user_id) => {
                                                const cluster = '{{ env('CLUSTER') }}';
                                                try {
                                                    const response = await fetch(`${cluster}/user-management/delete-user/${user_id}`, {
                                                        method: 'DELETE',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        }
                                                    });
                                                    const responseData = await response.json();
                                                    if (response.status === 200) {
                                                        await Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: responseData.data,
                                                        });
                                                        window.location.reload(); // รีโหลดหน้าเว็บหลังจากการลบสำเร็จ
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error',
                                                            text: responseData.data,
                                                        });
                                                    }
                                                } catch (error) {
                                                    console.error('Error:', error);
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'An error occurred while processing your request. Please try again later.'
                                                    });
                                                }
                                            };
                                        </script>
                                        <style>
                                            .swal-wide {
                                                width: 900px !important;
                                                height: 895px;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
