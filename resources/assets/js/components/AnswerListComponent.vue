<template lang="html">
<div class="List">
    <div class="List-header">
        <h4 class="List-headerText">
            <span>{{count}} 个回答</span>
        </h4>
        <div class="List-headerOptions">
            <button @click="toggleOrder" type="button" class="Button Select-button Select-plainButton Button--plain">
                <template v-if="orderBy=='vote'">
                    默认排序
                </template>
                <template v-else>
                    时间排序
                </template>
                <span style="display: inline-flex; align-items: center;">
                    ​<svg class="Zi Zi--Select Select-arrow" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M12 16.183l2.716-2.966a.757.757 0 0 1 1.064.001.738.738 0 0 1 0 1.052l-3.247 3.512a.758.758 0 0 1-1.064 0L8.22 14.27a.738.738 0 0 1 0-1.052.758.758 0 0 1 1.063 0L12 16.183zm0-9.365L9.284 9.782a.758.758 0 0 1-1.064 0 .738.738 0 0 1 0-1.052l3.248-3.512a.758.758 0 0 1 1.065 0L15.78 8.73a.738.738 0 0 1 0 1.052.757.757 0 0 1-1.063.001L12 6.818z" fill-rule="evenodd"></path></svg>
                </span>
            </button>
        </div>
    </div>
    <answer-card v-for="answer of list" :key="answer.id" :answer="answer"></answer-card>
</div>
</template>

<script>
export default {
    props: {
        question_id: {
            type: Number,
            required: true
        },
        count: {
            type: Number,
            required: true
        },
    },
    data () {
        return {
            list: [],
            orderBy: 'vote'
        };
    },
    methods: {
        toggleOrder () {
            this.orderBy = this.orderBy=='vote' ? 'created' : 'vote' ;
            this.getAnswers();
        },
        getAnswers () {
            axios.post('/getAnswers/'+this.question_id, {order: this.orderBy}).then((response) => {
                this.list = response.data;
            });
        }
    },
    mounted () {
        this.getAnswers();
    }
}
</script>

<style lang="css">
</style>
