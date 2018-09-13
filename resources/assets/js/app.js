/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
window.Vue = require('vue');
window.Vue.use(ElementUI);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.bus = new Vue();

Vue.component('searchBar', require('./components/AppHeader/SearchBarComponent.vue'));
Vue.component('questionCard', require('./components/questionCardComponent.vue'));
Vue.component('comments', require('./components/CommentComponent.vue'));
Vue.component('modal', require('./components/ModalComponent.vue'));
Vue.component('questionForm', require('./components/questionFormComponent.vue'));
Vue.component('editable', require('./components/editableComponent.vue'));
Vue.component('questionList', require('./components/questionListComponent.vue'));
Vue.component('hoverCard', require('./components/UserCardComponent.vue'));
Vue.component('answerList', require('./components/AnswerListComponent.vue'));
Vue.component('answerCard', require('./components/AnswerCardComponent.vue'));
Vue.component('profile', require('./components/profileComponent.vue'));
Vue.component('topic', require('./components/TopicComponent.vue'));
Vue.component('sendMessage', require('./components/SendMessageComponent.vue'));


window.app = new Vue({
    delimiters: ["[[", "]]"],
    el: '#app',
    methods: {
        showQuestionModal () {
            this.bus.$emit('showQuestionModal');
        }
    },
    mounted () {
        this.bus.$on('showQuestionModal', () => {
            this.$refs.questionModal.$emit('showModal');
        });
    }
});

if(window.$){
    $.notification = function ({color, content, autoClose = true, time = 1300}) {
        const $ = window.$;
        function isInArray(arr, val) {
            const testStr=','+arr.join(",")+",";
            return testStr.indexOf(","+val+",")!=-1;
        }

        const colorArray = [
            'white', 'red', 'green', 'red-ghost'
        ];

        if(!isInArray(colorArray, color)){
            console.error('没有给定的颜色');
            return;
        }
        const className = `Notification-${color}`;
        const container = $('<div class="Notifications-container"></div>');
        const notification = $(`<div class="AppHeader-notification Notification ${className} Notification-enter">
            <div class="Notification-textSection Notification-textSection--withoutButton">
                ${content}
            </div>
            <button>
                <svg width="18" height="18" fill="#d3d3d3" viewBox="0 0 24 24" class="Icon"><path d="M13.486 12l5.208-5.207a1.048 1.048 0 0 0-.006-1.483 1.046 1.046 0 0 0-1.482-.005L12 10.514 6.793 5.305a1.048 1.048 0 0 0-1.483.005 1.046 1.046 0 0 0-.005 1.483L10.514 12l-5.208 5.207a1.048 1.048 0 0 0 .006 1.483 1.046 1.046 0 0 0 1.482.005L12 13.486l5.207 5.208a1.048 1.048 0 0 0 1.483-.006 1.046 1.046 0 0 0 .005-1.482L13.486 12z" fill-rule="evenodd"></path></svg>
            </button>
        </div>`);
        notification.find('button').click(function () {
            closeNotification();
        });
        container.html(notification);
        if($('.Notifications-container').length){
            if($('.Notifications-container').children().length) {
                $('.Notifications-container').children(':first').before(notification);
            } else {
                $('.Notifications-container').append(notification);
            }
        } else {
            $('#app').append(container);
        }

        if(autoClose){
            setTimeout(()=>{
                closeNotification(notification);
            }, time);
        }

        function closeNotification () {
            notification.addClass('Notification-leave');
            // 等待动画执行完毕
            setTimeout(()=>{
                notification.remove();
            }, 300);
        }
    }
}
