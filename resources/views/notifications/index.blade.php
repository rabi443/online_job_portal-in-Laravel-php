<x-header-footer>
    <div class="container py-5">
        <h2>All Notifications</h2>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('notifications.read', $notification->id) }}">
                        {{ $notification->data['message'] }}
                    </a>
                    @if($notification->read_at == null)
                        <span class="badge bg-danger">New</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</x-header-footer>
