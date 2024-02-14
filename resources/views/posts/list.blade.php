<x-app-layout>
    <div class="mb-4 text-sm text-black-600 dark:text-gray-400">
        {{ __('Posts') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <table id="postTable" class="text-black">
        <thead>
            <th>SN</th>
            <th>Title</th>
            <th>Description</th>
        </thead>
        <tbody>
            @php
            $serialNumber = 1;
            @endphp
            @foreach ($posts as $post)
            <tr>
                <th>{{ $serialNumber++ }}</th>
                <th>{{ $post->title }}</th>
                <th>{{ $post->description }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>

<script>
    $(document).ready(function() {
        new DataTable('#postTable');


        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Saved",
            showConfirmButton: false,
            timer: 1500
        });
    });
</script>
