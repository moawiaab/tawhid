import { createStore } from "vuex";

import UsersIndex from "./modules/Users";
import UsersSingle from "./modules/Users/single";
import RolesIndex from "./modules/Roles";
import RolesSingle from "./modules/Roles/single";


// import SideBar from "./sidebar";

export default createStore({
    modules: {
        UsersIndex,
        UsersSingle,
        RolesIndex,
        RolesSingle,
    },
});
