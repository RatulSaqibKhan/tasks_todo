<!--navigation-->
<ul class="metismenu" id="menu">
  <li class="menu-label">TASK MANAGEMENT</li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-crown'></i>
      </div>
      <div class="menu-title">Jobs</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
    </ul>
  </li>
  <li class="menu-label">APP SETTINGS</li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-home-heart'></i>
      </div>
      <div class="menu-title">Company</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/companies') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='lni lni-users'></i>
      </div>
      <div class="menu-title">Users</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/users') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
      <li>
        <a href="{{ url('/') }}"><i class="bx bx-right-arrow-alt"></i>Task Assignment</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-calendar-x'></i>
      </div>
      <div class="menu-title">Holidays</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/holidays') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-user-voice'></i>
      </div>
      <div class="menu-title">Clients</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/clients') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-chevron-right-square'></i>
      </div>
      <div class="menu-title">Job Types</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/job-types') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='bx bx-layer'></i>
      </div>
      <div class="menu-title">Templates</div>
    </a>
    <ul>
      <li>
        <a href="{{ url('/templates') }}"><i class="bx bx-right-arrow-alt"></i>List</a>
      </li>
      <li>
        <a href="{{ url('/templates/assign-tasks') }}"><i class="bx bx-right-arrow-alt"></i>Assign Tasks</a>
      </li>
    </ul>
  </li>
</ul>
<!--end navigation-->