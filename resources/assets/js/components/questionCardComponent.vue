<template lang="html">
    <div class="Card TopstoryItem">
        <div class="Feed">
            <div class="FeedSource">
                <div v-if="question.topic" class="FeedSource-firstline">
                    热门内容, 来自:
                    <span>
                        <a v-for="topic of question.topic" class="TopicLink" :href="'/topic/'+topic.id" target="_blank">
                            {{ topic.name }}
                        </a>
                    </span>
                </div>
                <div class="AuthorInfo FeedSource-byline AuthorInfo--plain">
                    <span :user-id="question.answer.user.id" class="UserLink AuthorInfo-avatarWrapper">
                        <a class="UserLink-link" target="_blank" :href="'/people/'+question.answer.user.id">
                            <img class="Avatar AuthorInfo-avatar" width="24" height="24" :src="question.answer.user.avatar" :srcset="question.answer.user.avatar+' 2x'" :alt="question.answer.user.name">
                        </a>
                    </span>
                    <div class="AuthorInfo-content">
                        <div class="AuthorInfo-head">
                            <span :user-id="question.answer.user.id" class="UserLink AuthorInfo-name">
                                <a class="UserLink-link" target="_blank" :href="'/people/'+question.answer.user.id">{{question.answer.user.name}}</a>
                            </span>
                        </div>
                        <div class="AuthorInfo-detail">
                            <div class="AuthorInfo-badge">
                                <div class="RichText ztext AuthorInfo-badgeText">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ContentItem AnswerItem">
                <h2 class="ContentItem-title">
                    <a target="_blank" :href="'/question/'+question.id+'/answer/'+question.answer.id">
                        {{question.title}}
                    </a>
                </h2>
                <div class="ContentItem-meta"></div>
                <div :class="['RichContent', {'is-collapsed': is_collapsed}]">
                    <div v-if="uncollapsed" class="AnswerItem-extraInfo">
                        <span class="Voters">
                            <button type="button" class="Button Button--plain">{{question.answer.votes_count}} 人赞同了该回答</button>
                        </span>
                    </div>
                    <div v-if="((question.answer.hasImg || question.answer.hasVideo) && is_collapsed)" class="RichContent-cover">
                        <div class="RichContent-cover-inner">
                            <img :src="question.answer.cover[1]" alt="cover">
                        </div>
                        <div v-if="question.answer.hasVideo" class="RichContent-cover-play">
                            <svg viewBox="0 0 64 64" class="Icon Icon--play" width="50" height="50" aria-hidden="true" style="height: 50px; width: 50px;"><title></title><g><path fill-opacity="0.9" fill="#fff" d="M32,64 C14.326888,64 0,49.673112 0,32 C0,14.326888 14.326888,0 32,0 C49.673112,0 64,14.326888 64,32 C64,49.673112 49.673112,64 32,64 Z M32.2363929,61.6 C48.5840215,61.6 61.8363929,48.3476286 61.8363929,32 C61.8363929,15.6523714 48.5840215,2.4 32.2363929,2.4 C15.8887643,2.4 2.63639293,15.6523714 2.63639293,32 C2.63639293,48.3476286 15.8887643,61.6 32.2363929,61.6 Z"></path>   <circle fill-opacity="0.3" fill="#000" cx="32" cy="32" r="29.6"></circle>   <path fill-opacity="0.9" fill="#fff" d="M43.5634409,30.7271505 C44.6882014,31.4301259 44.6868607,32.5707121 43.5634409,33.2728495 L28.4365591,42.7271505 C27.3117986,43.4301259 26.4,42.9221451 26.4,41.5999847 L26.4,22.4000153 C26.4,21.0745235 27.3131393,20.5707121 28.4365591,21.2728495 L43.5634409,30.7271505 Z"></path></g>
                            </svg>
                        </div>
                    </div>
                    <div @click="showContent" class="RichContent-inner">
                        <div class="RichText ztext CopyrightRichText-richText" v-html="is_collapsed ? question.answer.collapsed_str : question.answer.body">
                        </div>
                    </div>
                    <div v-if="uncollapsed" class="ContentItem-time">
                        <el-tooltip class="item" effect="dark" content="发布于 2018-08-05 21:51" placement="top">
                            <a target="_blank" href="/question/276446407/answer/461401940">
                                <span>编辑于 2018-08-06</span>
                            </a>
                        </el-tooltip>
                    </div>
                    <div ref="actions" :style="actionsStyle" :class="['ContentItem-actions', actionsFixed ? 'Sticky RichContent-actions is-fixed is-bottom' : '']">
                        <span>
                            <button :disabled="question.answer.is_self" @click="voteAnswer" aria-label="赞同" type="button" :class="['Button', 'VoteButton', 'VoteButton--up', {'is-active': question.answer.is_vote}]">
                                <span style="display: inline-flex; align-items: center;">
                                    ​<svg class="Zi Zi--TriangleUp VoteButton-TriangleUp" fill="currentColor" viewBox="0 0 24 24" width="10" height="10"><path d="M2 18.242c0-.326.088-.532.237-.896l7.98-13.203C10.572 3.57 11.086 3 12 3c.915 0 1.429.571 1.784 1.143l7.98 13.203c.15.364.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H3.955c-1.08 0-1.955-.517-1.955-1.9z" fill-rule="evenodd"></path></svg>
                                </span>
                                赞同
                                <template v-if="question.answer.votes_count">
                                    {{question.answer.votes_count}}
                                </template>
                            </button>
                        </span>
                        <button @click="showComment" type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg>
                            </span>
                            <template v-if="!is_showComment">
                                <template v-if="question.answer.comments_count == 0">
                                    添加评论
                                </template>
                                <template v-else>
                                    {{question.answer.comments_count}} 条评论
                                </template>
                            </template>
                            <template v-else>
                                收起评论
                            </template>
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg>
                            </span>
                            分享
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Star Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg>
                            </span>
                            收藏
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Heart Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z" fill-rule="evenodd"></path></svg>
                            </span>
                            感谢
                        </button>
                        <button @click="toggleCollapsed" type="button" class="Button ContentItem-action ContentItem-rightButton Button--plain">
                            <span class="RichContent-collapsedText">
                                <template v-if="is_collapsed">
                                    阅读全文
                                </template>
                                <template v-else>
                                    收起
                                </template>
                            </span>
                            <svg viewBox="0 0 10 6" :class="['Icon', 'ContentItem-arrowIcon', 'Icon--arrow', {'is-active': uncollapsed}]" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
                        </button>
                    </div>
                </div>
                <comments type="answer" :type_id="question.answer.id" ref="comment" :count="question.answer.comments_count"></comments>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        question: {
            type: Object,
            required: true
        }
    },
    data () {
        return {
            is_collapsed: this.question.answer.collapsed_str ? true : false, // 答案是否收起 true 收起 false 展开
            actionsStyle: {}, // 底部操作栏样式
            actionsFixed: false, // 底部操作栏是否定位
            is_showComment: false, // 是否显示评论
        };
    },
    computed: {
        uncollapsed () {
            return !this.is_collapsed;
        }
    },
    methods: {
        toggleCollapsed () {
            this.is_collapsed = !this.is_collapsed;
        },
        showComment () {
            this.$refs.comment.$emit('showComment');
            this.is_showComment = this.$refs.comment.show;
        },
        showContent () {
            if(this.is_collapsed){
                this.is_collapsed = false;
            }
        },
        voteAnswer () {
            axios.post('/vote/answer', {id: this.question.answer.id}).then((response) => {
                this.question.answer.is_vote = !this.question.answer.is_vote;
                if(response.data.attached.length) {
                    this.question.answer.votes_count = this.question.answer.votes_count + 1;
                } else {
                    this.question.answer.votes_count = this.question.answer.votes_count - 1;
                }
            });
        }
    },
    watch: {
        is_collapsed (val) {
            if(this.uncollapsed){
                const _this = $(this.$el);
                setTimeout(() => {
                    const cardOffsetTop = _this.offset().top;
                    const cardHeight = _this.outerHeight(true);
                    const windowHeight = $(window).height();
                    const scrollTop = $(window).scrollTop();

                    if(cardOffsetTop + cardHeight > windowHeight + scrollTop){
                        const actionsFixed = true;
                        const actionsStyle = {
                            width: _this.outerWidth(true) + 'px',
                            bottom: '0px',
                            left: _this.offset().left + 'px'
                        };
                        this.actionsFixed = actionsFixed;
                        this.actionsStyle = actionsStyle;
                        $(window).scroll((e) => {
                            let scrollTop = $(window).scrollTop();
                            const windowHeight = $(window).height();
                            const cardOffsetTop = _this.offset().top;
                            if(this.uncollapsed){
                                if(scrollTop >= (cardOffsetTop + 200 - windowHeight) && scrollTop <= (cardOffsetTop + _this.outerHeight(true) - windowHeight - 10)) {
                                    this.actionsFixed = actionsFixed;
                                    this.actionsStyle = actionsStyle;
                                } else {
                                   this.actionsStyle = {};
                                   this.actionsFixed = false;
                                }
                            } else {
                                $(window).unbind(e);
                            }
                        });
                    }
                }, 50);
            } else {
                this.actionsStyle = {};
                this.actionsFixed = false;
            }
        }
    },
    mounted () {

    }
}
</script>

<style lang="css">
</style>
