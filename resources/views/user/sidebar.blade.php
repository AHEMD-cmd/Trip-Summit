<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Route::is('user_dashboard') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ Route::is('bookings')||Request::is('user/invoice/*') ? 'active' : '' }}">
        <a href="{{ route('bookings') }}">Booking</a>
    </li>
    <li class="list-group-item {{ Route::is('wishlist') ? 'active' : '' }}">
        <a href="{{ route('wishlist') }}">Wishlist</a>
    </li>
    
    <li class="list-group-item {{ Route::is('reviews') ? 'active' : '' }}">
        <a href="{{ route('reviews') }}">Reviews</a>
    </li>
    <li class="list-group-item {{ Route::is('profile') ? 'active' : '' }}">
        <a href="{{ route('user.profile.edit') }}">Edit Profile</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('logout') }}">Logout</a>
    </li>
</ul>