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
                                    <button class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                                        <a href="{{ url('/user-management') }}">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">เพิ่มผู้ใช้งาน</p>
                                                </div>
                                            </div>
                                        </a>
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
                                            onclick="onclick_user_details('/user/managements/detail/{{ $user->id }}')">
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
        const onclick_user_details = (user_number) => {
        const cluster = '{{ env('CLUSTER') }}'
        window.location.href = `${cluster}/user-management/detail/${user_number}`;
    }
    const handle_search = async () => {
            try {
                //ดึงค่า
                const user_search = document.getElementById("user_search").value;
                const user_attribute = document.getElementById("user_attribute").value;
                const user_type = document.getElementById("user_type").value;
                const cluster = '{{ env('CLUSTER') }}'
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
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer" onclick="onclick_user_details('/user/managements/detail/${user.id}')">
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
    </script>
@endsection
