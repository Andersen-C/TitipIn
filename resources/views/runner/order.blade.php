@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')

<div class="mx-auto py-8"> 
     <h1 class="text-3xl font-bold m-6 text-blue-900">Pesanan</h1>
        
        <div >
            {{-- div di bawah ini(container mx-auto px-2 untuk componentnya) --}}
                
            @for($i=0; $i<3; $i++):
            <div class='container mx-auto px-2'>

                <div class="flex flex-col p-4 border-2 border-zinc-500 rounded-lg gap-6      sm:flex-row ">
                    <div class="flex flex-col sm:items-center w-full sm:w-1/4">
                        <img class="sm:max-w-37  rounded-md py-"  src="https://picsum.photos/200/100" alt="">
                        
                    </div>
                    
                    <div class="flex flex-col w-1/2 ml-0">
                        <h3 class="text-black">kantin pisang - kweitau</h3>
                        
                        <p class="text-black">RP. 10,000</p>
                        
                        <p class="text-black mt-4 sm:mt-2">dari lantai 2 -> lantai 5</p>
                    </div>
                    
                    <div class="flex flex-col  sm:w-1/6 justify-between">
                            
                            <div class="flex flex-row mb-2 justify-end">
                                <div class="flex flex-col border-2 text-white font-semibold border-blue-500 bg-blue-500 rounded-md ">
                                    <h2>New Order</h2>
                                </div>
                            </div>
                            
                            <div class="flex flex-row items-end  ">
                                
                                <div class="flex flex-col">
                                    {{-- ini terima/pending teks aja kalau kelar dii hidden --}}
                                    <button  class="text-green px-2 py-1 font-semibold ">terima</button>
                                </div>
                                <div class="flex flex-col justify-end ml-auto">
                                    {{-- <button class='text-blue-800  font-semibold border-2 rounded-md px-3 py-1'>Detail</button> --}}
                                    
                                    {{-- yang bawah untuk yang selesai --}}
                                    <button class="text-white font-bold bg-green-500  border-2 rounded-md px-3 py-1">Selesai</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>   
    </div>

@endsection