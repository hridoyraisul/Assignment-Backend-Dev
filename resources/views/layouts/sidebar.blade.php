<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://cdn.iconscout.com/icon/free/png-256/laptop-user-1-1179329.png" alt="User Image" height="50px">
        <div>
            <p class="app-sidebar__user-name">Admin</p>
            <p class="app-sidebar__user-designation">(Developer)</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{route('dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li><a class="app-menu__item" href="{{route('job.list')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Job Posts</span></a></li>
        <li><a class="app-menu__item" href="{{url('/add-new-job')}}"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Add Job Post</span></a></li>
        <li><a class="app-menu__item" href="{{route('applicants')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Applicants</span></a></li>
    </ul>
</aside>
