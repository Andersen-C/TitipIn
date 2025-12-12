@extends('template.mainAdmin')
@section('Title', 'Create User')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">
        <div class="relative mb-4 flex items-center">
        <a href="{{ route('users.index') }}" 
        class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 
                text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            Create User
        </h2>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="relative">
                    <label for="name" class="block mb-1.5 text-sm font-bold text-gray-900 
                    {{ $errors->has('name') ? 'text-red-600' : 'text-gray-900' }}">Username</label>
                    
                    <div class="relative">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full rounded-xl ps-4 bg-gray-50 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-gray-900 text-sm 
                        {{ $errors->has('name') ? 'border-red-600 text-red-600' : 'border-default-medium' }} rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Masukkan Username">
                        
                        @error('name')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="phone-input" class="block mb-1.5 text-sm font-bold text-gray-900
                        {{ $errors->has('phone_number') ? 'text-red-600' : 'text-gray-900' }}">Nomor Telepon</label>
                        
                        <div class="relative">
                            <input type="text" name="phone_number" id="phone-input" value="{{ old('phone_number') }}" aria-describedby="helper-text-explanation" class="block w-full rounded-xl ps-4 bg-gray-50 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium
                            {{ $errors->has('phone_number') ? 'border-red-600 text-red-600' : 'border-default-medium' }}  text-gray-900 text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" pattern="08[0-9]{8,13}" placeholder="08xxxxxxxxxxx"/>
                            @error('phone_number')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
    
                    <div class="relative">
                        <label for="email" class="block mb-1.5 text-sm font-bold text-gray-900
                        {{ $errors->has('email') ? 'text-red-600' : 'text-gray-900' }}">Email</label>
                        
                        <div class="relative">                            
                            <input type="email" name="email" id="email"  value="{{ old('email') }}"  class="block w-full rounded-xl bg-gray-50 ps-4 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-gray-900 text-sm 
                            {{ $errors->has('email') ? 'border-red-600 text-red-600' : 'border-default-medium' }} rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Masukkan Email">
                            
                            @error('email')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="role" class="block mb-1.5 text-sm font-bold text-gray-900
                        {{ $errors->has('role') ? 'text-red-600' : 'text-gray-900' }}">Role</label>
                        
                        <select name="role" id="role" class="select block w-full rounded-xl bg-gray-50 text-black border border-default-medium 
                        {{ $errors->has('role') ? 'border-red-600 text-red-600' : 'border-default-medium' }} border-black">
                            <option disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : ''}}>User</option>
                        </select>
                        @error('role')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label name="mode" for="mode" class="block mb-1.5 text-sm font-bold text-gray-900
                        {{ $errors->has('mode') ? 'text-red-600' : 'text-gray-900' }}">Mode</label>
                        
                        <select name="mode" id="mode" class="select block w-full rounded-xl bg-gray-50 text-black border border-default-medium
                        {{ $errors->has('mode') ? 'border-red-600 text-red-600' : 'border-default-medium' }} border-black">
                            <option disabled {{ old('mode') ? '' : 'selected' }}>Pilih Mode</option>
                            <option value="titiper" {{ old('mode') == 'titiper' ? 'selected' : ''}}>Titiper</option>
                            <option value="runner" {{ old('mode') == 'runner' ? 'selected' : ''}}>Runner</option>
                        </select>
                        @error('mode')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="relative space-y-1">
                    <label for="file_input" class="block text-sm font-medium text-gray-900
                    {{ $errors->has('profile_picture') ? 'text-red-600' : 'text-gray-900' }}">
                        Profile Picture (Opsional)
                    </label>

                    <input 
                        name="profile_pic"
                        id="file_input" 
                        type="file" 
                        class="hidden"
                        accept="image/png, image/jpeg"
                        onchange="document.getElementById('file_name').textContent = this.files[0]?.name || 'No file chosen';"
                    >

                    <div class="flex bg-gray-50 items-center justify-between bg-neutral-secondary-medium 
                                border border-default-medium border-black rounded-xl px-3 py-2.5 shadow-xs
                                {{ $errors->has('profile_picture') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">

                        <span id="file_name" class="text-gray-600 text-sm">
                            {{ old('file_name') ?? 'Tidak ada File' }}
                        </span>

                        <button 
                            type="button" 
                            onclick="document.getElementById('file_input').click()"
                            class="px-3 py-1.5 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-900 hover:cursor-pointer"
                        >
                            Pilih File
                        </button>
                    </div>
                    @error('profile_pic')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <label for="password" class="block mb-1.5 text-sm font-bold 
                    {{ $errors->has('password') ? 'text-red-600' : 'text-gray-900' }}">Password</label>
                    
                    <div class="relative">
                        <input type="password" name="password" id="password" class="block w-full rounded-xl ps-4 bg-gray-50 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium
                        {{ $errors->has('password') ? 'border-red-600 text-red-600' : 'border-default-medium' }} text-gray-900 text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Masukkan Password">
                        @error('password')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="relative">
                    <label for="password_confirmation" class="block mb-1.5 text-sm font-bold text-gray-900
                    {{ $errors->has('password_confirmation') ? 'text-red-600' : 'text-gray-900' }}">Password Confirmation</label>
                    
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-xl ps-4 bg-gray-50 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium
                        {{ $errors->has('password_confirmation') ? 'border-red-600 text-red-600' : 'border-default-medium' }} text-gray-900 text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Masukkan Password Confirmation">
                        @error('password_confirmation')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center">
                    <button 
                        type="submit"
                        class="btn bg-blue-700 text-white text-sm rounded-xl hover:bg-blue-900"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
