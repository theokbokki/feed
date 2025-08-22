<x-layout>
    <form id="logoutForm" method="post" action="{{ route('logout.store') }}">
        @csrf
    </form>
    <script>
        document.getElementById('logoutForm').submit();
    </script>
    <noscript>
        <button type="submit" form="logoutForm">Logout</button>
    </noscript>
</x-layout>
