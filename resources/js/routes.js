import home from "./components/home"


export default [{
    path: '/',
    component: home,
    name: 'home',

    // beforeEnter(to, from, next) {
    //     if (!localStorage.getItem('inventory')) {
    //         next();
    //     } else {
    //         next('/sales');
    //     }
    // }

}]