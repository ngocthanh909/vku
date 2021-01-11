<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('cseIndex')}}">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b6/Logo_tr%C6%B0%E1%BB%9Dng_%C4%90%E1%BA%A1i_h%E1%BB%8Dc_C%C3%B4ng_ngh%E1%BB%87_th%C3%B4ng_tin_v%C3%A0_Truy%E1%BB%81n_th%C3%B4ng_Vi%E1%BB%87t_-_H%C3%A0n%2C_%C4%90%E1%BA%A1i_h%E1%BB%8Dc_%C4%90%C3%A0_N%E1%BA%B5ng.png" style="height: 2rem; width:auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"> <a class="nav-link" href="#">Giới thiệu </a> </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Đào tạo </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#"> Đại học </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('csePostView', ['slug' => 'nganh-khoa-hoc-may-tinh'])}}">Khoa học máy tính</a></li>
                                <li><a class="dropdown-item" href="{{route('csePostView', ['slug' => 'nganh-ky-thuat-may-tinh'])}}">Kĩ thuật máy tính</a></li>
                        </li>
                    </ul>
                </li>
            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('csePostBrowse', ['slug' => 'nghien-cuu-khoa-hoc'])}}"> Nghiên cứu </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Tin tức </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('csePostBrowse', ['slug' => 'tin-hoc-vu'])}}"> Tin học vụ </a></li>
                    <li><a class="dropdown-item" href="{{route('csePostBrowse', ['slug' => 'hoat-dong-sinh-vien'])}}"> Hoạt động sinh viên </a></li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Tra cứu </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"> Quy định , biểu mẫu </a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> Thực tập </a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> Thực tập </a>
            </li>
            </ul>
        </div>
    </div>

</nav>
