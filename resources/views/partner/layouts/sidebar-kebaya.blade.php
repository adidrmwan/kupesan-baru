<li>
    <a href="{{ route('kebaya.schedule') }}">
        <i class="pe-7s-note2"></i>
        <p>Booking Schedule</p>
    </a>
</li>
<li>
    <a href="{{ route('kebaya.off-booking') }}">
        <i class="pe-7s-note2"></i>
        <p>Offline Booking</p>
    </a>
</li>
<li>
    <a href="{{ route('kebaya.form.dayoff') }}">
        <i class="pe-7s-note2"></i>
        <p>Form Day-Off</p>
    </a>
</li>
<li>
    <a href="{{ route('kebaya.history') }}">
        <i class="pe-7s-server"></i>
        <p>Booking History</p>
    </a>
</li>
<li>
    <a href="{{ route('kebaya.profile') }}">
        <i class="pe-7s-user"></i>
        <p>Partner Profile</p>
    </a>
</li>
<li>
    <a href="{{ route('partner.portofolio') }}">
        <i class="pe-7s-photo-gallery"></i>
        <p>Upload Portofolio</p>
    </a>
</li>
<!-- <li>
    <a href="{{ route('partner.portofolio') }}">
        <i class="pe-7s-user"></i>
        <p>Terms & Condition</p>
    </a>
</li> -->
<li>
    <a>
        <i class="pe-7s-photo"> </i> <p> Package</p> 
    </a>
    <ul class="list-unstyled" id="pageSubmenu">
        <li style="margin-left: 35px;">
            <a href="{{ route('kebaya-package.create') }}">
                <i class="pe-7s-plus"></i>
                <p> Add Package </p>
            </a>
        </li>
        <li style="margin-left: 35px;">
            <a href="{{ route('kebaya-package.index') }}">
                <i class="pe-7s-note2"></i>
                <p> List Package </p>
            </a>
        </li>
    </ul>
</li>