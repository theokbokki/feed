<x-layout>
    <h1 class="app__title">Logout</h1>
    <form id="logoutForm" method="post" action="{{ route('logout.store') }}">
        @csrf
    </form>
    <script>
        document.getElementById('logoutForm').submit();
    </script>
    <noscript>
        <button type="submit" form="logoutForm" class="app__button">Logout</button>
    </noscript>
</x-layout>
