function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
    { path: '/login', name: 'login', component: page('auth/login.vue') },

    { path: '/', name: 'home', component: page('home.vue') },
    {
        path: '/settings',
        component: page('settings/index.vue'),
        children: [
            { path: '', redirect: { name: 'settings.profile' } },
            { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
            { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
        ]
    },
    {
        path: '/messages',
        component: page('messages/index.vue'),
        children: [
            { path: '', redirect: { name: 'messages.index' } },
            { path: 'index', name: 'messages.index', component: page('messages/index.vue') },
        ]
    },
    {
        path: '/posts',
        component: page('posts/index.vue'),
        children: [
            { path: '', redirect: { name: 'posts.index' } },
            { path: 'index', name: 'posts.index', component: page('posts/index.vue') },
        ]
    },
    {
        path: '/users',
        component: page('users/index.vue'),
        children: [
            { path: '', redirect: { name: 'users.index' } },
            { path: 'index', name: 'users.index', component: page('users/index.vue') },
        ]
    },
    {
        path: '/manage',
        component: page('manage/index.vue'),
        children: [
            { path: '', redirect: { name: 'manage.index' } },
            { path: 'index', name: 'manage.index', component: page('manage/index.vue') },
        ]
    },
    {
        path: '/interests',
        component: page('interests/index.vue'),
        children: [
            { path: '', redirect: { name: 'interests.index' } },
            { path: '', name: 'interests.index', component: page('interests/index.vue') },
            { path: 'add', name: 'interests.add', component: page('interests/add.vue') },
            { path: 'edit/:id', name: 'interests.edit', component: page('interests/edit.vue') },
        ]
    },

    { path: '*', component: page('errors/404.vue') }
]