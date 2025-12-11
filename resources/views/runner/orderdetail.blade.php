@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')
<div>
    <div>
        {{-- div atas kanan --}}
        <div>
            <div>
                {{-- nama --}}
                <h1 class="text-xl font-extrabold">Hi, budi</h1>
            </div>
            <div>
                {{-- ada titipan baru --}}
                <h3>ada pesanan buat mu</h3>
            </div>
            <div>
                {{-- code + food name + amount --}}
                <h1 class='font-semibold'>#ORBR-27312 . Sushi jepun . 1x</h1>
            </div>

        </div>

        {{-- div tengah --}}
        <div>
            <div>
                
                <div>
                    {{-- atas --}}
                    <div>
                        {{-- pertama --}}
                        <h1 class='font-semibold'>Lokasi Pengambilan</h1>
                    </div>
                    <div>
                        {{-- kedua --}}
                        <h1 class='font-semibold'>Kantin Sushi Binusian - Meja 3</h1>
                    </div>
                </div>
                <div>
                    {{-- tengah --}}
                    <div>
                        {{-- pertama --}}
                        <h1>Binus anggrek - Lantai 1</h1>
                    </div>
                    <div>
                        {{-- kedua --}}
                        <h1>Estimasi Makanan Siap : 10 menit</h1>
                    </div>
                </div>
                <div>
                    {{-- bawah --}}
                    <h1></h1>
                </div>
            </div>
        </div>
        
        {{-- div bawah --}}
        <div>
            <div>
                {{-- atas --}}
            </div>
            <div>
                {{-- bawah --}}
            </div>
        </div>
    </div>

    {{-- div kanan --}}
    <div>
        <div>
            {{-- atas --}}
        </div>

        <div>
            {{-- tengah --}}
        </div>

        <div>
            {{-- bawah --}}
        </div>
    </div>
</div>


@endsection