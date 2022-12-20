{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-title font-lg">Home</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-title font-lg">School</li>
<li class="nav-item nav-dropdown open">
    <a href="#" class="nav-link nav-dropdown-toggle">
        <em class="nav-icon la la-users"></em>List
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('student') }}"><i class="nav-icon la la-id-card"></i> Student</a></li>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('subject') }}"><i class="nav-icon la la-book"></i> Subject</a></li>
        </li>
    </ul>
</li>

<li class="nav-title font-lg">Product</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon la la-school"></i> Product</a></li>