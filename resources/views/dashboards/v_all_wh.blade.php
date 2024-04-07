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
                <div class="text-center justify-center flex flex-wrap gap-16">
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
                    <div
                        class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center h-[10rem] w-[15.2rem]">
                        <div class="flex items-center mb-4">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <a class="text-gray-700 font-bold text-4xl ml-2">5</a>
                        </div>
                        <a class="text-gray-700 font-bold text-1xl mb-1">คลังสินค้าทั้งหมด</a>
                    </div>
                </div>
                <div class="w-full mt-2 rounded-t-md">
                    <div class="py-2 w-full bg-white rounded-t-md">
                        <b class="mx-3  mt-2 text-lg text-black uppercase   ">
                            รายการการสินค้าเข้า - ออก
                        </b>
                    </div>
                </div>
                <hr>
                <div class="bg-white text-lg  w-full h-[38rem]   ">
                    <div class="chart-container " style=" position: relative; height:38rem; width:full ;bg : white">
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
    </div>
@endsection
