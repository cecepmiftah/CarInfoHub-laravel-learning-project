<x-app-layout>
    @if ($errors->updatePassword->any())
        @foreach ($errors->updatePassword->all() as $error)
            <div class="bg-red-500 text-gray-600 bold m-auto py-2 px-3 text-base">
                {{ $error }}
            </div>
        @endforeach
    @endif


    <div class="container mt-2">
        <h1 class="font-bold text-2xl my-2">Edit Profile</h1>
        <form action="{{ route('user.update', $user) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                    required>
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{ $user->phone }}"
                    required>

                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
        <hr class="my-5">
        <form action="{{ route('user.update-password', $user) }}" method="POST" class="mt-5">
            @csrf
            @method('PATCH')

            <h1 class="font-bold text-2xl my-2">Change Password</h1>
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                @error('current_password', 'updatePassword')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <label for="password_confirmation">Retype New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                @error('password', 'updatePassword')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
</x-app-layout>
