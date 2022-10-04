<template>

    <div id="left-sidebar" class="sidebar">

        <div class="sidebar-scroll">
            <div class="user-account">
                <!-- <div class="user_div">
                    <img src="/assets/images/user.png" class="user-photo" alt="User Profile Picture">
                </div> -->
                <div class="dropdown">
                    <!-- <span>Welcome,</span> -->
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Louis
                            Pierce</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li v-for="item in sidebarItems" :key="item" :class="$route.path == item.url ? 'active open' : ''">

                        <router-link :to="item.url" v-if="$can(item.access)">
                            <i :class="item.icon"></i><span>{{item.title}}</span>
                        </router-link>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from "@vue/runtime-core";
const sidebarItems = [
    { url: '/dashboard', title: 'الرئيسية', icon: ' icon-speedometer', access: 'dashboard_access' },
    { url: '/users', title: 'المستخدمين',  icon: ' icon-user', access: 'user_access' },
    { url: '/roles', title: 'الصلاحيات',  icon: 'icon-lock-open ', access: 'role_access' },
];

</script>

<style scoped>
.sidebar-nav {
    overflow: scroll;
}
</style>

