const router = {
    namespaced: true,
    state: {
        routerMap: [
            {
                path: '/test',
                name: 'test',
                component: (resolve) => require(['../pages/welcome'], resolve)
            },
            {
                path: '/admin',
                name: 'admin',
                component: (resolve) => require(['../pages/admin'], resolve),
                children: [
                    {
                        path: '',
                        name: '控制台',
                        component: (resolve) => require(['../components/admin-controller'], resolve),
                    },
                    {
                        path: 'setting',
                        name: '所有配置',
                        component: (resolve) => require(['../components/setting-list'], resolve),
                    },
                    {
                        path: 'logs',
                        name: '所有日志',
                        component: (resolve) => require(['../components/logs'], resolve),
                    },
                    {
                        path: 'message/:id',
                        name: '短句',
                        component: (resolve) => require(['../components/message-list'], resolve),
                    },
                    {
                        path: 'template/:id',
                        name: '样式',
                        component: (resolve) => require(['../components/setting-template'], resolve),
                    },
                    {
                        path: 'domain',
                        name: 'Domains',
                        component: (resolve) => require(['../components/domain'], resolve),
                    },
                    {
                        path: 'domain/:id',
                        name: 'Domain in xx',
                        component: (resolve) => require(['../components/message-list'], resolve),
                    },
                ]
            },
            { path: '/', redirect: '/admin', hidden: true },
            { path: '*', redirect: '/404', hidden: true }
        ],
        added: false,
    },
    getters: {
        asyncRouterMap(state)
        {
            return state.routerMap;
        },
        getAdded(state)
        {
            return state.added;
        }
    },
    mutations: {
        addRouterOver(state)
        {
            state.added = true;
        }
    }
};

export default router;
