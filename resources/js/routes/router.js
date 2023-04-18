const routesGeral = [
    {
        path: "/",
        name: "Login",
        component: () => import("@/pages/Login.vue"),
    },
    {
        path: "/home",
        name: "Home",
        component: () => import("@/pages/Home.vue"),
    },
];

export default routesGeral;
