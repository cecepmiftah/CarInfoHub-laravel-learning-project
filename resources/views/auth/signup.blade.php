<x-guest-layout title="Signup" bodyClass="page-signup" class="login-text-dont-have-account">


    <form :action="route('signup.store')" method="POST">

        @csrf
        <div class="form-group">
            <input type="text" placeholder="Name" name="name" id="first_name" value="{{ old('name') }}" />
            @error('name')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}" />
            @error('email')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" placeholder="Your Password" name="password" value="{{ old('password') }}" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Repeat Password" name="password_confirmation" />
            @error('password')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>
        <hr />


        <div class="form-group">
            <input type="text" placeholder="Phone" name="phone" id="phone" value="{{ old('phone') }}" />
            @error('phone')
                <p class="text-sm font-bold text-red-500 py-1">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-primary btn-login w-full">Register</button>

        <x-slot:footerLinks>
            Already have an account? -
            <a href="/login"> Click here to login </a>
        </x-slot:footerLinks>

    </form>

</x-guest-layout>
