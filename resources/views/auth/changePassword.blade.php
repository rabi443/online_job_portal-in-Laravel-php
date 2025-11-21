{{-- <form method="POST" action="{{ route('change-password') }}">
    @csrf
    <label for="current_password">Current Password</label>
    <input type="password" name="current_password" required>

    <label for="new_password">New Password</label>
    <input type="password" name="new_password" required>

    <label for="new_password_confirmation">Confirm New Password</label>
    <input type="password" name="new_password_confirmation" required>

    <button type="submit">Change Password</button>
</form>

<!-- Show success message -->
@if (session('status'))
    <p style="color: green;">{{ session('status') }}</p>
@endif

<!-- Show error messages -->
@error('current_password')
    <p style="color: red;">{{ $message }}</p>
@enderror

@error('new_password')
    <p style="color: red;">{{ $message }}</p>
@enderror --}}
