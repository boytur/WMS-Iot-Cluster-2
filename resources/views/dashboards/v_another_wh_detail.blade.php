@extends('layouts.default')
@section('title', 'ดูภาพรวมคลังสินค้าอื่น')

@section('content')
    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('dashboard/view-another') }}">แดชบอร์ด > ดูคลังสินค้าอื่น > </a>
                    <a href="">{{ $warehouses->wh_name }}</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="  rounded-sm  overflow-y-scroll">
                    <div>
                        <div class="   w-full ">
                            <div class="  flex  h-full w-full ">
                                <div class="w-3/4">
                                    <div class=" w-full text-center justify-center gap-16  flex ">
                                        <div
                                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">
                                            <div class="flex items-center mb-4">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                <a class="text-gray-700 font-bold text-4xl ml-2">20,000</a>
                                            </div>
                                            <a class="text-gray-700 font-bold text-1xl mb-1">ยอดสินค้ารับเข้าวันนี้</a>
                                        </div>
                                        <div
                                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">
                                            <div class="flex items-center mb-4">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                <a class="text-gray-700 font-bold text-4xl ml-2">12,467</a>
                                            </div>
                                            <a class="text-gray-700 font-bold text-1xl mb-1">ยอดสินค้าส่งออกวันนี้</a>
                                        </div>
                                        <div
                                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">
                                            <div class="flex items-center mb-4">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                <a class="text-gray-700 font-bold text-4xl ml-2">10,300</a>
                                            </div>
                                            <a class="text-gray-700 font-bold text-1xl mb-1">สินค้าทั้งหมด</a>
                                        </div>
                                    </div>
                                    <div class=" mt-3 w-full text-left ">
                                        <div class="w-full mt-2 rounded-t-md">
                                            <div class="py-2 w-full bg-white rounded-t-md">
                                                <b class="mx-3  mt-2 text-lg text-black uppercase   ">
                                                    รายการการสินค้าเข้า - ออก
                                                </b>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="bg-white text-lg shadow-md  w-full h-[30rem]  ">

                                            <div class="chart-container"
                                                style="position: relative; height:full; width:full ;bg : white">
                                                {{--  <b class=" text-sm ">จำนวน (ชิ้น)</b>  --}}

                                                <canvas id="myChart"></canvas>

                                            </div>

                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                            <script>
                                                const ctx = document.getElementById('myChart');

                                                new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12 '],
                                                        datasets: [{
                                                                label: 'สินค้าขาเข้า',
                                                                data: [1, 2, 2, 1, 2, 2, 1, 1, 3, 1, 1, 2],
                                                                borderWidth: 3
                                                            },
                                                            {
                                                                label: 'สินค้าขาออก',
                                                                data: [1, 2, 1, 2, 0, 1, 1, 2, 1, 2, 2, 3],
                                                                borderWidth: 3
                                                            }
                                                        ]
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                type: 'linear',
                                                                display: true,
                                                                position: 'left',
                                                            },
                                                        }
                                                    }
                                                });
                                            </script>

                                        </div>

                                    </div>
                                </div>

                                <div class=" w-1/4  text-left shadow-md rounded-lg mx-4 bg-white">
                                    <div class="mt-3">
                                        <b class="mx-4 text-lg text-black   ">การแจ้งเตือนใหม่</b>
                                        <hr class="mt-3">
                                    </div>
                                    {{--  #1  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex ">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #2  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #3  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #4  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #5  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #6  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #7  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                    {{--  #8  --}}
                                    <div class=" m-3 p-2 shadow-md bg-slate-50 flex">
                                        <div class="mx-1">
                                            <i class="fa-solid fa-caret-right fa-xl  text-blue-600"></i>
                                        </div>

                                        <div class="mx-1">
                                            <b>รายละเอียด</b>
                                            <br>
                                            <i>วันที่</i>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="  w-full ">
                            <br>
                            <b class="  mx-2 text-2xl">พื้นที่คลังสินค้า</b>
                            <div class=" bg-white  shadow-md mt-5 py-2 h-[25rem] w-full  rounded-lg   rounded-t-md">
                                <b class="mx-3  mt-2 text-lg text-black uppercase   ">
                                    RACK A # รอเรียก Tag
                                </b>
                                <hr class="mt-1">

                            </div>
                            <div class=" bg-white  shadow-md mt-4 py-2 h-[25rem] w-full  rounded-lg   rounded-t-md">
                                <b class="mx-3  mt-2 text-lg text-black uppercase   ">
                                    RACK B # รอเรียก Tag
                                </b>
                                <hr class="mt-1">
                            </div>
                        </div>


                    </div>



                </div>

            </div>
        </div>
    </div>
@endsection
