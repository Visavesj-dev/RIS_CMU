<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('/images/EngGearLogo.png') }}" class="img-responsive" alt="logo" width="50" height="50"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            ระบบงานวิจัย
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-home"></i>
            <span>หน้าหลัก</span>
        </a>
    </li>

    <!-- Nav Item โหลดเอกสาร -->
    <li class="nav-item">
        <a class="nav-link" href="/document">
            <i class="fas fa-fw fa-download"></i>
            <span>ดาวน์โหลดเอกสาร</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        บันทึกเอกสาร
    </div>

    <!-- Nav Item โครงการ -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/research-project" data-toggle="collapse" data-target="#collapseResearchProject" aria-expanded="true"
            aria-controls="collapseProject">
            <i class="fas fa-fw fa-flask"></i>
            <span>โครงการ</span>
        </a>
        <div id="collapseResearchProject" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item text-black" href="{{ route('project.index') }}">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>โครงการ</span>
                </a>
                <a class="collapse-item text-black" href="{{ route('project-summary.tracking') }}">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>ติดตามผลงาน</span>
                </a>
                <a class="collapse-item text-black" href="{{ route('project-summary.individual') }}">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>สรุปผลงานรายคน</span>
                </a>
                <a class="collapse-item text-black" href="{{ route('project-summary.department') }}">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>สรุปผลงานภาควิชา</span>
                </a>
                <a class="collapse-item text-black" href="{{ route('project-authorize.index') }}">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>สรุปผลการมอบอำนาจ</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('meeting.index') }}">
            <i class="fas fa-fw fa-comments"></i>
            <span>ประชุมวิชาการ</span>
        </a>
    </li>


    {{-- วิเทศน์ --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseforeign" aria-expanded="true"
            aria-controls="collapseforeign">
            <i class="fas fa-fw fa-globe-asia"></i>
            <span>วิเทศสัมพันธ์</span>
        </a>
        <div id="collapseforeign" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">บันทึกข้อตกลง</h6>
                <a class="collapse-item text-black" href="{{ route('mou.index') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>MoU</span>
                </a>
                <a class="collapse-item text-black " href="{{ route('moa.index') }}">
                    <i class="fas fa-fw fa-file-contract"></i>
                    <span>MoA</span>
                </a>
                <a class="collapse-item text-black " href="{{ route('activity.index') }}">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>กิจกรรม</span>
                </a>
            </div>

            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">นักศึกษาแลกเปลี่ยน</h6>
                <a class="collapse-item text-black" href="/outbound-student">
                    <i class="fas fa-fw fa-plane-departure"></i>
                    <span>นักศึกษาไทย</span>
                </a>
                <a class="collapse-item text-black" href="/inbound-student">
                    <i class="fas fa-fw fa-plane-arrival"></i>
                    <span>นักศึกษาต่างชาติ</span>
                </a>
            </div>

            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เยี่ยมชม</h6>
                <a class="collapse-item text-black" href="/visitor">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>อาคันตุกะ</span>
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ระบบ
    </div>

    <!-- Nav Item ผู้ใช้งานระบบ -->
    <li class="nav-item">
        <a class="nav-link" href="/user">
            <i class="fas fa-users-cog"></i>
            <span>ผู้ใช้งานระบบ</span>
        </a>
    </li>

    <!-- Nav Item ตั้งค่าระบบ -->
    <li class="nav-item">
        <a class="nav-link" href="/system">
            <i class="fas fa-fw fa-cogs"></i>
            <span>ตั้งค่าระบบ</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
