
<ul class="nav nav-pills nav-justified mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{  ($page=="events" || $page=="subevents") ? 'active' : '' }}"  href="{{ route('admin.eventlist', ['user_id'=>$user_id]) }}" >
            All Events / Sub Events
        </a>
    </li>
    
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{  ($page=="guest") ? 'active' : '' }}" href="{{ route('admin.guestlist', ['user_id'=>$user_id]) }}" >
            Guest Book
        </a>
    </li>
    
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{  ($page=="task") ? 'active' : '' }}" href="{{ route('admin.usertasklist', ['user_id'=>$user_id]) }}">
            Tasks
        </a>
    </li>
   
    <li class="nav-item waves-effect waves-light" role="presentation">
        
        <a class="nav-link {{  ($page=="vendor") ? 'active' : '' }}" href="{{ route('admin.vendorlistbyuserid', ['user_id'=>$user_id]) }}">
            Vendors
        </a>
    </li>
 
    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link {{  ($page=="budget") ? 'active' : '' }}" href="{{ route('admin.budgetlistbyuserid', ['user_id'=>$user_id]) }}" >
            Budget
        </a>
    </li>

    <li class="nav-item waves-effect waves-light" role="presentation">
        <a class="nav-link " data-bs-toggle="tab" href="#pill-justified-settings-1" role="tab" aria-selected="true">
            Reminder
        </a>
    </li>
</ul>
                           