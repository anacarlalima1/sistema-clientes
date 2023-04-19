const routesGeral = [
    {
        path: "/",
        name: "Home",
        component: () => import("@/pages/Inicio.vue"),
    },
    {
        path: "/home",
        name: "Home",
        component: () => import("@/pages/clientes/Home.vue"),
    },
    {
        path: "/visualizar/:id",
        name: "Home",
        component: () => import("@/pages/Login.vue"),
        props: route => ({ idCliente: route.params.id }),
    },
];

export default routesGeral;
