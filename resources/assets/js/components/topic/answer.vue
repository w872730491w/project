<template lang="html">
    <div class="Card">
        <div class="List">
            <template v-if="!is_loading">
                <template v-if="list.length">
                    <div v-for="question of list" :key="question.id" class="List-item TopicFeedItem">
                        <div class="ContentItem">
                            <h2 class="ContentItem-title">
                                <div class="QuestionItem-title">
                                    <a :href="'/question/'+question.id" target="_blank">{{question.title}}</a>
                                </div>
                            </h2>
                            <div class="RichContent">
                                <div class="ContentItem-actions">
                                    <a target="_blank" type="button" class="Button ContentItem-action Button--blue Button--withIcon Button--withLabel" :href="'/question/'+question.id+'?writeAnswer=true'">
                                        <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Edit Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M4.076 16.966a4.19 4.19 0 0 1 1.05-1.76l8.568-8.569a.524.524 0 0 1 .741 0l2.928 2.927a.524.524 0 0 1 0 .74l-8.568 8.57c-.49.49-1.096.852-1.761 1.051l-3.528 1.058a.394.394 0 0 1-.49-.488l1.06-3.53zM20.558 4.83c.59.59.59 1.546 0 2.136l-1.693 1.692a.503.503 0 0 1-.712 0l-2.812-2.812a.504.504 0 0 1 0-.712l1.693-1.693a1.51 1.51 0 0 1 2.135 0l1.389 1.389z"></path></svg></span>
                                        写回答
                                    </a>
                                    <button @click="showComment(question)" type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                                        <span style="display: inline-flex; align-items: center;">​
                                            <svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg>
                                        </span>
                                        添加评论
                                    </button>
                                    <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                                        <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg></span>
                                        分享
                                    </button>
                                    <a target="_blank" type="button" class="Button ContentItem-action Button--plain" :href="'/question/'+question.id">
                                        <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Answer" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em" style="margin-right: 4px;"><path d="M4.5 4h15a1.5 1.5 0 0 1 0 3h-15a1.5 1.5 0 0 1 0-3zm0 6h15a1.5 1.5 0 0 1 0 3h-15a1.5 1.5 0 0 1 0-3zm0 6H12a1.5 1.5 0 0 1 0 3H4.5a1.5 1.5 0 0 1 0-3z" fill-rule="evenodd"></path></svg></span>
                                        {{question.answers_count}} 个回答
                                    </a>
                                </div>
                                <comments type="question" :type_id="question.id" :ref="'comment'+question.id" :count="question.comments_count"></comments>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-if="!list.length">
                    <div class="EmptyState">
                        <div class="EmptyState-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="120" viewBox="0 0 150 120" class="EmptyState-image"><title></title><g><g fill="none" fill-rule="evenodd"><path fill="#EBEEF5" fill-rule="nonzero" d="M109.545 78h5.463A2.995 2.995 0 0 0 118 75.01V34.99c0-1.648-1.34-2.99-2.992-2.99H62.992A2.995 2.995 0 0 0 60 34.99v2.027h-3V34.99c0-3.308 2.69-5.99 5.992-5.99h52.016A5.993 5.993 0 0 1 121 34.99v40.02c0 3.308-2.69 5.99-5.992 5.99h-2.744l-.558 5.65c-.217 2.197-1.783 2.842-3.49 1.45l-8.7-7.1h-18.69v-3h19.76l8.29 6.767.67-6.767zM37.33 91.9c-1.942 1.057-3.23.15-2.878-2.027l1.237-7.64A25.886 25.886 0 0 1 30 66c0-14.36 11.637-26 26-26 14.36 0 26 11.637 26 26 0 14.36-11.637 26-26 26-4.627 0-8.973-1.21-12.737-3.327L37.33 91.9zm5.958-6.656l1.447.814A22.878 22.878 0 0 0 56 89c12.705 0 23-10.296 23-23 0-12.705-10.296-23-23-23-12.705 0-23 10.296-23 23a22.894 22.894 0 0 0 5.03 14.36l.833 1.04-1.11 6.855 5.535-3.01zm13.108-31.452c2.304 0 4.176.612 5.616 1.908 1.44 1.26 2.16 2.988 2.16 5.148 0 1.764-.468 3.24-1.368 4.392-.324.396-1.332 1.332-3.024 2.808-.684.576-1.188 1.224-1.512 1.872-.396.72-.576 1.512-.576 2.376v.612H53.84v-.612c0-1.332.216-2.484.72-3.42.468-1.008 1.836-2.484 4.068-4.464l.612-.684c.648-.828 1.008-1.692 1.008-2.628 0-1.26-.36-2.232-1.044-2.952-.72-.72-1.764-1.08-3.06-1.08-1.62 0-2.808.504-3.528 1.548-.648.864-.972 2.088-.972 3.672h-3.78c0-2.628.756-4.68 2.268-6.192 1.512-1.548 3.6-2.304 6.264-2.304zm-.648 21.06c.756 0 1.404.216 1.908.72.504.468.756 1.08.756 1.836s-.288 1.368-.792 1.872a2.703 2.703 0 0 1-1.872.72c-.72 0-1.368-.252-1.872-.756s-.756-1.116-.756-1.836c0-.756.252-1.368.756-1.836.504-.504 1.152-.72 1.872-.72z"></path><path fill="#F7F8FA" d="M83.23 56h24.275c.818 0 1.495-.672 1.495-1.5 0-.834-.67-1.5-1.495-1.5H81.93a28.845 28.845 0 0 1 3.002 11h12.56a1.5 1.5 0 1 1 0 3h-12.51a29.422 29.422 0 0 0-.05-3zM72.285 42h35.22c.826 0 1.495.666 1.495 1.5 0 .828-.677 1.5-1.495 1.5H76a28.945 28.945 0 0 0-3.715-3z"></path></g></g></svg>
                            还没有问题
                        </div>
                    </div>
                </template>
            </template>
            <template v-else>
                <div class="List-item">
                    <div class="PlaceHolder">
                        <div class="PlaceHolder-inner">
                            <div class="PlaceHolder-bg"></div>
                            <svg width="656" height="108" viewBox="0 0 656 108" class="PlaceHolder-mask"><path d="M0 0h656v108H0V0zm0 0h350v12H0V0zm20 32h238v12H20V32zM0 32h12v12H0V32zm0 32h540v12H0V64zm0 32h470v12H0V96z" fill="currentColor" fill-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            is_loading: false,
            list: []
        };
    },
    methods: {
        showComment (question, index) {
            const ref = 'comment'+question.id;
            this.$refs[ref][0].$emit('showComment');
        },
    },
    mounted () {
        axios.post(`/getTopicAnswer/${this.$parent.topic_id}`).then((response) => {
            this.list = response.data;
            this.is_loading = false;
        });
    }
}
</script>

<style lang="css">
</style>
