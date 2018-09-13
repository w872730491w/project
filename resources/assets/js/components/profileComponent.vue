<template lang="html">
    <div class="Card ProfileMain">
        <div class="ProfileMain-header">
            <ul class="Tabs ProfileMain-tabs">
                <li @click="setCurrent(tab.tab)" v-for="(tab, index) of tabs" :key="index" :class="['Tabs-item', {'Tabs-item--noMeta': tab.meta}]">
                    <button :class="['Tabs-link', {'is-active': tab.tab==currentList}]">
                        {{tab.name}}
                        <span v-if="tab.meta" class="Tabs-meta">
                            {{tab.meta}}
                        </span>
                    </button>
                </li>
            </ul>
        </div>
        <component ref="list" :is="currentList" :user="user"></component>
    </div>
</template>

<script>
export default {
    components: {
        'activities': require('./profile/activities.vue'),
        'answers': require('./profile/answers.vue'),
        'questions': require('./profile/questions.vue'),
        'follow': require('./profile/follow.vue')
    },
    props: {
        user_id: {
            type: Number,
            required: true
        }
    },
    methods: {
        setCurrent (tab) {
            if(this.currentList!=tab){
                this.currentList=tab;
            }
        }
    },
    data () {
        return {
            user: {},
            tabs: [
                {
                    name: '动态',
                    tab: 'activities'
                },
                {
                    name: '回答',
                    meta: this.answers_count,
                    tab: 'answers'
                },
                {
                    name: '提问',
                    meta: this.questions_count,
                    tab: 'questions'
                },
                {
                    name: '关注',
                    tab: 'follow'
                }
            ],
            currentList: 'activities'
        };
    },
    computed: {
        answers_count () {
            return this.user.answers_count;
        },
        questions_count () {
            return this.user.questions_count;
        },
    },
    created () {
        axios.post('/getUser/'+this.user_id).then((response) => {
            this.user = response.data;
        });
    }
}
</script>
