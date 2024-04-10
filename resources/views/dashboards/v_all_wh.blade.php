{{-- v_all_wh.blade.php
Displayfrom view all wh
@author : Tanapat Supapon
@Create Date : 2024-04-03 --}}
@extends('layouts.default')
@section('title', 'ดูภาพรวมทั้งหมด')

@section('content')
    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full overflow-y-scroll">
        <div class="mt-[5rem] md:mt-0">
            <div class="w-full h-[3rem]">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">แดชบอร์ด > ภาพรวมทั้งหมด</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="  rounded-sm  overflow-y-scroll">
                    <div class="text-center justify-center flex flex-wrap gap-16">
                        <div
                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">

                            <div class="flex items-center mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>

                                <a class="text-gray-700 font-bold text-4xl ml-2">
                                    {{ $onshelf_products }}
                                </a>
                            </div>
                            <a class="text-gray-700 font-bold text-1xl mb-1">ยอดสินค้ารับเข้าวันนี้</a>
                        </div>
                        <div
                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">

                            <div class="flex items-center mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <a class="text-gray-700 font-bold text-4xl ml-2">{{ $outbound_products }}</a>
                            </div>
                            <a class="text-gray-700 font-bold text-1xl mb-1">ยอดสินค้าส่งออกวันนี้</a>
                        </div>
                        <div
                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">

                            <div class="flex items-center mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <a class="text-gray-700 font-bold text-4xl ml-2">{{ $mas_product }}</a>
                            </div>
                            <a class="text-gray-700 font-bold text-1xl mb-1">สินค้าหลัก</a>
                        </div>
                        <div
                            class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">
                            <div class="flex items-center mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <a class="text-gray-700 font-bold text-4xl ml-2">{{ $count_warehouses }}</a>
                            </div>
                            <a class="text-gray-700 font-bold text-1xl mb-1">คลังสินค้าทั้งหมด</a>
                        </div>
                    </div>
                    <div class="w-full mt-6 rounded-t-md">
                        <div class="py-2 w-full bg-white rounded-t-md">
                            <b class="mx-3  mt-2 text-lg text-black uppercase   ">
                                รายการการสินค้าเข้า - ออก
                            </b>
                        </div>
                    </div>
                    <hr>
                    <div class="bg-white text-lg  w-full h-[35rem]  ">

                        <div class="chart-container"
                            style="position: relative; display: flex;
                    justify-content: center;  ; height:34rem; width:full">
                            {{--  <b class=" text-sm ">จำนวน (ชิ้น)</b>  --}}

                            <canvas id="myChart"></canvas>

                        </div>


                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


                        <script>
                            const total = 0;

                            const ctx = document.getElementById('myChart');

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['January', 'February', 'March', 'April',
                                        'May', 'June', 'July', 'August',
                                        'September', 'October', 'November', 'December'
                                    ],
                                    datasets: [{


                                            label: 'สินค้าขาเข้า',
                                            data: [

                                                <?php
                                                foreach ($onshelf_products_by_month as $month => $sum) {
                                                    echo "$sum, ";
                                                }
                                                ?>
                                            ],
                                            borderWidth: 3
                                        },
                                        {
                                            label: 'สินค้าขาออก',
                                            data: [
                                                <?php
                                                foreach ($outbound_products_by_month as $month => $sum) {
                                                    echo "$sum, ";
                                                }
                                                ?>
                                            ],
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
        </div>
    </div>
@endsection
