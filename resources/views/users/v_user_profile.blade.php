{{--

*v_user_profile.php

*Display profile

*@auther : Amonpan Noicharoen 65160241

*@Create Date : 2024-04-03


--}}
@extends('layouts.default')
@section('title', 'โปรไฟล์')

@section('content')

    <div style="height: calc(100vh - 5rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div style="height: calc(100vh - 5rem)" class="md:mt-0 h-full">

            <div class="w-full p-2 rounded-md h-full">
                <div class=" h-full  w-full rounded-sm  bg-white overflow-y-scroll">

                    <div class="  mx-6 mt-3 text-[1.1rem]">
                        <b>โปรไฟล์ของฉัน</b>
                        <hr class="mt-2">
                    </div>
                    <div class="flex mx-6">
                        <div class="w-[20rem] h-[19rem]">
                            <div class="w-full">
                                <img class="mt-5 rounded-full w-[19rem] h-[19rem] object-cover" src="{{ $user->image }}"
                                    alt="">

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
                                        <b>นามสกุล</b </div>
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
                                        <p> {{ $user->warehouses[0]->wh_name }}</p>
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
                                <button onclick="onclick_edit_pass()" class=" btn-danger w-40 h-[3rem] gap-2 mt-4">

                                    <i class="fa-solid fa-key"></i>

                                    แก้ไขรหัสผ่าน

                                </button>

                                <script>

                                    const onclick_wh_details = (wh_id) => {
                                        const cluster = '{{ env('CLUSTER') }}'
                                        window.location.href = `${cluster}/dashboard/view-another/detail/${wh_id}`;
                                    }

                                    //Function - Onclick_edit_password
                                    const onclick_edit_pass = () => {

                                        Swal.fire({
                                            title: "แก้ไขรหัสผ่าน",
                                            html: `<hr width=100% size=3>

                                            <div class="w-full mt-10">
                                                <label for="old_password" class="block text-left text-[0.7rem] font-medium text-black"> รหัสผ่านเดิม <span class="text-red-500">*</span> </label>
                                                <input id="old_password" type="password" class="swal2-input w-full cursor-pointer border input-primary" placeholder="**********">
                                            </div>
                                            <div class="w-full mt-2">
                                                <label for="new_password" class="block mb-2 text-left text-[0.7rem] font-medium text-black"> รหัสผ่านใหม่ <span class="text-red-500">*</span> </label>
                                                <input id="new_password" type="text" class="swal2-input w-full cursor-pointer border input-primary" placeholder="**********">
                                            </div>
                                            <div class="w-full mt-2">
                                                <label for="confirm_password" class="block mb-2 text-left text-[0.7rem] font-medium text-black"> ยืนยันรหัสผ่าน <span class="text-red-500">*</span> </label>
                                                <input id="confirm_password" type="password" class="swal2-input w-full cursor-pointer border input-primary" placeholder="**********">

                                            `,
                                            showCancelButton: true,
                                            confirmButtonColor: '#2f67ff',
                                            confirmButtonText: "ยืนยัน",
                                            cancelButtonText: "ยกเลิก",
                                            showLoaderOnConfirm: true,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                const oldPassword = document.getElementById('old_password').value;
                                                const newPassword = document.getElementById('new_password').value;
                                                const confirmPassword = document.getElementById('confirm_password').value;

                                                // เงื่อนไขการตรวจสอบรหัสผ่านใหม่และยืนยันรหัสผ่านใหม่
                                                if (newPassword !== confirmPassword) {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'รหัสผ่านไม่ตรงกัน',
                                                        text: 'โปรดตรวจสอบรหัสผ่านใหม่อีกครั้ง',
                                                    });
                                                    return; // หยุดการดำเนินการถัดไปหากรหัสผ่านไม่ตรงกัน
                                                }

                                                if (newPassword == confirmPassword) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                                                        text: 'รหัสผ่านได้รับการยืนยัน',
                                                    });
                                                    return;
                                                }

                                                // ตรวจสอบการใช้งานรหัสผ่านเดิมและรหัสผ่านใหม่ที่ถูกต้อง และปรับปรุงข้อมูลตามต้องการ
                                                if (oldPasswordCorrect && newPasswordValid) {
                                                    localStorage.setItem('products_cart', JSON.stringify(products_in_cart_localstorage));
                                                    product['exp'] = document.querySelector(`#date`).value;
                                                    refresh_cart_table();
                                                }
                                            }
                                        });
                                    }

                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
