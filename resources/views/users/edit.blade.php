<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit User') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Mohon isi kolom dibawah dengan benar.') }}
                        </p>
                    </header>
                    <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="name" :value="__('Nama')" required />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$user->name" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="email" :value="__('Email')" required />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$user->email" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="password" :value="__('Password')" required />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :value="old('password')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="telepon" :value="__('Telepon')" :required="false"/>
                                <x-text-input id="telepon" name="telepon" type="text" class="mt-1 block w-full" :value="$user->telepon" autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('telepon')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="alamat" :value="__('Alamat')" :required="false"/>
                                <x-textarea-input :value="$user->alamat" name="alamat"/>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="role" :value="__('Role')" required />
                                <x-select-input id="role" name="role" :options="$roleOptions" required :selected="$user->role"/>
                                <x-input-error class="mt-2" :messages="$errors->get('role')" />
                            </div>
                        </div>

                        <x-primary-button>Simpan</x-primary-button>
                        <x-button-link-secondary href="{{ route('users.index') }}">Batal</x-button-link-secondary>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
