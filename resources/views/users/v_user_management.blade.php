@extends('layouts.default')
@section('title', 'จัดการผู้ใช้งาน')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">ผู้ใช้งาน > จัดการผู้ใช้งาน</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="  rounded-sm overflow-y-scroll">

                    <div class="w-full p-5 bg-white rounded-md pb-8">
                        {{-- box-1 --}}
                        <div class="w-full flex">

                            {{-- search input --}}
                            <div class="w-3/4 flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาผู้ใช้</p>
                                        <input onfocus="handle_search()" type="text"
                                            placeholder="กรอกรายละเอียดที่ต้องการค้นหา..." class="input-primary h-[3rem]"
                                            name="user_search" id="user_search">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                        <select name="user_attribute" id="user_attribute"
                                            class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                            <option value="number">รหัสพนักงาน</option>
                                            <option value="name">ชื่อ-นามสกุล</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="md:w-[18rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ประเภท</p>
                                        <select name="user_type" id="user_type"
                                            class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                            <option value="all">ทั้งหมด</option>
                                            <option value="warehouse_manager">ผู้จัดการคลังสินค้า</option>
                                            <option value="normal_employee">พนักงานคลังสินค้า</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full mt-5">
                                    <div class="w-full">
                                        <button onclick="handle_search()"
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                                            <div>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div type="submit">
                                                ค้นหา
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- add product inbound --}}
                            <div class="w-full flex justify-end gap-3 mt-2">
                                <div class="mt-3 lg:pt-0">
                                    <button onclick="onclick_add_user()"
                                        class="btn-primary px-4 flex items-center h-[3rem] gap-1">

                                        <div class="flex items-center gap-1">
                                            <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                            <div>
                                                <p class="lg:text-sm lg:block hidden">เพิ่มผู้ใช้งาน</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- end box-1 --}}
                    </div>

                    {{-- table product --}}
                    <div class="w-full mt-2 rounded-t-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                            <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                ตารางแสดงรายชื่อพนักงาน</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            รหัสพนักงาน
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ชื่อ-นามสกุล
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ประเภท
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            คลังสินค้า
                                        </th>
                                    </tr>
                                </thead>

                                <tbody id="user_table">
                                    @foreach ($users as $index => $user)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                                            onclick="onclick_user_details('{{ $user->number }}')">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->number }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->fname }} {{ $user->lname }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($user->role === 'warehouse_manager')
                                                    ผู้จัดการคลังสินค้า
                                                @else
                                                    พนักงานคลังสินค้า
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($user->role === 'warehouse_manager')
                                                    ทุกคลังสินค้า
                                                @else
                                                    @if ($user->warehouses == null)
                                                        ไม่พบคลังสินค้า
                                                    @else
                                                        @foreach ($user->warehouses as $w)
                                                            {{ $w->wh_name }}
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center my-4">
                    {{ $users->links('pagination::custom-pagination') }}
                </div>
            </div>
        </div>
    </div>


    <script>
        const handle_search = async () => {
            try {
                //ดึงค่า
                const user_search = document.getElementById("user_search").value;
                const user_attribute = document.getElementById("user_attribute").value;
                const user_type = document.getElementById("user_type").value;
                const cluster = '{{ env('
                                                                            CLUSTER ') }}'
                //ส่ง req

                const response = await fetch(`${cluster}/user-management/search`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_search,
                        user_attribute,
                        user_type
                    })

                });

                if (response.ok) {
                    const responseData = await response.json();
                    const users = responseData.data;
                    const userTableBody = document.getElementById("user_table");
                    userTableBody.innerHTML = ""; // Clear previous results

                    if (users.length === 0) {
                        // Display message when no results are found
                        userTableBody.innerHTML =
                            `<tr><td colspan="5">ไม่พบผู้ใช้งาน</td></tr>`;
                    } else {
                        users.forEach((user, index) => {
                            const row = `
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer" onclick="onclick_user_details('${user.number}')">
                                    <td class="px-6 py-4 font-medium whitespace-nowrap">${index + 1}</td>
                                    <td class="px-6 py-4">${user.number}</td>
                                    <td class="px-6 py-4">${user.fname} ${user.lname}</td>
                                    <td class="px-6 py-4">${user.role === 'warehouse_manager' ? 'ผู้จัดการคลังสินค้า' : 'พนักงานคลังสินค้า'}</td>
                                    <td class="px-6 py-4">${user.role === 'warehouse_manager' ? 'ทุกคลังสินค้า' : (user.warehouses ? user.warehouses.map(w => w.wh_name).join(', ') : 'ไม่พบคลังสินค้า')}</td>
                                </tr>
                            `;
                            userTableBody.innerHTML += row;
                        });
                    }
                } else {
                    throw new Error('Failed to fetch data');
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: `เกิดข้อผิดพลาด`,
                });
            }
        }
        //หน้าต่างแสดงป๊อปอัพเพิ่มผู้ใช้งาน
        const onclick_add_user = () => {

            Swal.fire({
                title: "เพิ่มผู้ใช้งานใหม่",
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
                                <input id="dropzone_file" type="file" class="hidden" />
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
                            <input type="text" id="fname" name="name" placeholder="กรอกชื่อตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-4 px-1 w-full">
                            <label for="name" class="block mb-1 text-left text-sm font-medium">กรุณากรอกนามสกุล<span class="text-sm text-red-500"> * </span></label>
                            <input type="text" id="lname" name="name" placeholder="กรอกนามสกุลตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                        </div>

                        {{-- ว/ด/ป --}}
                        <div class="mb-4 px-1 w-full">
                            <label for="name" class="block mb-1 text-left text-sm font-medium">วัน/เดือน/ปี เกิด<span class="text-sm text-red-500"> * </span></label>
                            <input type="date" id="date" placeholder="dd/mm/yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                        </div>
                        {{-- ตำแหน่ง --}}
                        <div class="mb-4 px-1 w-full">
                           <label for="name" class="block mb-1 text-left text-sm font-medium">ตำแหน่ง<span class="text-sm text-red-500"> * </span></label>
                           <select name="positon" id="role" class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required">
                                <option value="employee">พนักงานทั่วไป</option>
                                <option value="wh_management">ผู้จัดการคลังสินค้า</option>
                            </select>
                        </div>
                        {{-- warehouse --}}
                        <div class="mb-4 px-1 w-full">
                           <label for="name" class="block mb-1 text-left text-sm font-medium">คลังสินค้าที่ประจำการ<span class="text-sm text-red-500"> * </span></label>
                           <select id="wh_id" name="wh" class="input-primary bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required">
                                @foreach ($whs as $wh)
                                    <option value="{{ $wh->wh_id }}">{{ $wh->wh_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ข้อมูลการติดต่อ --}}
                        <div  class="mb-3 px-1 w-full text-left">
                            <b>ข้อมูลการติดต่อ</b>
                        </div>
                        {{-- อีเมล --}}
                        <hr class="mb-3">
                        <div class="mb-4 px-1 w-full">
                            <label for="name" class="block mb-1 text-left text-sm font-medium">อีเมล<span class="text-sm text-red-500"> * </span></label>
                            <input type="email" id="email" name="name" placeholder="example@gmail.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                        </div>
                        {{-- เบอร์ --}}
                        <div class="mb-4 px-1 w-full">
                            <label for="name" class="block mb-1 text-left text-sm font-medium">เบอร์โทรศัพท์<span class="text-sm text-red-500"> * </span></label>
                            <input type="tel" id="phone" name="name" placeholder="xxx-xxx-xxxx" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>

            </>`,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน",
                showLoaderOnConfirm: true,
                reverseButtons: true,
            }).then((result) => {

                if (result.isConfirmed) {
                    fetch_create_user();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'ยกเลิกการสมัครสมาชิก',
                        '',
                        'error'
                    )
                }
            })
        }
        const onclick_user_details = (number) => {

            const cluster = '{{ env('CLUSTER') }}'
            window.location.href = `${cluster}/user-edit-detail/${number}`;
        }

        const fetch_create_user = async () => {
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const date = document.getElementById('date').value.trim();
            const role = document.getElementById('role').value.trim();
            const wh_id = document.getElementById('wh_id').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            if (fname === '' || lname === '' || date === '' || role === '' || wh_id === '' || email === '' ||
                phone === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    text: 'โปรดตรวจสอบและกรอกข้อมูลที่จำเป็นทั้งหมด',
                    confirmButtonText: 'ตกลง'
                });
            } else {
                console.log(fname, lname, date, role, wh_id, email, phone);
                // ดำเนินการต่อไปหากข้อมูลครบถ้วน
                // ...
            }
            const cluster = "{{ env('CLUSTER') }}";
            const response = await fetch(`${cluster}/user-management/create_user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    fname,
                    lname,
                    date,
                    role,
                    wh_id,
                    email,
                    phone
                })
            })
            //console.log(response);
            const response_data = await response.json();
            if (response_data.success) {
                Swal.fire({
                    'icon': 'success',
                    'title': 'success',
                    'text': response_data.data,
                });
            } else {
                Swal.fire({
                    'icon': 'error',
                    'title': 'error',
                    'text': response_data.data
                });
            }
        }
    </script>
    <style>
        .swal-wide {
            width: 900px !important;
            height: 895px;
        }
    </style>
@endsection
