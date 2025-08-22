<x-layout>
    <h1>Login</h1>
    <form method="post" action="{{ route('login.store') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" />
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <label for="password">Password</label>
        <input type="password" name="password" id="password"/>
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember" id="remember" @checked(old('remember') === 'on')>
        <button type="submit">Create</button>
    </form>
</x-layout>
