<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/dashboard')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Popular Technologies</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Technologies</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            @foreach ($popularTechnologies as $item)
                <li class="nav-item"> <a class="nav-link tech-link" data-id="{{$item->id}}" href="">{{$item->technology_name}}</a></li>
            @endforeach
            {{-- <li class="nav-item"> <a class="nav-link" href="{{asset('pages/ui-features/buttons.html') }}">PHP</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{asset('pages/ui-features/dropdowns.html') }}">JAVA</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{asset('pages/ui-features/typography.html') }}">PYTHON</a></li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Technologies</li>
      @foreach ($technologies as $item)
      <li class="nav-item">  
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements{{$item['technology_id']}}" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">{{$item['technology_name']}}</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements{{$item['technology_id']}}">
            @foreach ($item['frameworks'] as $framework)    
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link nav-framework-link" data-id="{{$framework['id']}}"href="{{ url('/user_framework/'.$framework['id']) }}">{{$framework['framework_name']}}</a></li>
            </ul>
            @endforeach
          </div>
        </li>
        @endforeach
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="menu-icon mdi mdi-layers-outline"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{asset('pages/icons/mdi.html') }}">Mdi icons</a></li>
          </ul>
        </div>
      </li> --}}
      <li class="nav-item nav-category">Pages</li>  
      <li class="nav-item"> <a class="nav-link" href="{{url('/all_technologies')}}">
        <i class="menu-icon mdi mdi-card-text-outline"></i>
          <span class="menu-title">All Technologies</span>
        </a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="{{ url('/notificationPanel') }}">
            <i class="menu-icon mdi mdi-bell-outline"></i>
            <span class="menu-title">Notifications</span>
        </a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="{{ url('/user_edit') }}">
            <i class="menu-icon mdi mdi-account-circle-outline"></i>
            <span class="menu-title">My Profile</span>
        </a>
      </li>
      
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">My Profile</span>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{asset('pages/samples/login.html') }}"> Login </a></li>
          </ul>
        </div>
      </li> --}}
      <li class="nav-item nav-category">help</li>
      <li class="nav-item">
        <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
          <i class="menu-icon mdi mdi-file-document"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>