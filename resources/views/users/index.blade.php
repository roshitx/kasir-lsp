<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (Session::has('success'))
            <x-sweetalert :message="Session::get('success')" />
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 text-white"><i class="bi bi-plus-lg"></i> Add</a>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-100 uppercase border-b bg-gray-400">
                                <th class="px-4 py-3 w-[1%] text-center">#</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3 w-[1%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('users.edit', $user->id) }}" type="button" class="btn btn-warning btn-sm text-white"><i class="bi bi-pencil-square"></i></a>
                                        @if ($user->email != Auth::user()->email)
                                        <button class="btn btn-error text-white btn-sm deleteBtn" data-user="{{ $user->id }}"><i class="bi bi-trash3"></i></button>
                                        <form method="post" action="{{ route('users.destroy', ['user' => $user->id]) }}" class="hidden deleteForm" data-user="{{ $user->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnDetail').click(function() {
                let modal = $('#detailModal').modal('show');
                let name = $(this).data('user-detail');
            })

            $('.deleteBtn').click(function() {
                const user = $(this).data('user');
                console.log(user);
                Swal.fire({
                    title: 'Anda yakin?'
                    , text: "Anda tidak bisa mengembalikan data ini!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const deleteForm = $(`.deleteForm[data-user="${user}"]`);
                        deleteForm.submit();
                    }
                });
            });
        })

    </script>
</x-app-layout>
