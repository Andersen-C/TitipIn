@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')

<div class="p-12"> 
     {{-- <h1 class="text-3xl font-bold m-6 text-blue-900">Pesanan</h1> --}}
    
        <div class='items-center'>
            {{-- div di bawah ini(container mx-auto px-2 untuk componentnya) --}}
            <h1 class="text-3xl sm:flex sm:flex-row font-bold text-blue-900">Pesanan</h1>
            @for($i=0; $i<3; $i++)
            <div class='container sm:mb-4'>

                <div class="flex flex-col p-4 border-2 border-zinc-500 rounded-lg  -sm sm:flex-row ">
                    <div class="flex flex-col sm:justify-center w-full sm:w-1/4  sm:h-max">
                        <img class=" justify-center  rounded-md py-"  src="https://picsum.photos/200/100" alt="">
                        
                    </div>
                    
                    <div class="flex flex-col sm:w-1/2 ml-0 p-6">
                        <h3 class="text-black">kantin pisang - kweitau</h3>
                        
                        <p class="text-black">RP. 10,000</p>
                        
                        <p class="text-black mt-4 sm:mt-auto">dari lantai 2 -> lantai 5</p>
                    </div>
                    
                    <div class="flex flex-col  sm:w-1/4 justify-between sm:items-end">
                            
                            <div class="flex flex-row mb-2 justify-end">
                                <div class="flex flex-col px-3 border-2 text-white font-semibold border-blue-500 bg-blue-500 rounded-md ">
                                    <h2>New Order</h2>
                                </div>
                            </div>
                            
                            <div class="flex flex-row items-end  ">
                                
                                <div class="flex flex-col">
                                    {{-- ini terima/pending teks aja kalau kelar dii hidden --}}
                                    <button  class="text-green px-2 py-1 font-semibold -sm:items-start ">Terima</button>
                                </div>
                                <div class="flex flex-col justify-end ml-auto">
                                    <a href="#" class='text-blue-800  hover:bg-blue-900 hover:text-white transition duration-200 font-semibold border-2 rounded-md px-3 py-1'>Detail</a>
                                    
                                    {{-- yang bawah untuk yang selesai --}}
                                    {{-- <a href="#" class="text-white font-bold bg-green-500  border-2 rounded-md px-3 py-1">Selesai</a> --}}

                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>   
    </div>

@endsection