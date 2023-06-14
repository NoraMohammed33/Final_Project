<template>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">


                <!-- Brand -->
                <a class="navbar-brand" href="/api/admin">
                   <span class="text-green fw-bold fs-2">Developers Oasis</span>
                </a>
                <a class="navbar-brand" href="#">
                    <span class="text-green ">Admin dashboard</span>
                </a>


<!--                menuuuu-->
           <router-link :to="'/services'"  class="list-group-item  py-2 mx-4 ripple ">
                        <span>services</span>
                    </router-link>


                    <router-link :to="'/addpost'"  class="list-group-item mx-4  py-2 ripple ">
                        <span> posts</span>
                    </router-link>

                    <router-link :to="'/post'" class="list-group-item mx-4  py-2 ripple ">
                        <span>experts</span>
                    </router-link>

                <router-link :to="'/post'" class="list-group-item mx-4  py-2 ripple ">
                    <span>departments</span>
                </router-link>



                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                           role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>



                    <!-- Icon dropdown -->

                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                           id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                                 height="22" alt="Avatar" loading="lazy" />
                        </a>

                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
</template>
<script setup>
</script>
