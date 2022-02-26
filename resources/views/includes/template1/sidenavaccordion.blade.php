<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('home')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>


                


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Admin
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Masters
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- <a class="nav-link" href="{{route('areas.index')}}">Areas</a> -->
                                <!-- <a class="nav-link" href="{{route('caseresponses.index')}}">Case Responses</a> -->
                                <!-- <a class="nav-link" href="{{route('casesummaries.index')}}">Case Summary</a> -->
                                <!-- <a class="nav-link" href="{{route('casetrackers.index')}}">Case Trackers</a> -->
                                <!-- <a class="nav-link" href="{{route('categories.index')}}">Categories</a> -->
                                <a class="nav-link" href="{{route('cities.index')}}">Cities</a>
                                <a class="nav-link" href="{{route('clients.index')}}">Clients</a>
                                <!-- <a class="nav-link" href="{{route('clientgsts.index')}}">Client GSTs</a> -->
                                <a class="nav-link" href="{{route('clientstates.index')}}">Client States</a>
                                <a class="nav-link" href="{{route('clientstateusers.index')}}">Client State Users</a>
                                <!-- <a class="nav-link" href="{{route('documentlobs.index')}}">Document LOBs</a> -->
                                <!-- <a class="nav-link" href="{{route('documents.index')}}">Documents</a> -->
                                <a class="nav-link" href="{{route('files.index')}}">Cases</a>
                                <!-- <a class="nav-link" href="{{route('groupmaps.index')}}">Group Maps</a> -->
                                <a class="nav-link" href="{{route('hubs.index')}}">Hubs</a>
                                <a class="nav-link" href="{{route('hublocs.index')}}">Hub Locations</a>
                                <a class="nav-link" href="{{route('lobs.index')}}">LOBs</a>
                                <a class="nav-link" href="{{route('locations.index')}}">Locations</a>
                                <!-- <a class="nav-link" href="{{route('lookups.index')}}">Lookups</a> -->
                                <!-- <a class="nav-link" href="{{route('questions.index')}}">Questions</a> -->
                                <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                                <!-- <a class="nav-link" href="{{route('roleworkflows.index')}}">Role Work Flows</a> -->
                                <a class="nav-link" href="{{route('states.index')}}">States</a>
                                <a class="nav-link" href="{{route('sublobs.index')}}">Sub LOBs</a>
                                <a class="nav-link" href="{{route('tasks.index')}}">Tasks</a>
                                <a class="nav-link" href="{{route('taskusers.index')}}">Task Users</a>
                                <a class="nav-link" href="{{route('taskroles.index')}}">Task Roles</a>
                                <a class="nav-link" href="{{route('users.index')}}">Users</a>
                                <a class="nav-link" href="{{route('userclients.index')}}">User Clients</a>
                                <a class="nav-link" href="{{route('userfiles.index')}}">User Files</a>
                                <!-- <a class="nav-link" href="{{route('usergroups.index')}}">User Groups</a> -->
                                <a class="nav-link" href="{{route('userlobs.index')}}">User LOBs</a>
                                <a class="nav-link" href="{{route('userlocs.index')}}">User Locations</a>
                                <!-- <a class="nav-link" href="{{route('userlogs.index')}}">User Logs</a> -->
                                <a class="nav-link" href="{{route('userroles.index')}}">User Roles</a>
                                <a class="nav-link" href="{{route('vendors.index')}}">Vendors</a>
                                <!-- <a class="nav-link" href="{{route('workflows.index')}}">Work Flows</a> -->
                                <!-- <a class="nav-link" href="{{route('zones.index')}}">Zones</a> -->
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('files.reassignfile')}}">Re-Assign Files</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                

                
                <div class="sb-sidenav-menu-heading">Pages</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Case
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('files.index')}}">Files</a>
                    </nav>
                </div>
                


                <div class="sb-sidenav-menu-heading">Reports</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Reports
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('reports.policyno')}}">Report</a>
                    </nav>
                </div>


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name ?? 'Guest' }}
        </div>
    </nav>
</div>