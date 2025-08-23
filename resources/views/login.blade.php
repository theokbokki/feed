<x-layout>
    <h1 class="app__title">Login</h1>
    <form method="post" action="{{ route('login.store') }}" class="app__form">
        @csrf
        <label for="email" class="app__label">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="app__input" />
        @error('email')
            <p class="app__error">{{ $message }}</p>
        @enderror
        <label for="password" class="app__label">Password</label>
        <input type="password" name="password" id="password" class="app__input"/>
        @error('password')
            <p class="app__error">{{ $message }}</p>
        @enderror
        <div>
            <label for="remember" class="app__label">Remember me</label>
            <input type="checkbox" name="remember" id="remember" @checked(old('remember') === 'on') class="app__checkbox">
        </div>
        <button type="submit" class="app__button">Submit</button>
    </form>
</x-layout>
