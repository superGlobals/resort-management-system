<ul class="side-nav">

                <li class="side-nav-title side-nav-item">Navigation</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                        <a href="<?= base_url('/admin') ?>" class="side-nav-link">
                        <i class="uil-home-alt"></i>      
                        <span> Dashboards </span>
                    </a>
                    
                </li>

                <li class="side-nav-title side-nav-item">Room booking</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarReservation" aria-expanded="false" aria-controls="sidebarReservation" class="side-nav-link">
                        <i class="fa-solid fa-hotel fs-5"></i>
                        <span> Manage Reservations </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarReservation">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/pending-room') ?>">Pending</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/accepted-room') ?>">Accepted</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/completed-room') ?>">Completed</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/cancelled-room') ?>">Cancelled</a>
                            </li>
                            <!-- <li>
                                <a href="<?= base_url('/Customer/customer-list') ?>">All Entrance & Cottage Reservation</a>
                            </li> -->
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarCheck" aria-expanded="false" aria-controls="sidebarCheck" class="side-nav-link">
                        <i class="fa-solid fa-check"></i>
                        <span> Manage Checkin </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCheck">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/checkin') ?>">Checkin</a>
                            </li>

                            <!-- <li>
                                <a href="<?= base_url('/Customer/customer-list') ?>">All Entrance & Cottage Reservation</a>
                            </li> -->
                        </ul>
                    </div>
                </li>

                <li class="side-nav-title side-nav-item">Events booking</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarEventPlaceTrans" aria-expanded="false" aria-controls="sidebarEventPlaceTrans" class="side-nav-link">
                        <i class="fa-solid fa-calendar-days fs-5"></i>
                        <span> Manage Events Place </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEventPlaceTrans">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/pending-event-booking') ?>">Pending</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/accepted-event-booking') ?>">Accepted</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/completed-event-booking') ?>">Completed</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/cancelled-event-booking') ?>">Cancelled</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarActiveEvents" aria-expanded="false" aria-controls="sidebarActiveEvents" class="side-nav-link">
                        <i class="fa-solid fa-calendar-days fs-5"></i>
                        <span> Manage Active Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarActiveEvents">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/active-event-booking') ?>">Active Event</a>
                            </li>
                          
                    </div>
                </li>


                <li class="side-nav-title side-nav-item">Users</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarCustomers" aria-expanded="false" aria-controls="sidebarCustomers" class="side-nav-link">
                        <i class="fa-solid fa-id-badge fs-4"></i>
                        <span> Manage Customers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomers">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Customer/customer-list') ?>">All Customers</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers" class="side-nav-link">
                        <i class="fa-solid fa-user-tie fs-4"></i>
                        <span> Manage Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarUsers">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/User/user-management') ?>">All Users</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-title side-nav-item">Rooms & Events</li>


                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarRooms" aria-expanded="false" aria-controls="sidebarRooms" class="side-nav-link">
                        <i class="fa-solid fa-bed fs-4"></i>
                        <span> Manage Rooms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarRooms">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Room/all-rooms') ?>">All Rooms</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/Room/all-category') ?>">Room Category</a>
                            </li>

                            <li>
                                <a href="<?= base_url('/Room-number/room-number') ?>">Room Number</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarEvents" aria-expanded="false" aria-controls="sidebarEvents" class="side-nav-link">
                    <i class="fa-solid fa-calendar-days fs-4"></i>
                        <span> Manage Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEvents">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Events/events-places') ?>">All Events</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <!-- <li class="side-nav-title side-nav-item">Transactions</li> -->

                <!-- <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarTransaction" aria-expanded="false" aria-controls="sidebarTransaction" class="side-nav-link">
                        <i class="fa-solid fa-sack-dollar fs-4"></i>
                        <span> Manage Transaction </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTransaction">
                        <ul class="side-nav-second-level">
                        <li>
                                <a href="<?= base_url('/Room/available-rooms') ?>">View available rooms</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/Room/rooms-reservation') ?>">All Reserved Rooms</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <li class="side-nav-title side-nav-item">Reports</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarReports" aria-expanded="false" aria-controls="sidebarReports" class="side-nav-link">
                        <i class="fa-solid fa-flag fs-4"></i>
                        <span> Manage Reports </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarReports">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Reports/generate-reports') ?>">Generate Reports</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- <li class="side-nav-title side-nav-item">Others</li>   -->

                <!-- <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarEntrance" aria-expanded="false" aria-controls="sidebarEntrance" class="side-nav-link">
                        <i class="fa-solid fa-gopuram fs-4"></i>
                        <span> Manage Entrance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEntrance">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Entrance/entrance-list') ?>">Entrance Fee</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarCottage" aria-expanded="false" aria-controls="sidebarCottage" class="side-nav-link">
                    <i class="fa-solid fa-house-flood-water fs-4"></i>
                        <span> Manage Cottage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCottage">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Cottage/cottage-list') ?>">Cottage Fee</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="side-nav-title side-nav-item">Setting</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false" aria-controls="sidebarSettings" class="side-nav-link">
                        <i class="fa-solid fa-gears"></i>
                        <span> Manage Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSettings">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/Payment/gcash-info') ?>">Gcash Information</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/Shutdown/shutdown-website') ?>">Shutdown Website</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/Rides') ?>">PMP Rides</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/Contacts') ?>">Contacts</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>