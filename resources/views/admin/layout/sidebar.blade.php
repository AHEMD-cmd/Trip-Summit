<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_dashboard') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Dashboard</span></a></li>

            <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('settings.edit', 1) }}"><i class="fas fa-hand-point-right"></i>
                    <span>Setting</span></a></li>

            <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('sliders.index') }}"><i class="fas fa-hand-point-right"></i> <span>Slider</span></a>
            </li>

            <li class="{{ Request::is('admin/welcome-item/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('welcome-item.edit') }}"><i class="fas fa-hand-point-right"></i> <span>Welcome
                        Item</span></a></li>

            <li class="{{ Request::is('admin/features*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('features.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Feature</span></a></li>

            <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('testimonials.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Testimonial</span></a></li>

            <li class="{{ Request::is('admin/team-members*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('team-members.index') }}"><i class="fas fa-hand-point-right"></i> <span>Team
                        Member</span></a></li>

            <li class="{{ Request::is('admin/faqs*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('faqs.index') }}"><i class="fas fa-hand-point-right"></i> <span>FAQ</span></a></li>

            <li class="{{ Request::is('admin/counter-items*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('counter-items.edit') }}"><i class="fas fa-hand-point-right"></i> <span>Counter
                        Item</span></a></li>


            <li class="nav-item dropdown {{ Request::is('admin/categories*') || Request::is('admin/posts*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Blog Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('posts.index') }}"><i class="fas fa-angle-right"></i> Post</a></li>
                </ul>
            </li>

       

            <li class="{{ Request::is('admin/destinations*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('destinations.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Destination</span></a></li>

            <li
                class="{{ Request::is('admin/packages*') || Request::is('admin/package-itineraries/*') || Request::is('admin/package-itinerary-*') || Request::is('admin/package-amenities/*') || Request::is('admin/package-amenity-*') || Request::is('admin/package-photos/*') || Request::is('admin/package-photo-*') || Request::is('admin/package-videos/*') || Request::is('admin/package-video-*') || Request::is('admin/package-faqs/*') || Request::is('admin/package-faq-*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('packages.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Package</span></a>
            </li>

            <li class="{{ Request::is('admin/tours*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('tours.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Tour</span></a></li>

            <li
                class="nav-item dropdown {{ Request::is('admin/subscribers') || Request::is('admin/subscribers-send-email') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Subscriber
                        Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscribers') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('subscribers.index') }}"><i class="fas fa-angle-right"></i> All
                            Subscribers</a></li>
                    <li class="{{ Request::is('admin/subscribers-send-email') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('subscribers.send-email') }}"><i class="fas fa-angle-right"></i> Send
                            Email</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/reviews*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('reviews.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Reviews</span></a></li>

            <li class="{{ Request::is('admin/amenities*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('amenities.index') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Amenity</span></a></li>

            <li class="{{ Request::is('admin/home-items*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('home-items.edit', 1) }}"><i class="fas fa-hand-point-right"></i> <span>Home
                        Page Item</span></a></li>

            <li class="{{ Request::is('admin/about-items*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('about-items.edit', 1) }}"><i class="fas fa-hand-point-right"></i> <span>About
                        Page Item</span></a></li>

            <li class="{{ Request::is('admin/contact-items*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('contact-items.edit', 1) }}"><i class="fas fa-hand-point-right"></i>
                    <span>Contact Page Item</span></a></li>

            <li class="{{ Request::is('admin/term-privacy-items*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('term-privacy-items.edit', 1) }}"><i class="fas fa-hand-point-right"></i>
                    <span>Term & Privacy Page Item</span></a></li>

            <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_profile') }}"><i class="fas fa-hand-point-right"></i>
                    <span>Profile</span></a></li>

        </ul>
    </aside>
</div>
