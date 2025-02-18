<x-guest-layout title="Login Page" bodyClass="page-login" class="login-text-dont-have-account">

    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" placeholder="Your Email" name="email" value="{{ old('email') }}" />
            @error('email')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" placeholder="Your Password" name="password" />
            @error('password')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-right mb-medium">
            <a href="{{ route('reset-password') }}" class="auth-page-password-reset">Reset Password</a>
        </div>

        <button class="btn btn-primary btn-login w-full">Login</button>
    </form>

    <x-slot:footerLinks>
        Don't have an account? -
        <a href="/signup"> Click here to create one</a>
    </x-slot:footerLinks>

</x-guest-layout>
