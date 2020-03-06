import Vue from "vue";
import Router from "vue-router";
import CreateCategory from "./components/backend/category/CreateComponent.vue";
import IndexCategory from "./components/backend/category/IndexComponent.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    fallback: false,
    routes: [
        {
            path: "/category",
            name: "category",
            component: IndexCategory
        },
        {
            path: "/category/create",
            name: "create",
            component: CreateCategory
        }
    ]
});
