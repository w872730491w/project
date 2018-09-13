<template lang="html">
    <div id="TopicMain">
        <div class="Topic-bar Topic-bar--borderBottom">
            <ul class="Tabs Topic-tabs">
                <li v-for="tab of tabs" class="Tabs-item Tabs-item--noMeta">
                    <button @click="setCurrent(tab.tab)" :class="['Tabs-link', {'is-active': currentList==tab.tab}]">
                        {{tab.name}}
                    </button>
                </li>
            </ul>
        </div>
        <component :is="currentList"></component>
    </div>
</template>

<script>
export default {
    props: {
        topic_id: {
            type: Number,
            required: true
        }
    },
    components: {
        'discuss': require('./topic/discuss.vue'),
        'essence': require('./topic/essence.vue'),
        'answer': require('./topic/answer.vue')
    },
    data () {
        return {
            currentList: 'discuss',
            tabs: [
                {
                    name: '论坛',
                    tab: 'discuss'
                },
                {
                    name: '精华',
                    tab: 'essence'
                },
                {
                    name: '等待回答',
                    tab: 'answer'
                }
            ],
        };
    },
    methods: {
        setCurrent (tab) {
            this.currentList = tab;
        }
    }
}
</script>

<style lang="css">
</style>
