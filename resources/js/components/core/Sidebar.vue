<template>

    <div id="left-sidebar" class="sidebar">

        <div class="sidebar-scroll">
            <div class="user-account">
                <!-- <div class="user_div">
                    <img src="/assets/images/user.png" class="user-photo" alt="User Profile Picture">
                </div> -->
                <div class="dropdown">
                    <!-- <span>Welcome,</span> -->
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>
                            مرحبا : {{userName}}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <span class="float-right btn-toggle-offcanvas" type="button" @click="close">
                    <i class="fa fa-times"></i>
                </span>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li v-for="item in sidebarItems" :key="item"
                        :class="openSidebar || item.url.includes($route.path) ? 'active open' : ''">

                        <span v-if="item.items">
                            <a  @click="openSidebar = !openSidebar" class="has-arrow" :class="openSidebar || item.url.includes($route.path) ? 'active' : ''"
                                :aria-expanded="openSidebar || (!openSidebar && item.url.includes($route.path))"><i
                                    :class="item.icon"></i><span>{{item.title}}</span></a>
                            <ul :aria-expanded="openSidebar || (!openSidebar && item.url.includes($route.path))"
                                :class="openSidebar || (!openSidebar && item.url.includes($route.path)) ? 'collapse in' : 'collapse'"
                                style="">
                                <li v-for="i in item.items" :key="i.url" :class="i.url == $route.path ? 'active' : ''">
                                    <router-link :to="i.url" v-if="$can(i.access)">
                                        <span>{{i.title}}</span>
                                    </router-link>
                                </li>
                            </ul>
                        </span>

                        <span v-else @click="openSidebar=false">
                            <router-link :to="item.url" v-if="$can(item.access)" >
                                <i :class="item.icon"></i><span>{{item.title}}</span>
                            </router-link>
                        </span>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<!-- offcanvas-active -->

<script setup>
import { computed, ref } from "vue";

const openSidebar = ref(false);
const userName = computed(() => 'moawia.ab');
const sidebarItems = [
    { url: '/dashboard', title: 'الرئيسية', icon: ' icon-speedometer', access: 'dashboard_access' },
    { url: '/accounts', title: 'الفروع', icon: ' icon-shuffle ', access: 'account_access' },
    // {
    //     url: ['/project-departments', '/project-stages', '/projects'], title: 'إدارة المشروعات', icon: 'fa fa-code-fork',
    //     items: [
    //         { url: '/project-departments', title: 'أقسام المشروع', access: 'project_department_access' },
    //         { url: '/project-stages', title: 'مراحل المشروع', access: 'stage_access' },
    //         { url: '/projects', title: ' نافذة المشروعات', access: 'project_access' },
    //     ]
    // },


    { url: '/users', title: 'المستخدمين', icon: ' icon-user', access: 'user_access' },
    { url: '/roles', title: 'الصلاحيات', icon: 'icon-lock-open ', access: 'role_access' },
    { url: '/permissions', title: 'الأذنات', icon: 'icon-lock-open ', access: 'permission_access' },
];

const close = () => {
    document.body.classList.remove('offcanvas-active');
}
</script>

<style scoped>
.sidebar-nav {
    overflow: scroll;
}

.has-arrow.active ,.router-link-active{
  color: #0dcaf0 !important;
}
</style>

